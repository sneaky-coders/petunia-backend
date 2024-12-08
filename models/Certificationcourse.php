<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "certificationcourse".
 *
 * @property int $id
 * @property string $name
 * @property string $certificate
 * @property int $score
 * @property string $marks
 * @property string $certificate1
 * @property string $created_at
 * @property string $updated_at
 * @property int $user_id
 * @property int $mentor_id
 *
 * @property Users $user
 * @property Mentor $mentor
 */
class Certificationcourse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'certificationcourse';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'certificate', 'score', 'marks', 'certificate1', 'user_id', 'mentor_id'], 'required'],
            [[ 'user_id', 'mentor_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            ['score', 'double', 'min' => 30],
            ['marks', 'double', 'min' => 30],
            [['name'], 'string', 'max' => 200],
            [['certificate', 'certificate1'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'user_id']],
            [['mentor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mentor::className(), 'targetAttribute' => ['mentor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Course Name',
            'certificate' => 'Certificate',
            'score' => 'Score',
            'marks' => 'Marks',
            'certificate1' => 'Certificate1',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'mentor_id' => 'Mentor ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
    }

    /**
     * Gets query for [[Mentor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMentor()
    {
        return $this->hasOne(Mentor::className(), ['id' => 'mentor_id']);
    }
}
