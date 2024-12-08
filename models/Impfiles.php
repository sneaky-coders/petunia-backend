<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "impfiles".
 *
 * @property int $id
 * @property string $title
 * @property string $file
 * @property string $created_at
 * @property string $updated_at
 */
class Impfiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'impfiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'file'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'file'], 'string', 'max' => 100],
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
            'file' => 'File',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
