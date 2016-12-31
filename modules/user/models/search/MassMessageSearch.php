<?php
namespace modules\user\models\search;

use yii\data\ActiveDataProvider;
use modules\user\models\MassMessage;

class MassMessageSearch extends MassMessage
{
    public function rules()
    {
        return [
            [['id', 'admin_id', 'created_at'], 'integer'],
            [['content'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = MassMessage::find();
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'admin_id' => $this->admin_id,
            'created_at' => $this->created_at,
        ]);
        $query->andFilterWhere(['like', 'content', $this->content]);
        return $dataProvider;
    }
}