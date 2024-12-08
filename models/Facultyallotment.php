<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "facultyallotment".
 *
 * @property int $id
 * @property int $faculty_id
 * @property int $course_id
 * @property string $semster
 * @property string $division
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Courses $course
 * @property Faculty $faculty
 */
class Facultyallotment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'facultyallotment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['faculty_id', 'course_id', 'semster', 'division'], 'required'],
            [['faculty_id', 'course_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['semster'], 'string', 'max' => 5],
            [['division'], 'string', 'max' => 10],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['faculty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::className(), 'targetAttribute' => ['faculty_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'faculty_id' => 'Faculty ID',
            'course_id' => 'Course ID',
            'semster' => 'Semster',
            'division' => 'Division',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Courses::className(), ['id' => 'course_id']);
    }

    /**
     * Gets query for [[Faculty]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaculty()
    {
        return $this->hasOne(Faculty::className(), ['id' => 'faculty_id']);
    }
}
