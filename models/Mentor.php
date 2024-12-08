<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mentor".
 *
 * @property int $id
 * @property string $name
 * @property string $designation
 * @property string $created_at
 * @property string $updated_at
 * @property int $user_id
 *
 * @property Allotment[] $allotments
 * @property Certificationcourse[] $certificationcourses
 * @property Mentorallotment[] $mentorallotments
 */
class Mentor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mentor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'designation', 'user_id'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['designation'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'designation' => 'Designation',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Allotments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAllotments()
    {
        return $this->hasMany(Allotment::className(), ['mentor_id' => 'id']);
    }

    /**
     * Gets query for [[Certificationcourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCertificationcourses()
    {
        return $this->hasMany(Certificationcourse::className(), ['mentor_id' => 'id']);
    }

    /**
     * Gets query for [[Mentorallotments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMentorallotments()
    {
        return $this->hasMany(Mentorallotment::className(), ['mentor_id' => 'id']);
    }
}
