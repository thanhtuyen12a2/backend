<?php

namespace backend\models;

use Aabc;
use aabc\base\Model;
use aabc\data\ActiveDataProvider;
use backend\models\Nhomsanpham2;


class Nhomsanpham2Search extends Nhomsanpham2
{
    
    public function rules()
    {
        return [
            [['nsp_id', 'nsp_idcha', 'nsp_thutu'], 'integer'],
            [['nsp_tennhom', 'nsp_icon', 'nsp_link', 'nsp_ghichu', 'nsp_status', 'nsp_recycle'], 'safe'],
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
        $query = Nhomsanpham2::find();

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
            'nsp_id' => $this->nsp_id,
            'nsp_idcha' => $this->nsp_idcha,
            'nsp_thutu' => $this->nsp_thutu,
        ]);

        $query->andFilterWhere(['like', 'nsp_tennhom', $this->nsp_tennhom])
            ->andFilterWhere(['like', 'nsp_icon', $this->nsp_icon])
            ->andFilterWhere(['like', 'nsp_link', $this->nsp_link])
            ->andFilterWhere(['like', 'nsp_ghichu', $this->nsp_ghichu])
            ->andFilterWhere(['like', 'nsp_status', $this->nsp_status])
            ->andFilterWhere(['like', 'nsp_recycle', $this->nsp_recycle]);

        return $dataProvider;
    }
}
