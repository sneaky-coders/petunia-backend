<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "electiveenrollment".
 *
 * @property int $id
 * @property int $user_id
 * @property string $elective1
 * @property string $elective2
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Users $user
 */
class Electiveenrollment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'electiveenrollment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'elective1', 'elective2'], 'required'],
            [['user_id'], 'integer'],
            [['user_id'], 'unique'],
            [['created_at', 'updated_at'], 'safe'],
            [['elective1', 'elective2'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'user_id']],
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
            'elective1' => 'Elective1',
            'elective2' => 'Elective2',
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
}
