<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "internship".
 *
 * @property int $id
 * @property int $user_id
 * @property int $mentor_id
 * @property string $company
 * @property string $startdate
 * @property string $enddate
 * @property int $hours
 * @property string $certificate
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Users $user
 * @property Mentor $mentor
 */
class Internship extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'internship';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'company', 'hours', 'certificate'], 'required'],
            [['user_id', 'mentor_id'], 'integer'],
            [['startdate', 'enddate', 'created_at', 'updated_at'], 'safe'],
            ['hours', 'integer', 'min' => 30],
            [['company'], 'string', 'max' => 100],
            [['certificate'], 'string', 'max' => 200],
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
            'user_id' => 'User ID',
            'mentor_id' => 'Mentor ID',
            'company' => 'Company',
            'startdate' => 'Startdate',
            'enddate' => 'Enddate',
            'hours' => 'Hours',
            'certificate' => 'Certificate',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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

