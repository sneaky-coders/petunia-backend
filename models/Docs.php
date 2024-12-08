<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "docs".
 *
 * @property int $id
 * @property string $TT
 * @property string $LP
 * @property string $CP
 * @property string $created_at
 * @property string|null $updated_at
 */
class Docs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'docs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TT', 'LP', 'CP'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['TT', 'LP', 'CP'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'TT' => 'Time Table',
            'LP' => 'Lecture Plan',
            'CP' => 'Course Documents',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
