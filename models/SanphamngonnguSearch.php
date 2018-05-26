<?php

namespace backend\models;

use Aabc;
use aabc\base\Model;
use aabc\data\ActiveDataProvider;
use backend\models\Sanphamngonngu;


class SanphamngonnguSearch extends Sanphamngonngu
{
    
    public function rules()
    {
        return [
            [['spnn_idsanpham', 'spnn_idngonngu'], 'integer'],
            [['spnn_ten', 'spnn_noidung', 'spnn_gioithieu'], 'safe'],
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
        $query = Sanphamngonngu::find();

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
            'spnn_idsanpham' => $this->spnn_idsanpham,
            'spnn_idngonngu' => $this->spnn_idngonngu,
        ]);

        $query->andFilterWhere(['like', 'spnn_ten', $this->spnn_ten])
            ->andFilterWhere(['like', 'spnn_noidung', $this->spnn_noidung])
            ->andFilterWhere(['like', 'spnn_gioithieu', $this->spnn_gioithieu]);

        return $dataProvider;
    }
}
