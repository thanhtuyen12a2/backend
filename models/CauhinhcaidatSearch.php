<?php

namespace backend\models;

use Aabc;
use aabc\base\Model;
use aabc\data\ActiveDataProvider;
//use backend\models\Cauhinhcaidat;


class CauhinhcaidatSearch extends Cauhinhcaidat
{
    
    public function rules()
    {
        return [
            [[Aabc::$app->_cauhinhcaidat->chcd_id], 'integer'],
            [[Aabc::$app->_cauhinhcaidat->chcd_ten, Aabc::$app->_cauhinhcaidat->chcd_logo, Aabc::$app->_cauhinhcaidat->chcd_diachi, Aabc::$app->_cauhinhcaidat->chcd_dienthoai, Aabc::$app->_cauhinhcaidat->chcd_email, Aabc::$app->_cauhinhcaidat->chcd_website, Aabc::$app->_cauhinhcaidat->chcd_tieudeseo, Aabc::$app->_cauhinhcaidat->chcd_motaseo, Aabc::$app->_cauhinhcaidat->chcd_googlebot, Aabc::$app->_cauhinhcaidat->chcd_robots, Aabc::$app->_cauhinhcaidat->chcd_ananytic, Aabc::$app->_cauhinhcaidat->chcd_fbid, Aabc::$app->_cauhinhcaidat->chcd_fbapp, Aabc::$app->_cauhinhcaidat->chcd_fbpixel, Aabc::$app->_cauhinhcaidat->chcd_googlewmt], 'safe'],
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
                $_Cauhinhcaidat = Aabc::$app->_model->Cauhinhcaidat;
        $query = $_Cauhinhcaidat::find();

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
            Aabc::$app->_cauhinhcaidat->chcd_id => $this[Aabc::$app->_cauhinhcaidat->chcd_id],
        ]);

        $query->andFilterWhere(['like', Aabc::$app->_cauhinhcaidat->chcd_ten, $this[Aabc::$app->_cauhinhcaidat->chcd_ten]])
            ->andFilterWhere(['like', Aabc::$app->_cauhinhcaidat->chcd_logo, $this[Aabc::$app->_cauhinhcaidat->chcd_logo]])
            ->andFilterWhere(['like', Aabc::$app->_cauhinhcaidat->chcd_diachi, $this[Aabc::$app->_cauhinhcaidat->chcd_diachi]])
            ->andFilterWhere(['like', Aabc::$app->_cauhinhcaidat->chcd_dienthoai, $this[Aabc::$app->_cauhinhcaidat->chcd_dienthoai]])
            ->andFilterWhere(['like', Aabc::$app->_cauhinhcaidat->chcd_email, $this[Aabc::$app->_cauhinhcaidat->chcd_email]])
            ->andFilterWhere(['like', Aabc::$app->_cauhinhcaidat->chcd_website, $this[Aabc::$app->_cauhinhcaidat->chcd_website]])
            ->andFilterWhere(['like', Aabc::$app->_cauhinhcaidat->chcd_tieudeseo, $this[Aabc::$app->_cauhinhcaidat->chcd_tieudeseo]])
            ->andFilterWhere(['like', Aabc::$app->_cauhinhcaidat->chcd_motaseo, $this[Aabc::$app->_cauhinhcaidat->chcd_motaseo]])
            ->andFilterWhere(['like', Aabc::$app->_cauhinhcaidat->chcd_googlebot, $this[Aabc::$app->_cauhinhcaidat->chcd_googlebot]])
            ->andFilterWhere(['like', Aabc::$app->_cauhinhcaidat->chcd_robots, $this[Aabc::$app->_cauhinhcaidat->chcd_robots]])
            ->andFilterWhere(['like', Aabc::$app->_cauhinhcaidat->chcd_ananytic, $this[Aabc::$app->_cauhinhcaidat->chcd_ananytic]])
            ->andFilterWhere(['like', Aabc::$app->_cauhinhcaidat->chcd_fbid, $this[Aabc::$app->_cauhinhcaidat->chcd_fbid]])
            ->andFilterWhere(['like', Aabc::$app->_cauhinhcaidat->chcd_fbapp, $this[Aabc::$app->_cauhinhcaidat->chcd_fbapp]])
            ->andFilterWhere(['like', Aabc::$app->_cauhinhcaidat->chcd_fbpixel, $this[Aabc::$app->_cauhinhcaidat->chcd_fbpixel]])
            ->andFilterWhere(['like', Aabc::$app->_cauhinhcaidat->chcd_googlewmt, $this[Aabc::$app->_cauhinhcaidat->chcd_googlewmt]]);

        return $dataProvider;
    }
}
