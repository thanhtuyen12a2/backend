<?php

namespace backend\models;

use Aabc;
use aabc\base\Model;
use aabc\data\ActiveDataProvider;
//use backend\models\Chinhsach;


class ChinhsachSearch extends Chinhsach
{
    
    public function rules()
    {
        return [
            [[Aabc::$app->_chinhsach->cs_id, Aabc::$app->_chinhsach->cs_tylechietkhau, Aabc::$app->_chinhsach->cs_noidungdieukien], 'integer'],
            [[Aabc::$app->_chinhsach->cs_type, Aabc::$app->_chinhsach->cs_ten, Aabc::$app->_chinhsach->cs_code, Aabc::$app->_chinhsach->cs_ghichu, Aabc::$app->_chinhsach->cs_typetyle, Aabc::$app->_chinhsach->cs_apdungcho, Aabc::$app->_chinhsach->cs_dieukien, Aabc::$app->_chinhsach->cs_status, Aabc::$app->_chinhsach->cs_recycle, Aabc::$app->_chinhsach->cs_ngaytao, Aabc::$app->_chinhsach->cs_ngaybatdau, Aabc::$app->_chinhsach->cs_ngayketthuc], 'safe'],
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
                $_Chinhsach = Aabc::$app->_model->Chinhsach;
        $query = $_Chinhsach::find();

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
            Aabc::$app->_chinhsach->cs_id => $this[Aabc::$app->_chinhsach->cs_id],
            Aabc::$app->_chinhsach->cs_tylechietkhau => $this[Aabc::$app->_chinhsach->cs_tylechietkhau],
            Aabc::$app->_chinhsach->cs_noidungdieukien => $this[Aabc::$app->_chinhsach->cs_noidungdieukien],
            Aabc::$app->_chinhsach->cs_ngaytao => $this[Aabc::$app->_chinhsach->cs_ngaytao],
            Aabc::$app->_chinhsach->cs_ngaybatdau => $this[Aabc::$app->_chinhsach->cs_ngaybatdau],
            Aabc::$app->_chinhsach->cs_ngayketthuc => $this[Aabc::$app->_chinhsach->cs_ngayketthuc],
        ]);

        $query->andFilterWhere(['like', Aabc::$app->_chinhsach->cs_type, $this[Aabc::$app->_chinhsach->cs_type]])
            ->andFilterWhere(['like', Aabc::$app->_chinhsach->cs_ten, $this[Aabc::$app->_chinhsach->cs_ten]])
            ->andFilterWhere(['like', Aabc::$app->_chinhsach->cs_code, $this[Aabc::$app->_chinhsach->cs_code]])
            ->andFilterWhere(['like', Aabc::$app->_chinhsach->cs_ghichu, $this[Aabc::$app->_chinhsach->cs_ghichu]])
            ->andFilterWhere(['like', Aabc::$app->_chinhsach->cs_typetyle, $this[Aabc::$app->_chinhsach->cs_typetyle]])
            ->andFilterWhere(['like', Aabc::$app->_chinhsach->cs_apdungcho, $this[Aabc::$app->_chinhsach->cs_apdungcho]])
            ->andFilterWhere(['like', Aabc::$app->_chinhsach->cs_dieukien, $this[Aabc::$app->_chinhsach->cs_dieukien]])
            ->andFilterWhere(['like', Aabc::$app->_chinhsach->cs_status, $this[Aabc::$app->_chinhsach->cs_status]])
            ->andFilterWhere(['like', Aabc::$app->_chinhsach->cs_recycle, $this[Aabc::$app->_chinhsach->cs_recycle]]);

        return $dataProvider;
    }
}
