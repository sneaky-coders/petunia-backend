<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Randomtimetable;

/**
 * SearchRandomtimetable represents the model behind the search form of `app\models\Randomtimetable`.
 */
class SearchRandomtimetable extends Randomtimetable
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'course_id', 'subject_id', 'faculty_id1', 'faculty_id2', 'faculty_id3'], 'integer'],
            [['semester', 'scheme', 'division', 'labsession', 'room', 'timeslot', 'day', 'created_at', 'updated_at'], 'safe'],
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
        $query = Randomtimetable::find();

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
            'course_id' => $this->course_id,
            'subject_id' => $this->subject_id,
            'faculty_id1' => $this->faculty_id1,
            'faculty_id2' => $this->faculty_id2,
            'faculty_id3' => $this->faculty_id3,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'semester', $this->semester])
            ->andFilterWhere(['like', 'scheme', $this->scheme])
            ->andFilterWhere(['like', 'division', $this->division])
            ->andFilterWhere(['like', 'labsession', $this->labsession])
            ->andFilterWhere(['like', 'room', $this->room])
            ->andFilterWhere(['like', 'timeslot', $this->timeslot])
            ->andFilterWhere(['like', 'day', $this->day]);

        return $dataProvider;
    }
}
