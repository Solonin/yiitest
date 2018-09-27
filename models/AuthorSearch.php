<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Author;

/**
 * AuthorSearch represents the model behind the search form of `app\models\Author`.
 */
class AuthorSearch extends Author
{
    public $book;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'book'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Author::find()
        ->joinWith('book')
        ->select(
            [Author::tableName().'.*','COUNT('.Book::tableName().'.id) AS bookCount']
        )
        ->groupBy(Author::tableName().'.id');


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        /* Here I bind the User model function "getCountlicense" with the column "licenseCount" created in $query*/
        $dataProvider->sort->attributes['Countbook'] = [
            'asc' => ['bookCount' => SORT_ASC],
            'desc' => ['bookCount' => SORT_DESC],
        ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
//            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
