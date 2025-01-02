<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "property_enquiry".
 *
 * @property int $id
 * @property int $property_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string|null $message
 * @property string|null $enquiry_date
 */
class PropertyEnquiry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'property_enquiry';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['property_id', 'name', 'email', 'phone'], 'required'],
            [['property_id'], 'integer'],
            [['message'], 'string'],
            [['enquiry_date'], 'safe'],
            [['name', 'email'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'property_id' => 'Property ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'message' => 'Message',
            'enquiry_date' => 'Enquiry Date',
        ];
    }
}
