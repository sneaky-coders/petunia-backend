<?php

namespace app\models;

use Yii;

class RandomTimetable extends \yii\db\ActiveRecord
{
    public $coursename;
    public $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    public $timeslots = [
        '10:00 AM - 10:55 AM', '10:55 AM - 11:50 AM', '11:50 AM - 12:45 PM', '1 PM - 1:55 PM', '3:30 PM - 4:25 PM'
    ];

    /**
     * Generates a random timetable and saves it to the database.
     *
     * @return bool
     * @throws \Throwable
     */
    public function generateRandomTimetable()
    {
        // Truncate existing records
        RandomTimetable::deleteAll();
    
        // Fetch faculties allotted for a specific semester, division, and course
        $facultiesAllotments = Facultyallotment::find()
            ->where(['semster' => '1', 'division' => 'A'])
            ->all();
        $rooms = Room::find()->all();
    
        // Create an array to keep track of used time slots for each day
        $usedTimeSlots = [];
    
        // Create an array to keep track of scheduled lab sessions for each day and timeslot
        $scheduledLabSessions = [];
    
        // Create an array to keep track of scheduled lab sessions for each course
        $scheduledLabSessionsByCourse = [];
    
        foreach ($this->days as $day) {
            $usedTimeSlots[$day] = [];
            $scheduledLabSessions[$day] = [];
    
            foreach ($this->timeslots as $timeslot) {
                // Check if the time slot is already used for the current day
                if ($this->isTimeSlotUsed($usedTimeSlots, $day, $timeslot)) {
                    continue;
                }
    
                $this->generateRandomEntry($facultiesAllotments, $rooms, $day, $timeslot, $usedTimeSlots, $scheduledLabSessions, $scheduledLabSessionsByCourse);
            }
        }
    
        return true;
    }
    
    private function generateRandomEntry($facultiesAllotments, $rooms, $day, $timeslot, &$usedTimeSlots, &$scheduledLabSessions, &$scheduledLabSessionsByCourse)
    {
        $randomFacultyAllotment = $this->getRandomItem($facultiesAllotments);
        $randomRoom = $this->getRandomItem($rooms);
    
        // Check if there's already an entry for the same timeslot and day in the division
        if ($this->entryExistsForTimeslotAndDayInDivision($randomFacultyAllotment, $day, $timeslot)) {
            return; // Skip creating a new entry
        }
    
        // Additional check to skip allocation for courses with names ending with "Lab" and credits equal to 2
        if ($this->shouldSkipAllocation($randomFacultyAllotment)) {
            return;
        }
    
        // Check if the course is already scheduled on the same day
        if ($this->isCourseAlreadyScheduledOnDay($randomFacultyAllotment->faculty_id, $day)) {
            return; // Skip creating a new entry for the same course on the same day
        }
    
        // Check if the time slot is already occupied for the current day
        if ($this->isTimeSlotUsed($usedTimeSlots, $day, $timeslot)) {
            return; // Skip creating a new entry for the same time slot on the same day
        }
    
        // Check if the selected course is a lab session with credits equal to 2
        $isLabSession = $this->isLabSession($randomFacultyAllotment->course_id);
    
        // Ensure that lab sessions are allotted only at '1 PM - 3 PM' on Monday to Wednesday
        if ($isLabSession && !in_array($day, ['Monday', 'Tuesday', 'Wednesday']) && $timeslot !== '1 PM - 3 PM') {
            return; // Skip creating a new entry for lab sessions outside the specified time slot
        }
    
        // Check if there's already a lab session scheduled at the same time for the same day
        if ($isLabSession && $this->isLabSessionAlreadyScheduled($day, $timeslot, $scheduledLabSessions)) {
            return; // Skip creating a new entry for a lab session at the same time on the same day
        }
    
        // Check if a lab session for the same course has already been scheduled in the current week
        if ($isLabSession && $this->isLabSessionAlreadyScheduledForCourse($randomFacultyAllotment->course_id, $scheduledLabSessionsByCourse)) {
            return; // Skip creating a new entry for a lab session for the same course in the current week
        }
    
        $timetableEntry = new RandomTimetable();
        $timetableEntry->course_id = $randomFacultyAllotment->course_id;
        $timetableEntry->coursename = $randomFacultyAllotment->course->coursename;
        $timetableEntry->semester = $randomFacultyAllotment->semster;
        $timetableEntry->subject_id = $this->generateRandomSubject($timetableEntry->coursename);
        $timetableEntry->scheme = '1';
        $timetableEntry->division = $randomFacultyAllotment->division;
        $timetableEntry->labsession = $isLabSession ? 'Yes' : 'No';
        $timetableEntry->faculty_id1 = $randomFacultyAllotment->faculty_id;
    
        // Ensure that only lab sessions are allotted in the '1 PM - 3 PM' slot
        if ($isLabSession) {
            $timetableEntry->room = $randomRoom->name;
            $timetableEntry->timeslot = '1 PM - 3 PM'; // Force the timeslot to '1 PM - 3 PM'
            $timetableEntry->day = $day;
    
            // Update the usedTimeSlots array to mark the occupied time slot
            $usedTimeSlots[$day][] = '1 PM - 3 PM';
    
            // Update the scheduledLabSessions array to mark the scheduled lab session
            $scheduledLabSessions[$day][$timeslot] = true;
    
            // Update the scheduledLabSessionsByCourse array to mark the scheduled lab session for the course
            $scheduledLabSessionsByCourse[$randomFacultyAllotment->course_id] = true;
    
            $timetableEntry->created_at = new \yii\db\Expression('NOW()');
            $timetableEntry->save();
        } else {
            // For other cases, set faculty_id3 to null
            $timetableEntry->faculty_id3 = null;
            $timetableEntry->room = $randomRoom->name;
            $timetableEntry->timeslot = $timeslot;
            $timetableEntry->day = $day;
    
            // Update the usedTimeSlots array to mark the occupied time slot
            $usedTimeSlots[$day][] = $timeslot;
    
            $timetableEntry->created_at = new \yii\db\Expression('NOW()');
            $timetableEntry->save();
        }
    }
    
