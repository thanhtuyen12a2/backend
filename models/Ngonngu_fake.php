<?php
namespace backend\models;
use Aabc;

class Ngonngu_fake extends \aabc\db\ActiveRecord
{
    public static function tableName()
    {
        return Ngonngu::table;        
    }
    
    private $_attributes; //Array Danh muc    
    public function __construct() {
        $this->_attributes = [
            Ngonngu::ngonngu_code => null,
            Ngonngu::ngonngu_trangthai => null,
            Ngonngu::ngonngu_macdinh => null,
            Ngonngu::ngonngu_ten => null,
            Ngonngu::ngonngu_flag => null,
            Ngonngu::ngonngu_id => null,            
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


     public function rules()
    {
        return [
            [['ngonngu_id','ngonngu_trangthai','ngonngu_macdinh','ngonngu_code','ngonngu_ten','ngonngu_flag'], 'safe'],

            [[Ngonngu::ngonngu_code], 'required'],
            [[Ngonngu::ngonngu_trangthai, Ngonngu::ngonngu_macdinh], 'string'],
            [[Ngonngu::ngonngu_code], 'string', 'max' => 2],
            [[Ngonngu::ngonngu_ten], 'string', 'max' => 20],
            [[Ngonngu::ngonngu_flag], 'string', 'max' => 255],
        ];
    }



    public function attributeLabels()
    {
        return [
                        
            Ngonngu::ngonngu_id => Ngonngu::__ngonngu_id ,                        
            Ngonngu::ngonngu_code => Ngonngu::__ngonngu_code ,                        
            Ngonngu::ngonngu_ten => Ngonngu::__ngonngu_ten ,                        
            Ngonngu::ngonngu_trangthai => Ngonngu::__ngonngu_trangthai ,                        
            Ngonngu::ngonngu_macdinh => Ngonngu::__ngonngu_macdinh ,];
    }


     public function beforeSave($insert)
    {
        $this->ngonngu_id = $this[Sanphamngonngu::ngonngu_id];
        $this->ngonngu_code = $this[Sanphamngonngu::ngonngu_code];
        $this->ngonngu_ten = $this[Sanphamngonngu::ngonngu_ten];
        $this->ngonngu_trangthai = $this[Sanphamngonngu::ngonngu_trangthai];
        $this->ngonngu_macdinh = $this[Sanphamngonngu::ngonngu_macdinh];
        $this->ngonngu_flag = $this[Sanphamngonngu::ngonngu_flag];

        return true;
    }




     public function afterFind()
    {   
        $this[Ngonngu::ngonngu_id] =  $this->ngonngu_id; 
        $this[Ngonngu::ngonngu_code] =  $this->ngonngu_code;
        $this[Ngonngu::ngonngu_ten] =  $this->ngonngu_ten;
        $this[Ngonngu::ngonngu_trangthai] =  $this->ngonngu_trangthai;
        $this[Ngonngu::ngonngu_macdinh] =  $this->ngonngu_macdinh; 
        $this[Ngonngu::ngonngu_flag] =  $this->ngonngu_flag;
        
      // print_r($this);die;

        parent::afterFind();
    }  


}
