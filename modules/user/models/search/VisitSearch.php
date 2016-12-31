<?php
namespace modules\user\models\search;

use yii\data\ActiveDataProvider;
use modules\user\models\Visit;

class VisitSearch extends Visit
{
    public function rules()
    {
        return [
            [['id', 'visit_time'], 'integer'],
            [['visit_ip'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Visit::find();
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'visit_time' => $this->visit_time,
        ]);
        $query->andFilterWhere(['like', 'visit_ip', $this->visit_ip]);
        return $dataProvider;
    }
}