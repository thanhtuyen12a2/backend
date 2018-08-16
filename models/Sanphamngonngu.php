<?php
namespace backend\models;
use Aabc;

class Sanphamngonngu extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        return Sanphamngonngu::table;        
    }

    const table = 'db_sanpham_ngonngu';


    const name = 'anphamngonngu_fake';
    const t = 's'.self::name;
    const T = 'S'.self::name;
    //Model
    const M = 'backend\models\\'. self::T ;
    const S = 'backend\models\\'. self::T .'Search';

    const spnn_idsanpham = 'k3';
    const spnn_idngonngu = 'f5';
    const spnn_ten = 'h7';
    const spnn_noidung = 'd1';
    const spnn_noidungbosung = 'o7';
    const spnn_noidungbosung_2 = 'l2';
    const spnn_noidungbosung_3 = 'j2';
    const spnn_gioithieu = 's2';
    const spnn_tieudeseo = 'e3';
    const spnn_motaseo = 't8';


    const __spnn_idsanpham = 'Id san pham';
    const __spnn_idngonngu = 'Id ngon ngu';
    const __spnn_ten = 'Tiêu đề';
    const __spnn_noidung = 'Nội dung';
    const __spnn_noidungbosung = 'Thông số kỹ thuật (Tóm tắt)';
    const __spnn_noidungbosung_2 = 'Thông số kỹ thuật (Đầy đủ)';
    const __spnn_noidungbosung_3 = 'Khuyến mại, Chính sách';
    const __spnn_gioithieu = 'Giới thiệu';
    const __spnn_tieudeseo = 'Tiêu đề seo';
    const __spnn_motaseo = 'Mô tả seo';



    public static function cache($model)
    {
        $cache = Aabc::$app->dulieu;
        $cache_data = $model->attributes;       
       
        $cache->set('spnn'.$model->spnn_idsanpham.'0'.$model->spnn_idngonngu, $cache_data);

        return $cache_data; 
    }



    public function getSpnnIdngonngu($model)
    {        
        return $model->hasOne((Ngonngu::M)::className(), ['ngonngu_id' => 'spnn_idngonngu']);
    }
   

    public function getSpnnIdsanpham($model)
    {        
        return $model->hasOne((Sanpham::M)::className(), ['sp_id' => 'spnn_idsanpham']);
    }





}
