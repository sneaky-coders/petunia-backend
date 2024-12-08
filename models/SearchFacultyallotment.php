<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Facultyallotment;

/**
 * SearchFacultyallotment represents the model behind the search form of `app\models\Facultyallotment`.
 */
class SearchFacultyallotment extends Facultyallotment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'faculty_id', 'course_id'], 'integer'],
            [['semster', 'division', 'created_at', 'updated_at'], 'safe'],
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
        $query = Facultyallotment::find();

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
            'faculty_id' => $this->faculty_id,
            'course_id' => $this->course_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'semster', $this->semster])
            ->andFilterWhere(['like', 'division', $this->division]);

        return $dataProvider;
    }
}
