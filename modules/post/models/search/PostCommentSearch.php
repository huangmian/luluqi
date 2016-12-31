<?php
namespace modules\post\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\post\models\PostComment;

class PostCommentSearch extends PostComment
{
    public function rules()
    {
        return [
            [['id', 'post_id', 'user_id', 'parent_id', 'up', 'down', 'created_at', 'updated_at'], 'integer'],
            [['desc'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = PostComment::find();
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'post_id' => $this->post_id,
            'user_id' => $this->user_id,
            'parent_id' => $this->parent_id,
            'up' => $this->up,
            'down' => $this->down,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        $query->andFilterWhere(['like', 'desc', $this->desc]);
        return $dataProvider;
    }
}
