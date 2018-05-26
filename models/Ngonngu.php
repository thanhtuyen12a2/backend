<?php
namespace backend\models;
use Aabc;

class Ngonngu extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        return Aabc::$app->_ngonngu->table;        
    }

    const table = 'db_ngonngu';
    //Action
    // const index_sp = 'g8';
    // const index_bv = 'd3';

    // const update_sp = 'u';
    // const update_bv = 'u_b';

    //Name   
    const name = 'gonngu_fake';
    const t = 'n'.self::name;
    const T = 'N'.self::name;
    //Model
    const M = 'backend\models\\'. self::T ;
    const S = 'backend\models\\'. self::T .'Search';


    const ngonngu_code = 'r2';
    const ngonngu_trangthai = 'w4';
    const ngonngu_macdinh = 'p9';
    const ngonngu_ten = 'k7';
    const ngonngu_flag = 'l8';
    const ngonngu_id = 'h5';
    
    const __ngonngu_code = 'ngonngu_code';
    const __ngonngu_trangthai = 'ngonngu_trangthai';
    const __ngonngu_macdinh = 'ngonngu_macdinh';
    const __ngonngu_ten = 'ngonngu_ten';
    const __ngonngu_flag = 'ngonngu_flag';
    const __ngonngu_id = 'ngonngu_id';


    const TRANGTHAI_ON = 1;
    const TRANGTHAI_OFF = 2;

    const MACDINH_ON = 1;
    const MACDINH_OFF = 2;

    const TRONGTHUNGRAC = 2;
    const NGOAITHUNGRAC = 1;

  

     public function getAll()
    {        
        return   (Ngonngu::M)::find()
                        ->andwhere(['ngonngu_trangthai' => Ngonngu::TRANGTHAI_ON ])
                        ->orderBy(['ngonngu_macdinh' => SORT_ASC])
                        ->all();
    }


    public function getAllRecycle1()
   {
        $_Ngonngu = Aabc::$app->_model->Ngonngu;
       return   $_Ngonngu::find()
                           ->andWhere([Aabc::$app->_ngonngu->ngonngu_recycle => '1'])
                           ->all();
   }
   public function getAllRecycle0()
   {
       $_Ngonngu = Aabc::$app->_model->Ngonngu;
       return   $_Ngonngu::find()
                           ->andWhere([Aabc::$app->_ngonngu->ngonngu_recycle => '2'])                            
                           ->all();
   }
    public function getAllStatus1()
   {
       $_Ngonngu = Aabc::$app->_model->Ngonngu;
       return   $_Ngonngu::find()
                           ->andWhere([Aabc::$app->_ngonngu->ngonngu_status => '1'])
                           ->andWhere([Aabc::$app->_ngonngu->ngonngu_recycle => '2'])
                           ->all();
   }
    public function getAllStatus2()
   {
       $_Ngonngu = Aabc::$app->_model->Ngonngu;
       return   $_Ngonngu::find()
                           ->andWhere([Aabc::$app->_ngonngu->ngonngu_status => '2'])
                           ->andWhere([Aabc::$app->_ngonngu->ngonngu_recycle => '2'])
                           ->all();
   }



    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getDanhmucNgonngus()
    {
        $_DanhmucNgonngu = Aabc::$app->_model->DanhmucNgonngu;
return $this->hasMany($_DanhmucNgonngu::className(), [Aabc::$app->_danhmucngonngu->dmnn_id_ngonngu => Aabc::$app->_ngonngu->ngonngu_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getDmnnIdDanhmucs()
    {
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
return $this->hasMany($_Danhmuc::className(), [Aabc::$app->_danhmuc->dm_id => Aabc::$app->_db_danhmuc_ngonngu->dmnn_id_danhmuc])->viaTable(Aabc::$app->_db_danhmuc_ngonngu->table, [Aabc::$app->_db_danhmuc_ngonngu->dmnn_id_ngonngu => Aabc::$app->_ngonngu->ngonngu_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getGrouptinhnangNgonngus()
    {
        $_GrouptinhnangNgonngu = Aabc::$app->_model->GrouptinhnangNgonngu;
return $this->hasMany($_GrouptinhnangNgonngu::className(), [Aabc::$app->_grouptinhnangngonngu->gtnnn_ngonngu => Aabc::$app->_ngonngu->ngonngu_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getGtnnnIdgrouptinhnangs()
    {
        $_Grouptinhnang = Aabc::$app->_model->Grouptinhnang;
return $this->hasMany($_Grouptinhnang::className(), [Aabc::$app->_grouptinhnang->gtn_id => Aabc::$app->_db_grouptinhnang_ngonngu->gtnnn_idgrouptinhnang])->viaTable(Aabc::$app->_db_grouptinhnang_ngonngu->table, [Aabc::$app->_grouptinhnang->gtnnn_ngonngu => Aabc::$app->_ngonngu->ngonngu_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getKhuyenmaiNgonngus()
    {
        $_KhuyenmaiNgonngu = Aabc::$app->_model->KhuyenmaiNgonngu;
return $this->hasMany($_KhuyenmaiNgonngu::className(), [Aabc::$app->_khuyenmaingonngu->kmnn_ngonngu => Aabc::$app->_ngonngu->ngonngu_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getKmnnIdkhuyenmais()
    {
        $_Khuyenmai = Aabc::$app->_model->Khuyenmai;
return $this->hasMany($_Khuyenmai::className(), [Aabc::$app->_khuyenmai->km_id => Aabc::$app->_db_khuyenmai_ngonngu->kmnn_idkhuyenmai])->viaTable(Aabc::$app->_db_khuyenmai_ngonngu->table, [Aabc::$app->_khuyenmai->kmnn_ngonngu => Aabc::$app->_ngonngu->ngonngu_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getMenuNgonngus()
    {
        $_MenuNgonngu = Aabc::$app->_model->MenuNgonngu;
return $this->hasMany($_MenuNgonngu::className(), [Aabc::$app->_menungonngu->mnnn_idngonngu => Aabc::$app->_ngonngu->ngonngu_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getMnnnIdmenus()
    {
        $_Menu = Aabc::$app->_model->Menu;
return $this->hasMany($_Menu::className(), [Aabc::$app->_menu->menu_id => Aabc::$app->_db_menu_ngonngu->mnnn_idmenu])->viaTable(Aabc::$app->_db_menu_ngonngu->table, [Aabc::$app->_menu->mnnn_idngonngu => Aabc::$app->_ngonngu->ngonngu_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSanphamNgonngus()
    {
        $_SanphamNgonngu = Aabc::$app->_model->SanphamNgonngu;
return $this->hasMany($_SanphamNgonngu::className(), [Aabc::$app->_sanphamngonngu->spnn_idngonngu => Aabc::$app->_ngonngu->ngonngu_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSpnnIdsanphams()
    {
        $_Sanpham = Aabc::$app->_model->Sanpham;
return $this->hasMany($_Sanpham::className(), [Aabc::$app->_sanpham->sp_id => Aabc::$app->_db_sanpham_ngonngu->spnn_idsanpham])->viaTable(Aabc::$app->_db_sanpham_ngonngu->table, [Aabc::$app->_db_sanpham_ngonngu->spnn_idngonngu => Aabc::$app->_ngonngu->ngonngu_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getThuonghieuNgonngus()
    {
        $_ThuonghieuNgonngu = Aabc::$app->_model->ThuonghieuNgonngu;
return $this->hasMany($_ThuonghieuNgonngu::className(), [Aabc::$app->_thuonghieungonngu->thnn_idngonngu => Aabc::$app->_ngonngu->ngonngu_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getThnnIdthuonghieus()
    {
        $_Thuonghieu = Aabc::$app->_model->Thuonghieu;
return $this->hasMany($_Thuonghieu::className(), [Aabc::$app->_thuonghieu->thuonghieu_id => Aabc::$app->_db_thuonghieu_ngonngu->thnn_idthuonghieu])->viaTable(Aabc::$app->_db_thuonghieu_ngonngu->table, [Aabc::$app->_db_thuonghieu_ngonngu->thnn_idngonngu => Aabc::$app->_ngonngu->ngonngu_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getTinhnangNgonngus()
    {
        $_TinhnangNgonngu = Aabc::$app->_model->TinhnangNgonngu;
return $this->hasMany($_TinhnangNgonngu::className(), [Aabc::$app->_tinhnangngonngu->tnnn_idngonngu => Aabc::$app->_ngonngu->ngonngu_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getTnnnIdtinhnangs()
    {
        $_Tinhnang = Aabc::$app->_model->Tinhnang;
return $this->hasMany($_Tinhnang::className(), [Aabc::$app->_tinhnang->tinhnang_id => Aabc::$app->_db_tinhnang_ngonngu->tnnn_idtinhnang])->viaTable(Aabc::$app->_db_tinhnang_ngonngu->table, [Aabc::$app->_db_tinhnang_ngonngu->tnnn_idngonngu => Aabc::$app->_ngonngu->ngonngu_id]);
    }





}
