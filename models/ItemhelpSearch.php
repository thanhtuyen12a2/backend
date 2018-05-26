<?php

namespace backend\models;

use Aabc;
use aabc\base\Model;
use aabc\data\ActiveDataProvider;
use backend\models\Itemhelp;


class ItemhelpSearch extends Itemhelp
{
    
    public function rules()
    {
        return [
            [['ih_id', 'ih_sothutu', 'ih_id_grouphelp'], 'integer'],
            [['ih_action', 'ih_check', 'ih_focus', 'ih_noidung'], 'safe'],
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
        $query = Itemhelp::find();

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
            'ih_id' => $this->ih_id,
            'ih_sothutu' => $this->ih_sothutu,
            'ih_id_grouphelp' => $this->ih_id_grouphelp,
        ]);

        $query->andFilterWhere(['like', 'ih_action', $this->ih_action])
            ->andFilterWhere(['like', 'ih_check', $this->ih_check])
            ->andFilterWhere(['like', 'ih_focus', $this->ih_focus])
            ->andFilterWhere(['like', 'ih_noidung', $this->ih_noidung]);

        return $dataProvider;
    }
}
