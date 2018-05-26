<?php

namespace backend\modules\rbac\models;

use Aabc;
use aabc\base\Model;
use aabc\data\ActiveDataProvider;
use backend\modules\rbac\models\Authassignment;


class AuthassignmentSearch extends Authassignment
{
    
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'safe'],
            [['created_at'], 'integer'],
        ];
    }

    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    
    public function search($params) //GET
    //public function search() //POST
    {
        $query = Authassignment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params); //GET
        //$this->load(Aabc::$app->request->post()); //POST

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'user_id', $this->user_id]);

        return $dataProvider;
    }
}
