<?php

namespace backend\models;

use Aabc;
use aabc\base\Model;
use aabc\data\ActiveDataProvider;
//use backend\models\Image;


class ImageSearch extends Image
{
    
    public function rules()
    {
        return [
            [[Aabc::$app->_image->image_id, Aabc::$app->_image->image_byte], 'integer'],
            [[Aabc::$app->_image->image_tenfile, Aabc::$app->_image->image_link, Aabc::$app->_image->image_recycle, Aabc::$app->_image->image_status], 'safe'],
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
        $_Image = Aabc::$app->_model->Image;
        $query = $_Image::find();

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
            Aabc::$app->_image->image_id => $this[Aabc::$app->_image->image_id],
            Aabc::$app->_image->image_byte => $this[Aabc::$app->_image->image_byte],
        ]);

        $query->andFilterWhere(['like', Aabc::$app->_image->image_tenfile, $this[Aabc::$app->_image->image_tenfile]])
            ->andFilterWhere(['like', Aabc::$app->_image->image_link, $this[Aabc::$app->_image->image_link]])
            ->andFilterWhere(['like', Aabc::$app->_image->image_recycle, $this[Aabc::$app->_image->image_recycle]])
            ->andFilterWhere(['like', Aabc::$app->_image->image_status, $this[Aabc::$app->_image->image_status]]);

        return $dataProvider;
    }
}
