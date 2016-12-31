<?php
namespace modules\user\models\search;

use yii\data\ActiveDataProvider;
use modules\user\models\UserInfo;

class UserInfoSearch extends UserInfo
{
    public function rules()
    {
        return [
            [['id', 'user_id', 'sex', 'qq','score', 'signin_day', 'last_login_time'], 'integer'],
            [['birthday', 'location','signature'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = UserInfo::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => '10',
            ]
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'sex' => $this->sex,
            'score' => $this->score,
            'qq' => $this->qq,
            'signin_day' => $this->signin_day,
            'last_login_time' => $this->last_login_time,
        ]);
        $query->andFilterWhere(['like', 'birthday', $this->birthday])
            ->andFilterWhere(['like', 'location', $this->location]);
        return $dataProvider;
    }
}