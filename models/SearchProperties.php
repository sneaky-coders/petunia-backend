<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Properties;

/**
 * SearchProperties represents the model behind the search form of `app\models\Properties`.
 */
class SearchProperties extends Properties
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['title', 'description', 'pincode', 'state', 'region', 'taluka', 'district', 'city', 'address_line1', 'address_line2', 'created_at', 'updated_at', 'image1', 'image2', 'image3', 'image4', 'image5', 'bedroom', 'bathroom', 'year_built', 'furnishing', 'kitchen', 'floor', 'video_link'], 'safe'],
            [['price', 'area'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Properties::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'area' => $this->area,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'pincode', $this->pincode])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'region', $this->region])
            ->andFilterWhere(['like', 'taluka', $this->taluka])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'address_line1', $this->address_line1])
            ->andFilterWhere(['like', 'address_line2', $this->address_line2])
            ->andFilterWhere(['like', 'image1', $this->image1])
            ->andFilterWhere(['like', 'image2', $this->image2])
            ->andFilterWhere(['like', 'image3', $this->image3])
            ->andFilterWhere(['like', 'image4', $this->image4])
            ->andFilterWhere(['like', 'image5', $this->image5])
            ->andFilterWhere(['like', 'bedroom', $this->bedroom])
            ->andFilterWhere(['like', 'bathroom', $this->bathroom])
            ->andFilterWhere(['like', 'year_built', $this->year_built])
            ->andFilterWhere(['like', 'furnishing', $this->furnishing])
            ->andFilterWhere(['like', 'kitchen', $this->kitchen])
            ->andFilterWhere(['like', 'floor', $this->floor])
            ->andFilterWhere(['like', 'video_link', $this->video_link]);

        return $dataProvider;
    }
}
