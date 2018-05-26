<?php
namespace backend\models;
use Aabc;

class Sanphamngonngu_fake extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        return Sanphamngonngu::table;        
    }

    private $_attributes; //Array Danh muc    
    public function __construct() {
        $this->_attributes = [
            Sanphamngonngu::spnn_idsanpham => null,
            Sanphamngonngu::spnn_idngonngu => null,
            Sanphamngonngu::spnn_ten => null,
            Sanphamngonngu::spnn_noidung => null,
            Sanphamngonngu::spnn_noidungbosung => null,
            Sanphamngonngu::spnn_noidungbosung_2 => null, 
            Sanphamngonngu::spnn_noidungbosung_3 => null, 
            Sanphamngonngu::spnn_gioithieu => null,
            Sanphamngonngu::spnn_tieudeseo => null,
            Sanphamngonngu::spnn_motaseo => null,                      
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
        $_Sanpham = Aabc::$app->_model->Sanpham ;
        return [
            [['spnn_idsanpham','spnn_idngonngu','spnn_ten','spnn_noidung','spnn_noidungbosung','spnn_noidungbosung_2','spnn_noidungbosung_2','spnn_gioithieu','spnn_tieudeseo','spnn_motaseo'],'safe'],

            [[Sanphamngonngu::spnn_idsanpham, Sanphamngonngu::spnn_idngonngu, Sanphamngonngu::spnn_ten,Sanphamngonngu::spnn_tieudeseo,Sanphamngonngu::spnn_motaseo], 'required'],
            [[Sanphamngonngu::spnn_idsanpham, Sanphamngonngu::spnn_idngonngu], 'integer'],
            [[Sanphamngonngu::spnn_noidung], 'string'],
            [[Sanphamngonngu::spnn_noidungbosung], 'string'],
            [[Sanphamngonngu::spnn_noidungbosung_2], 'string'],
            [[Sanphamngonngu::spnn_noidungbosung_3], 'string'],
            [[Sanphamngonngu::spnn_ten], 'string', 'max' => 70],
            
            
            [[Sanphamngonngu::spnn_gioithieu], 'string', 'max' => 160],
            [[Sanphamngonngu::spnn_idngonngu], 'exist', 'skipOnError' => true, 'targetClass' => $_Ngonngu::className(), 'targetAttribute' => [Sanphamngonngu::spnn_idngonngu => Aabc::$app->_ngonngu->ngonngu_id]],
            [[Sanphamngonngu::spnn_idsanpham], 'exist', 'skipOnError' => true, 'targetClass' => $_Sanpham::className(), 'targetAttribute' => [Sanphamngonngu::spnn_idsanpham => Aabc::$app->_sanpham->sp_id]],
        ];
    }

    public function attributeLabels()
    {
        return [                        
            Sanphamngonngu::spnn_idsanpham => Sanphamngonngu::__spnn_idsanpham ,                        
            Sanphamngonngu::spnn_idngonngu => Sanphamngonngu::__spnn_idngonngu ,                        
            Sanphamngonngu::spnn_ten => Sanphamngonngu::__spnn_ten ,                        
            Sanphamngonngu::spnn_noidung => Sanphamngonngu::__spnn_noidung ,                        
            Sanphamngonngu::spnn_noidungbosung => Sanphamngonngu::__spnn_noidungbosung ,
            Sanphamngonngu::spnn_noidungbosung_2 => Sanphamngonngu::__spnn_noidungbosung_2 ,
            Sanphamngonngu::spnn_noidungbosung_3 => Sanphamngonngu::__spnn_noidungbosung_3 ,
            Sanphamngonngu::spnn_gioithieu => Sanphamngonngu::__spnn_gioithieu,
            Sanphamngonngu::spnn_tieudeseo => Sanphamngonngu::__spnn_tieudeseo,
            Sanphamngonngu::spnn_motaseo => Sanphamngonngu::__spnn_motaseo, 
        ];
    }
 
    public function beforeSave($insert)
    {
        $this->spnn_idsanpham = $this[Sanphamngonngu::spnn_idsanpham];
        $this->spnn_idngonngu = $this[Sanphamngonngu::spnn_idngonngu];
        $this->spnn_ten = $this[Sanphamngonngu::spnn_ten];
        $this->spnn_noidung = $this[Sanphamngonngu::spnn_noidung];
        $this->spnn_noidungbosung = $this[Sanphamngonngu::spnn_noidungbosung];
        $this->spnn_noidungbosung_2 = $this[Sanphamngonngu::spnn_noidungbosung_2];
        $this->spnn_noidungbosung_3 = $this[Sanphamngonngu::spnn_noidungbosung_3];
        $this->spnn_gioithieu = $this[Sanphamngonngu::spnn_gioithieu];
        $this->spnn_tieudeseo = $this[Sanphamngonngu::spnn_tieudeseo];
        $this->spnn_motaseo = $this[Sanphamngonngu::spnn_motaseo];

        return true;
    }


     public function afterFind()
    {   
        $this[Sanphamngonngu::spnn_idsanpham] =  $this->spnn_idsanpham; 
        $this[Sanphamngonngu::spnn_idngonngu] =  $this->spnn_idngonngu;
        $this[Sanphamngonngu::spnn_ten] =  $this->spnn_ten;
        $this[Sanphamngonngu::spnn_noidung] =  $this->spnn_noidung;
        $this[Sanphamngonngu::spnn_noidungbosung] =  $this->spnn_noidungbosung;
        $this[Sanphamngonngu::spnn_noidungbosung_2] =  $this->spnn_noidungbosung_2;
        $this[Sanphamngonngu::spnn_noidungbosung_3] =  $this->spnn_noidungbosung_3;
        $this[Sanphamngonngu::spnn_gioithieu] =  $this->spnn_gioithieu; 
        $this[Sanphamngonngu::spnn_tieudeseo] =  $this->spnn_tieudeseo; 
        $this[Sanphamngonngu::spnn_motaseo] =  $this->spnn_motaseo;

        parent::afterFind();
    }  


}
