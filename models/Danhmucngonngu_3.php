<?php
namespace backend\models;
use Aabc;

class Danhmucngonngu_3 extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        return Danhmucngonngu::table;        
    }

    private $_attributes; //Array Danh muc    
    public function __construct() {
        $this->_attributes = [
            Danhmucngonngu::dmnn_id_danhmuc => null,
            Danhmucngonngu::dmnn_id_ngonngu => null,
            Danhmucngonngu::dmnn_ten => null,
            Danhmucngonngu::dmnn_mota => null,
            Danhmucngonngu::dmnn_tieudeseo => null,
            Danhmucngonngu::dmnn_motaseo => null,             
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
        $_Ngonngu = Aabc::$app->_model->Ngonngu ;
        return [
            [['dmnn_id_danhmuc','dmnn_id_ngonngu','dmnn_ten','dmnn_mota','dmnn_tieudeseo','dmnn_motaseo'],'safe'],

            [[Danhmucngonngu::dmnn_id_ngonngu, Danhmucngonngu::dmnn_id_danhmuc, Danhmucngonngu::dmnn_ten], 'required'],
            [[Danhmucngonngu::dmnn_id_ngonngu, Danhmucngonngu::dmnn_id_danhmuc], 'integer'],
            
            [[Danhmucngonngu::dmnn_ten], 'string', 'max' => 50],
            [[Danhmucngonngu::dmnn_mota], 'string', 'max' => 255],
            [[Danhmucngonngu::dmnn_tieudeseo], 'string', 'max' => 100],
            [[Danhmucngonngu::dmnn_motaseo], 'string', 'max' => 160],
            
            
            [[Danhmucngonngu::dmnn_id_ngonngu], 'exist', 'skipOnError' => true, 'targetClass' => $_Ngonngu::className(), 'targetAttribute' => [Danhmucngonngu::dmnn_id_ngonngu => Aabc::$app->_ngonngu->ngonngu_id]],
            [[Danhmucngonngu::dmnn_id_danhmuc], 'exist', 'skipOnError' => true, 'targetClass' => Danhmuc::className(), 'targetAttribute' => [Danhmucngonngu::dmnn_id_danhmuc => 'dm_id']],
        ];
    }

    public function attributeLabels()
    {
        return [           
            Danhmucngonngu::dmnn_id_danhmuc => Danhmucngonngu::__dmnn_id_danhmuc ,                        
            Danhmucngonngu::dmnn_id_ngonngu => Danhmucngonngu::__dmnn_id_ngonngu ,                        
            Danhmucngonngu::dmnn_ten => Danhmucngonngu::__dmnn_ten ,                        
            Danhmucngonngu::dmnn_mota => Danhmucngonngu::__dmnn_mota ,                        
            Danhmucngonngu::dmnn_tieudeseo => Danhmucngonngu::__dmnn_tieudeseo ,
            Danhmucngonngu::dmnn_motaseo => Danhmucngonngu::__dmnn_motaseo ,            
        ];
    }
 
    public function beforeSave($insert)
    {
        $this->dmnn_id_danhmuc = $this[Danhmucngonngu::dmnn_id_danhmuc];
        $this->dmnn_id_ngonngu = $this[Danhmucngonngu::dmnn_id_ngonngu];
        $this->dmnn_ten = $this[Danhmucngonngu::dmnn_ten];
        $this->dmnn_mota = $this[Danhmucngonngu::dmnn_mota];
        $this->dmnn_tieudeseo = $this[Danhmucngonngu::dmnn_tieudeseo];
        $this->dmnn_motaseo = $this[Danhmucngonngu::dmnn_motaseo];        
        return true;
    }


     public function afterFind()
    {   
        $this[Danhmucngonngu::dmnn_id_danhmuc] =  $this->dmnn_id_danhmuc; 
        $this[Danhmucngonngu::dmnn_id_ngonngu] =  $this->dmnn_id_ngonngu;
        $this[Danhmucngonngu::dmnn_ten] =  $this->dmnn_ten;
        $this[Danhmucngonngu::dmnn_mota] =  $this->dmnn_mota;
        $this[Danhmucngonngu::dmnn_tieudeseo] =  $this->dmnn_tieudeseo;
        $this[Danhmucngonngu::dmnn_motaseo] =  $this->dmnn_motaseo;
        
        parent::afterFind();
    }  


}
