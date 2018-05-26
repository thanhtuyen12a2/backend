<?php

namespace backend\models;

use Aabc;
use aabc\base\Model;
use aabc\data\ActiveDataProvider;
use backend\models\Domain;


class DomainSearch extends Domain
{
    
    public function rules()
    {
        return [
            [[Aabc::$app->domain->dm_id, Aabc::$app->domain->dm_length], 'integer'],
            [[Aabc::$app->domain->dm_domain, Aabc::$app->domain->dm_status, Aabc::$app->domain->dm_recycle, Aabc::$app->domain->dm_tiemnang, Aabc::$app->domain->dm_chude, Aabc::$app->domain->dm_email, Aabc::$app->domain->dm_source, Aabc::$app->domain->dm_timedownload], 'safe'],
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
        $query = Domain::find();

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
            Aabc::$app->domain->dm_id => $this[Aabc::$app->domain->dm_id],
            Aabc::$app->domain->dm_length => $this[Aabc::$app->domain->dm_length],
            Aabc::$app->domain->dm_timedownload => $this[Aabc::$app->domain->dm_timedownload],
        ]);

        $query->andFilterWhere(['like', Aabc::$app->domain->dm_domain, $this[Aabc::$app->domain->dm_domain]])
            // ->andFilterWhere(['like', Aabc::$app->domain->dm_status, $this[Aabc::$app->domain->dm_status]])
            ->andFilterWhere(['like', Aabc::$app->domain->dm_recycle, $this[Aabc::$app->domain->dm_recycle]])
            ->andFilterWhere(['like', Aabc::$app->domain->dm_tiemnang, $this[Aabc::$app->domain->dm_tiemnang]])
            ->andFilterWhere(['like', Aabc::$app->domain->dm_chude, $this[Aabc::$app->domain->dm_chude]])
            ->andFilterWhere(['like', Aabc::$app->domain->dm_source, $this[Aabc::$app->domain->dm_source]])
            
            ->andFilterWhere(['like', Aabc::$app->domain->dm_email, $this[Aabc::$app->domain->dm_email]]);


            if(null != $this[Aabc::$app->domain->dm_status]){
                $kt = '';
                $mang = array('or');
                foreach ($this[Aabc::$app->domain->dm_status] as $key => $id) {               
                    if($id != '') $kt = 'ok';
                    array_push($mang,"`".Aabc::$app->domain->dm_status."` = '".$id."'");
                }           
                if($kt != '') $query->andFilterWhere($mang);
            }



             if(Aabc::$app->request->get(Aabc::$app->domain->dm_domain)){            
                $mang = array('or');
                array_push($mang,"`".Aabc::$app->domain->dm_domain."` LIKE '%". urldecode(Aabc::$app->request->get(Aabc::$app->domain->dm_domain)) ."%'");
                array_push($mang,"`".Aabc::$app->domain->dm_chude."` LIKE '%". urldecode(Aabc::$app->request->get(Aabc::$app->domain->dm_domain)) ."%'");
                $query->andFilterWhere($mang);
            }

        return $dataProvider;
    }
}
