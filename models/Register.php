<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "register".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $usn
 * @property string $branch
 * @property string $password
 * @property string $created_at
 * @property string $updated_at
 */
class Register extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'register';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'usn', 'branch', 'password'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'usn', 'branch'], 'string', 'max' => 20],
            [['email', 'password'], 'string', 'max' => 30],
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
            'email' => 'Email',
            'usn' => 'Usn',
            'branch' => 'Branch',
            'password' => 'Password',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
