<?php
namespace modules\post\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use modules\post\models\Post;

class PostSearch extends Post
{
    public function rules()
    {
        return [
            [['id', 'user_id',  'type_id', 'tag_id', 'is_visible', 'is_top', 'is_essence', 'is_reprint', 'up', 'down', 'comment_num', 'view_num', 'collection'], 'integer'],
            [['content', 'title'], 'safe'],
        ];
    }
    
    public function search($params)
    {
        $query = Post::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => Yii::$app->params['pageSize']['many'], //如果不定义，默认为20
            ],
            //'sort' => ['attributes' => ['id']],//如果定义，则只能按照id来排序，否则所有字段都可以
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'type_id' => $this->type_id,
            'tag_id' => $this->tag_id,
            'is_visible' => $this->is_visible,
            'is_top' => $this->is_top,
            'is_essence' => $this->is_essence,
            'is_reprint' => $this->is_reprint,
            'up' => $this->up,
            'down' => $this->down,
            'comment_num' => $this->comment_num,
            'view_num' => $this->view_num,
            'collection' => $this->collection,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
      $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'title', $this->title]);
        return $dataProvider;
    }
}