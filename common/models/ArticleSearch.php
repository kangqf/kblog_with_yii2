<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Article;

/**
 * ArticleSearch represents the model behind the search form about `common\models\Article`.
 */
class ArticleSearch extends Article
{
    public function rules()
    {
        return [
            [['aid', 'author_id', 'category_id', 'set_index', 'set_top', 'set_recommend', 'click_count', 'status', 'creat_time', 'update_time'], 'integer'],
            [['title', 'content', 'tags', 'keywords', 'summary'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Article::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'aid' => $this->aid,
            'author_id' => $this->author_id,
            'category_id' => $this->category_id,
            'set_index' => $this->set_index,
            'set_top' => $this->set_top,
            'set_recommend' => $this->set_recommend,
            'click_count' => $this->click_count,
            'status' => $this->status,
            'creat_time' => $this->creat_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'summary', $this->summary]);

        return $dataProvider;
    }
}
