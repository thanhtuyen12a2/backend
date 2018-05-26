<?php

namespace backend\models;

use Aabc;
use aabc\base\Model;
use aabc\data\ActiveDataProvider;
//use backend\models\Cauhinh;


class Cauhinh_fakeSearch extends Cauhinh
{
    
    public function rules()
    {
        return [
            [[Aabc::$app->_cauhinh->ch_id], 'integer'],
            [[Aabc::$app->_cauhinh->ch_key, Aabc::$app->_cauhinh->ch_data], 'safe'],
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
                $_Cauhinh = Aabc::$app->_model->Cauhinh;
        $query = $_Cauhinh::find();

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
            Aabc::$app->_cauhinh->ch_id => $this[Aabc::$app->_cauhinh->ch_id],
        ]);

        $query->andFilterWhere(['like', Aabc::$app->_cauhinh->ch_key, $this[Aabc::$app->_cauhinh->ch_key]])
            ->andFilterWhere(['like', Aabc::$app->_cauhinh->ch_data, $this[Aabc::$app->_cauhinh->ch_data]]);

        return $dataProvider;
    }
}
