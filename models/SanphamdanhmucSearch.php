<?php

namespace backend\models;

use Aabc;
use aabc\base\Model;
use aabc\data\ActiveDataProvider;
//use backend\models\Sanphamdanhmuc;


class SanphamdanhmucSearch extends Sanphamdanhmuc
{
    
    public function rules()
    {
        return [
            [[Aabc::$app->_sanphamdanhmuc->spdm_id_sp, Aabc::$app->_sanphamdanhmuc->spdm_id_danhmuc], 'integer'],
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
                $_Sanphamdanhmuc = Aabc::$app->_model->Sanphamdanhmuc;
        $query = $_Sanphamdanhmuc::find();

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
            Aabc::$app->_sanphamdanhmuc->spdm_id_sp => $this[Aabc::$app->_sanphamdanhmuc->spdm_id_sp],
            Aabc::$app->_sanphamdanhmuc->spdm_id_danhmuc => $this[Aabc::$app->_sanphamdanhmuc->spdm_id_danhmuc],
        ]);

        return $dataProvider;
    }
}