    // New method to check if a lab session is already scheduled at the same time for the same day
    private function isLabSessionAlreadyScheduled($day, $timeslot, $scheduledLabSessions)
    {
        return isset($scheduledLabSessions[$day][$timeslot]) && $scheduledLabSessions[$day][$timeslot];
    }
    
    // New method to check if a lab session for the same course has already been scheduled in the current week
    private function isLabSessionAlreadyScheduledForCourse($courseId, $scheduledLabSessionsByCourse)
    {
        return isset($scheduledLabSessionsByCourse[$courseId]) && $scheduledLabSessionsByCourse[$courseId];
    }

    // New method to check if an entry exists for the same timeslot and day in the division
    private function entryExistsForTimeslotAndDayInDivision($randomFacultyAllotment, $day, $timeslot)
    {
        return RandomTimetable::find()
            ->where([
                'faculty_id1' => $randomFacultyAllotment->faculty_id,
                'division' => $randomFacultyAllotment->division,
                'day' => $day,
                'timeslot' => $timeslot,
            ])
            ->exists();
    }

    // New method to check whether to skip allocation for specific courses
    private function shouldSkipAllocation($randomFacultyAllotment)
    {
        $courseModel = Courses::findOne(['id' => $randomFacultyAllotment->course_id]);

        // Skip allocation for courses without lab sessions or credits not equal to 2
        if ($courseModel && $this->isLabSession($courseModel->id) && $courseModel->credits == 2) {
            return false; // Do not skip allocation if both conditions are met
        }

        return false; // Skip allocation for all other cases
    }

    // New method to check if a course is already scheduled on the same day
    private function isCourseAlreadyScheduledOnDay($facultyId, $day)
    {
        return RandomTimetable::find()
            ->where(['faculty_id1' => $facultyId, 'day' => $day])
            ->exists();
    }

    // New method to check if a course is a lab session with credits equal to 2
    private function isLabSessionWithCreditsTwo($courseId)
    {
        $courseModel = Courses::findOne(['id' => $courseId]);
        return $courseModel && $courseModel->credits == 2 && stripos($courseModel->coursename, 'Lab') == true;
    }

    // New method to check if a time slot is already used on a given day
    private function isTimeSlotUsed($usedTimeSlots, $day, $timeslot)
    {
        return in_array($timeslot, $usedTimeSlots[$day]);
    }

    private function getRandomItem($items)
    {
        return !empty($items) ? $items[array_rand($items)] : null;
    }

    private function generateRandomSubject($courseId)
    {
        // Assuming 'subject_id' is the column storing subject names in the Courses table
        $courseModel = Courses::findOne(['id' => $courseId]);
        return $courseModel ? $courseModel->subject_id ?: 'DefaultSubject' : 'DefaultSubject';
    }

    // Add a new method to get a random faculty different from the provided faculty IDs
    private function getRandomFaculty($facultiesAllotments, $facultyId1, $facultyId2 = null)
    {
        $filteredFaculties = array_filter($facultiesAllotments, function ($facultyAllotment) use ($facultyId1, $facultyId2) {
            return $facultyAllotment->faculty_id != $facultyId1 && $facultyAllotment->faculty_id != $facultyId2;
        });

        return $this->getRandomItem($filteredFaculties)->faculty_id;
    }

    // Add a new method to check if a course is a lab session
    private function isLabSession($courseId)
    {
        $courseModel = Courses::findOne(['id' => $courseId]);
        return $courseModel && $courseModel->credits == 2;
    }

    // Check if the course has 0 or more than 2 credits and adjust the number of classes accordingly
    private function isCourseWithZeroOrMoreThanTwoClasses($courseId)
    {
        $courseModel = Courses::findOne(['id' => $courseId]);
        return $courseModel && ($courseModel->credits == 0 || $courseModel->credits > 2 || $courseModel->isLabSession == 'Yes');
    }

    public static function tableName()
    {
        return 'randomtimetable';
    }
}
