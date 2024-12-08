<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "timetable".
 *
 * @property int $id
 * @property int|null $course_id
 * @property int $subject_id
 * @property string $scheme
 * @property string $division
 * @property string $semester
 * @property string $labsession
 * @property int|null $faculty_id1
 * @property int|null $faculty_id2
 * @property int|null $faculty_id3
 * @property string|null $room
 * @property string|null $timeslot
 * @property string|null $day
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Faculty $facultyId1
 * @property Courses $subject
 * @property Faculty $facultyId2
 * @property Faculty $facultyId3
 */
class Timetable extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;

    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'timetable';
        
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_id', 'subject_id', 'faculty_id1', 'faculty_id2', 'faculty_id3'], 'integer'],
            [['subject_id', 'division'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['scheme', 'day','semester'], 'string', 'max' => 30],
            [['division', 'labsession'], 'string', 'max' => 10],
            [['room'], 'string', 'max' => 50],
            [['timeslot'], 'string', 'max' => 100],
            [['faculty_id1'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::className(), 'targetAttribute' => ['faculty_id1' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::className(), 'targetAttribute' => ['subject_id' => 'id']],
            [['faculty_id2'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::className(), 'targetAttribute' => ['faculty_id2' => 'id']],
            [['faculty_id3'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::className(), 'targetAttribute' => ['faculty_id3' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_id' => 'Course ID',
            'subject_id' => 'Subject ID',
            'scheme' => 'Scheme',
            'division' => 'Division',
            'labsession' => 'Labsession',
            'faculty_id1' => 'Faculty Id1',
            'faculty_id2' => 'Faculty Id2',
            'faculty_id3' => 'Faculty Id3',
            'room' => 'Room',
            'timeslot' => 'Timeslot',
            'day' => 'Day',
            'semester' => 'Semester',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[FacultyId1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFacultyId1()
    {
        return $this->hasOne(Faculty::className(), ['id' => 'faculty_id1']);
    }

    /**
     * Gets query for [[Subject]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Courses::className(), ['id' => 'subject_id']);
    }

    /**
     * Gets query for [[FacultyId2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFacultyId2()
    {
        return $this->hasOne(Faculty::className(), ['id' => 'faculty_id2']);
    }

    /**
     * Gets query for [[FacultyId3]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFacultyId3()
    {
        return $this->hasOne(Faculty::className(), ['id' => 'faculty_id3']);
    }

    public static function isFacultyAvailable($semester, $timeslot, $day, $facultyId)
    {
        // Your logic to check faculty availability goes here
        // Example: check the database for existing entries with the same parameters
    
        $count = static::find()
            ->andWhere(['semester' => $semester, 'timeslot' => $timeslot, 'day' => $day])
            ->andWhere(['or',
                ['faculty_id1' => $facultyId],
                ['faculty_id2' => $facultyId],
                ['faculty_id3' => $facultyId],
            ])
            ->count();
    
        return $count == 0; // Return true if the faculty is available, false otherwise
    }

    public function getCourse()
    {
        return $this->hasOne(Courses::class, ['id' => 'course_id']);
    }
}


