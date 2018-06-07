<?php

namespace backend\models;

use Aabc;
use aabc\base\Model;
use aabc\data\ActiveDataProvider;

//use backend\models\Danhmuc;


class DanhmucSearch extends Danhmuc
{
    
    public $dm_thongso;

    public function rules()
    {
        return [
            [[Aabc::$app->_danhmuc->dm_id, Aabc::$app->_danhmuc->dm_idcha, Aabc::$app->_danhmuc->dm_thutu, Aabc::$app->_danhmuc->dm_sothutu, 'dm_groupmenu','dm_dmsp',], 'integer'],
            [[Aabc::$app->_danhmuc->dm_ten, Aabc::$app->_danhmuc->dm_char, Aabc::$app->_danhmuc->dm_icon, Aabc::$app->_danhmuc->dm_background, Aabc::$app->_danhmuc->dm_link, Aabc::$app->_danhmuc->dm_ghichu, Aabc::$app->_danhmuc->dm_status, Aabc::$app->_danhmuc->dm_recycle, Aabc::$app->_danhmuc->dm_type], 'safe'],

            [['dm_thongso'],'integer'],

            [['dm_noibat'],'integer'],

            [['dm_template'],'safe'],
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
                $_Danhmuc = Aabc::$app->_model->Danhmuc;
        $query = $_Danhmuc::find();

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
            Aabc::$app->_danhmuc->dm_id => $this[Aabc::$app->_danhmuc->dm_id],
            Aabc::$app->_danhmuc->dm_idcha => $this[Aabc::$app->_danhmuc->dm_idcha],
            Aabc::$app->_danhmuc->dm_thutu => $this[Aabc::$app->_danhmuc->dm_thutu],
            Aabc::$app->_danhmuc->dm_sothutu => $this[Aabc::$app->_danhmuc->dm_sothutu],
            'dm_groupmenu' => $this->dm_groupmenu,
            'dm_noibat' => $this->dm_noibat,
        ]);

        if(!empty($this->dm_dmsp)) $query->andWhere(['dm_dmsp' => $this->dm_dmsp]);

        if(!empty($this->dm_thongso)){
            if(empty($this->dm_dmsp)){
                $data_ts = $_Danhmuc::find()->andWhere(['dm_level' => 1, 'dm_id' => $this->dm_thongso])->exists();
            }else{
                $data_ts = $_Danhmuc::find()->andWhere(['dm_level' => 1, 'dm_dmsp' => $this->dm_dmsp, 'dm_id' => $this->dm_thongso])->exists();
            }
            // echo '<pre>';
            // print_r($data_ts);
            // echo '</pre>';
            // die;
            $query->andWhere(['or',
                (!$data_ts)?:['dm_id' => $this->dm_thongso],
                ['dm_idcha' => $this->dm_thongso],
            ]);
        }


        $query->andFilterWhere(['like', Aabc::$app->_danhmuc->dm_ten, $this[Aabc::$app->_danhmuc->dm_ten]])
            ->andFilterWhere(['like', Aabc::$app->_danhmuc->dm_char, $this[Aabc::$app->_danhmuc->dm_char]])
            ->andFilterWhere(['like', Aabc::$app->_danhmuc->dm_icon, $this[Aabc::$app->_danhmuc->dm_icon]])
            ->andFilterWhere(['like', Aabc::$app->_danhmuc->dm_background, $this[Aabc::$app->_danhmuc->dm_background]])
            ->andFilterWhere(['like', Aabc::$app->_danhmuc->dm_link, $this[Aabc::$app->_danhmuc->dm_link]])
            ->andFilterWhere(['like', Aabc::$app->_danhmuc->dm_ghichu, $this[Aabc::$app->_danhmuc->dm_ghichu]])
            ->andFilterWhere(['like', Aabc::$app->_danhmuc->dm_status, $this[Aabc::$app->_danhmuc->dm_status]])
            ->andFilterWhere(['like', Aabc::$app->_danhmuc->dm_recycle, $this[Aabc::$app->_danhmuc->dm_recycle]])
            ->andFilterWhere(['like', Aabc::$app->_danhmuc->dm_type, $this[Aabc::$app->_danhmuc->dm_type]]);
          
        $query->andWhere(['dm_template' => Cauhinh::template()]);

        return $dataProvider;
    }
}
