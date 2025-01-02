<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "properties".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string|null $description
 * @property float $price
 * @property float $area
 * @property string $pincode
 * @property string $state
 * @property string $region
 * @property string $taluka
 * @property string $district
 * @property string $city
 * @property string $address_line1
 * @property string|null $address_line2
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $image1
 * @property string|null $image2
 * @property string|null $image3
 * @property string|null $image4
 * @property string|null $image5
 */
class Properties extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'properties';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'price', 'area', 'pincode', 'region', 'taluka', 'city', 'address_line1'], 'required'],
            [['category_id'], 'integer'],
            [['description', 'region'], 'string'],
            [['price', 'area'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'address_line1', 'address_line2', 'image1', 'image2', 'image3', 'image4', 'image5'], 'string', 'max' => 255],
            [['pincode'], 'string', 'max' => 10],
            [['state', 'taluka', 'district', 'city'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'title' => 'Title',
            'description' => 'Description',
            'price' => 'Price',
            'area' => 'Area',
            'pincode' => 'Pincode',
            'state' => 'State',
            'region' => 'Region',
            'taluka' => 'Taluka',
            'district' => 'District',
            'city' => 'City',
            'address_line1' => 'Address Line1',
            'address_line2' => 'Address Line2',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'image1' => 'Image1',
            'image2' => 'Image2',
            'image3' => 'Image3',
            'image4' => 'Image4',
            'image5' => 'Image5',
        ];
    }
}
