<?php
namespace modules\post\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\post\models\PostTag;

class PostTagSearch extends PostTag
{
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['tag_name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = PostTag::find();
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        $query->andFilterWhere(['like', 'tag_name', $this->tag_name]);
        return $dataProvider;
    }
}
