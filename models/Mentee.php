<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mentee".
 *
 * @property int $mentee_id
 * @property string $name
 * @property string $email
 * @property string $batch
 * @property string $cgpa
 * @property string $usn
 * @property string $created_at
 * @property string|null $updated_at
 */
class Mentee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mentee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mentee_id', 'name', 'email', 'batch', 'cgpa', 'usn'], 'required'],
            [['mentee_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email'], 'string', 'max' => 100],
            [['batch'], 'string', 'max' => 20],
            [['cgpa', 'usn'], 'string', 'max' => 50],
            [['mentee_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mentee_id' => 'Mentee ID',
            'name' => 'Name',
            'email' => 'Email',
            'batch' => 'Batch',
            'cgpa' => 'Cgpa',
            'usn' => 'Usn',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
