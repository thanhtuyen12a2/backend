<?php
namespace backend\models;
use Aabc;
use aabc\helpers\ArrayHelper;
use common\cont\D;

class Cauhinh_fake extends \aabc\db\ActiveRecord
{    
    public static function tableName()
    {
        return Cauhinh::table;        
    }
    
    //Start
    private $_attributes; //Array  
    public function __construct() {
        $this->_attributes = [
            Cauhinh::ch_id => null,
            Cauhinh::ch_key => null,
            Cauhinh::ch_data => null,
        ];
    }
    public function __get($name)
    {
        if (array_key_exists($name, $this->_attributes))
            return $this->_attributes[$name];
        return parent::__get($name);
    }
    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->_attributes))
            $this->_attributes[$name] = $value;
        else parent::__set($name, $value);
    }
    //End


    public function rules()
    {   
        return [  
            [['ch_id','ch_key','ch_data'], 'safe'],
            [[Cauhinh::ch_key], 'required'],
            [[Cauhinh::ch_data], 'safe'],
        ];
    }

    public function beforeSave($insert)
    {
        $this[Cauhinh::ch_data] = json_encode($this[Cauhinh::ch_data]);
        $this->ch_id = $this[Cauhinh::ch_id]; 
        $this->ch_key = $this[Cauhinh::ch_key]; 
        $this->ch_data = $this[Cauhinh::ch_data];
        Cauhinh::cache($this);
        return true;
    }


     public function afterFind()
    {   
        $this[Cauhinh::ch_id] =  $this->ch_id; 
        $this[Cauhinh::ch_key] =  $this->ch_key;
        $this[Cauhinh::ch_data] =  json_decode($this->ch_data, true);
        parent::afterFind();
    }  




}
