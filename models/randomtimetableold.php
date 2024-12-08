<?php

namespace app\models;

use Yii;

class Randomtimetable extends \yii\db\ActiveRecord
{
    public $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    public $timeslots = [
        '10:00 AM - 10:55 AM', '10:55 AM - 11:50 AM', '11:50 AM - 12:45 AM',
        '1 PM - 3 PM', '1 PM - 1:55 PM', '3:30 PM - 4:25 PM'
    ];

    public $coursename;

    /**
     * Generates a random timetable and saves it to the database.
     *
     * @return bool
     * @throws \Throwable
     */
    public function generateRandomTimetable()
    {
        // Fetch faculties allotted for a specific semester, division, and course
        $facultiesAllotments = Facultyallotment::find()
            ->where(['semster' => '1', 'division' => 'A'])
            ->all();
        $rooms = Room::find()->all();

        // Create an array to keep track of used time slots for each day
        $usedTimeSlots = [];

        foreach ($this->days as $day) {
            $usedTimeSlots[$day] = [];

            foreach ($this->timeslots as $timeslot) {
                // Check if the time slot is already used for the current day
                if (in_array($timeslot, $usedTimeSlots[$day])) {
                    continue;
                }

                $this->generateRandomEntry($facultiesAllotments, $rooms, $day, $timeslot);
                $usedTimeSlots[$day][] = $timeslot;
            }
        }

        return true;
    }

    private function generateRandomEntry($facultiesAllotments, $rooms, $day, $timeslot)
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

        $timetableEntry = new Randomtimetable();
        $timetableEntry->course_id = $randomFacultyAllotment->course_id;
        $timetableEntry->coursename = $randomFacultyAllotment->course->coursename;
        $timetableEntry->semester = $randomFacultyAllotment->semster;
        $timetableEntry->subject_id = $this->generateRandomSubject($timetableEntry->coursename);
        $timetableEntry->scheme = '1';
        $timetableEntry->division = $randomFacultyAllotment->division;
        $timetableEntry->labsession = $this->isLabSession($timetableEntry->course_id) ? 'Yes' : 'No';
        $timetableEntry->faculty_id1 = $randomFacultyAllotment->faculty_id;
        $timetableEntry->faculty_id2 = $this->getRandomFaculty($facultiesAllotments, $randomFacultyAllotment->faculty_id);

        // Check if the course has credits 2 and is a lab session
        if ($this->isLabSessionWithCreditsTwo($timetableEntry->course_id)) {
            // For lab sessions with credits 2, have 3 faculties allotted
            $timetableEntry->faculty_id3 = $this->getRandomFaculty($facultiesAllotments, $randomFacultyAllotment->faculty_id, $timetableEntry->faculty_id2);
        } else {
            // For other cases, set faculty_id3 to null
            $timetableEntry->faculty_id3 = null;
        }

        $timetableEntry->room = $randomRoom->name;
        $timetableEntry->timeslot = $timeslot;
        $timetableEntry->day = $day;
        $timetableEntry->created_at = new \yii\db\Expression('NOW()');

        // Check if the course has 0 or more than 2 credits and adjust the number of classes accordingly
        if ($this->isCourseWithZeroOrMoreThanTwoClasses($timetableEntry->course_id)) {
            // For courses with 0 or more than 2 credits, allow up to 4 classes per week
            $timetableEntry->save();
        } else {
            // Ensure that only courses with credits 2 are allotted in the '1 PM - 3 PM' slot
            if ($this->isLabSessionWithCreditsTwo($timetableEntry->course_id) && $timeslot !== '1 PM - 3 PM') {
                return; // Skip lab session for other timeslots
            }

            $timetableEntry->save();
        }
    }

    // New method to check if an entry exists for the same timeslot and day in the division
    private function entryExistsForTimeslotAndDayInDivision($randomFacultyAllotment, $day, $timeslot)
    {
        return Randomtimetable::find()
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
        return $courseModel && $courseModel->credits == 2 && strpos($courseModel->coursename, 'Lab') !== false;
    }

    // New method to check if a course is already scheduled on the same day
    private function isCourseAlreadyScheduledOnDay($facultyId, $day)
    {
        return Randomtimetable::find()
            ->where(['faculty_id1' => $facultyId, 'day' => $day])
            ->exists();
    }

    private function isCourseWithZeroOrMoreThanTwoClasses($courseId)
    {
        $courseModel = Courses::findOne(['id' => $courseId]);
        return $courseModel && ($courseModel->credits == 0 || $courseModel->credits > 2);
    }

    // New method to check if a course is a lab session with credits equal to 2
    private function isLabSessionWithCreditsTwo($courseId)
    {
        $courseModel = Courses::findOne(['id' => $courseId]);
        return $courseModel && $courseModel->credits == 2 && $this->isLabSession($courseId);
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

    public static function tableName()
    {
        return 'randomtimetable';
    }
}
