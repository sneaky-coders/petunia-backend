<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Allotment;

/**
 * SearchAllotment represents the model behind the search form of `app\models\Allotment`.
 */
class SearchAllotment extends Allotment
{
    /**
     * {@inheritdoc}
     */

     public $user_id,$bachelorcgpa; 


    public function rules()
    {
        return [
            [['id','mentee_id'], 'integer'],
            [['mentor_id'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id','bachelorcgpa'], 'safe'],
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
        $query = Allotment::find();

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
            'mentor_id' => $this->mentor_id,
            'mentee_id' => $this->mentee_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}