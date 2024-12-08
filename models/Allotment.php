<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "allotment".
 *
 * @property int $id
 * @property int $mentor_id
 * @property int $mentee_id
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Users $mentee
 * @property Mentor $mentor
 */
class Allotment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'allotment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mentor_id', 'mentee_id'], 'required'],
            [['mentor_id', 'mentee_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['mentee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['mentee_id' => 'user_id']],
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
            'mentor_id' => 'Mentor ID',
            'mentee_id' => 'Mentee ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Mentee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMentee()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'mentee_id']);
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