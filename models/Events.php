<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property string $title
 * @property string $desciption
 * @property string $startdate
 * @property string $enddate
 * @property string $created_at
 * @property string|null $updated_at
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'desciption', 'startdate', 'enddate'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'desciption', 'startdate', 'enddate'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'desciption' => 'Desciption',
            'startdate' => 'Startdate',
            'enddate' => 'Enddate',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
