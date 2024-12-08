<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "deadlines".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $due_date
 * @property string $created_at
 * @property string|null $updated_at
 */
class Deadlines extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deadlines';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['due_date', 'created_at', 'updated_at'], 'safe'],
            [['title', 'description'], 'string', 'max' => 100],
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
            'description' => 'Description',
            'due_date' => 'Due Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
