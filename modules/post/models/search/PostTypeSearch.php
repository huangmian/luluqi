<?php
namespace modules\post\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\post\models\PostType;

class PostTypeSearch extends PostType
{
    public function rules()
    {
        return [
            [['type_id', 'parent_id', 'created_at'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = PostType::find();
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'type_id' => $this->type_id,
            'parent_id' => $this->parent_id,
            'created_at' => $this->created_at,
        ]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        return $dataProvider;
    }
}
