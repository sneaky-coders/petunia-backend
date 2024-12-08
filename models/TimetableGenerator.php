<?php 

// models/TimetableGenerator.php

namespace app\models;

use yii\base\Model;

class TimetableGenerator extends Model
{
    /**
     * Generate a random timetable.
     *
     * @return array
     */
    public function generateRandomTimetable()
    {
        $courses = ['Course1', 'Course2', 'Course3']; // Replace with your actual courses
        $divisions = ['A', 'B']; // Replace with your actual divisions
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']; // Replace with your actual days
        $faculties = ['Faculty1', 'Faculty2', 'Faculty3']; // Replace with your actual faculties
        $rooms = ['Room1', 'Room2', 'Room3']; // Replace with your actual rooms
        $timeslots = ['10:00-10:55', '11:00-11:55', '12:00-12:55']; // Replace with your actual timeslots

        $timetable = [];

        // Generate random entries for the timetable
        for ($i = 0; $i < 10; $i++) { // Adjust the number of entries as needed
            $entry = [
                'course' => $courses[array_rand($courses)],
                'division' => $divisions[array_rand($divisions)],
                'day' => $days[array_rand($days)],
                'faculty' => $faculties[array_rand($faculties)],
                'room' => $rooms[array_rand($rooms)],
                'timeslot' => $timeslots[array_rand($timeslots)],
            ];

            $timetable[] = $entry;
        }

        return $timetable;
    }
}


?>