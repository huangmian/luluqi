<?php
namespace modules\user\models\search;

use yii\data\ActiveDataProvider;
use modules\user\models\VisitCount;

class VisitCountSearch extends VisitCount
{
    public function rules()
    {
        return [
            [['id', 'nums'], 'integer'],
            [['created_time'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = VisitCount::find();
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'nums' => $this->nums,
            'created_time' => $this->created_time,
        ]);
        return $dataProvider;
    }
}