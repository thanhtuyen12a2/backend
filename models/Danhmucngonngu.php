<?php
namespace backend\models;
use Aabc;

class Danhmucngonngu extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        return Danhmucngonngu::table;        
    }

    const table = 'db_danhmuc_ngonngu';

    const name = 'anhmucngonngu_3';
    const t = 'd'.self::name;
    const T = 'D'.self::name;
    //Model
    const M = 'backend\models\\'. self::T ;
    const S = 'backend\models\\'. self::T .'Search';


    const dmnn_id_ngonngu = 'p3';
    const dmnn_id_danhmuc = 'j5';
    const dmnn_ten = 'l5';
    const dmnn_mota = 'm2';
    const dmnn_tieudeseo = 'r8';
    const dmnn_motaseo = 'c2';


    const __dmnn_id_ngonngu = 'Ngôn ngữ';
    const __dmnn_id_danhmuc = 'Danh mục';
    const __dmnn_ten = 'Tên';
    const __dmnn_mota = 'Giới thiệu';
    const __dmnn_tieudeseo = 'Tiêu đề seo';
    const __dmnn_motaseo = 'Mô tả seo';
   
    
    public static function cache($model)
    {
        $cache = Aabc::$app->dulieu;
        $cache_data = $model->attributes;       
       
        $cache->set('dmnn'.$model->dmnn_id_danhmuc.'01', $cache_data); //01 là idngonngu tieng viet
        return $cache_data; 
    }

    
    public function getDmnnIdNgonngu()
    {
        return $this->hasOne(Ngonngu::className(), ['ngonngu_id' => 'dmnn_id_ngonngu']);
    }

    
    public function getDmnnIdDanhmuc()
    {
        return $this->hasOne(Danhmuc::className(), ['dm_id' => 'dmnn_id_danhmuc']);
    }


}
