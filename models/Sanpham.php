<?php
namespace backend\models;
use Aabc;
use aabc\helpers\ArrayHelper;
use common\cont\_SANPHAM;
use common\cont\D;
use common\components\Tuyen;

class Sanpham extends \aabc\db\ActiveRecord
{    
    public static function tableName()
    {
        return self::table;        
    }
    
    const table = 'db_sanpham';

    //Action
    const index_sp = 'g8';
    const index_bv = 'd3';
    const update_sp = 'u';
    const update_bv = 'u_b';
    const action_thongso = 'j3';
    const dddspdm = 'h8';
    const search = 's3';
    const addspdm = 'p9';
    const removespdmnb = 'e9';
    const fristspdmnb = 'u3';
    const addalbum = 'y8';

    public function actionController()
    {
        return [
          Sanpham::tt.':'.Sanpham::index_sp => 'sanpham/i',
          Sanpham::tt.':'.Sanpham::index_bv => 'sanpham/i_b',
          Sanpham::tt.':'.Sanpham::update_sp => 'sanpham/u',
          Sanpham::tt.':'.Sanpham::update_bv => 'sanpham/u_b',
          Sanpham::tt.':'.Sanpham::search => 'sanpham/search',
          Sanpham::tt.':'.Sanpham::addspdm => 'sanpham/addspdm',
          Sanpham::tt.':'.Sanpham::removespdmnb => 'sanpham/removespdmnb',
          Sanpham::tt.':'.Sanpham::fristspdmnb => 'sanpham/fristspdmnb',
          Sanpham::tt.':'.Sanpham::addalbum => 'sanpham/addalbum',

          Sanpham::tt.':c' => 'sanpham/c',
          Sanpham::tt.':ut' => 'sanpham/ut',
          Sanpham::tt.':rec' => 'sanpham/rec',
          Sanpham::tt.':ir' => 'sanpham/ir',
          Sanpham::tt.':'.Sanpham::action_thongso => 'sanpham/thongso',
        ];
    }

    //Controller
    const tt = 'k5';
    const name = 'anpham_235';    
    const t = 's'.self::name;
    const T = 'S'.self::name;

    //Model
    const M = 'backend\models\\'. self::T ;
    const S = 'backend\models\\'. self::T .'Search';

   
      //
     const sp_id = 'k45';
     const sp_ma = 'h28';
     const sp_type = 'g57';
     const sp_tensp = 'k93';
     const sp_masp = 'b58';
     const sp_linkseo = 'l98';
     const sp_motaseo = 'b12';
     const sp_linkanhdaidien = 'd73';
     const sp_images = 'q76';
     const sp_album = 'k67';
     const sp_status = 'w72';
     const sp_recycle = 'e47';
     const sp_conhang = 'r47';
     const sp_view = 't82';
     const sp_ngaytao = 'u19';
     const sp_ngayupdate = 'i49';
     const sp_idnguoitao = 'o99';
     const sp_idnguoiupdate = 'p49';
     const sp_id_ncc = 'a23';
     const sp_id_thuonghieu = 's74';
     const sp_gia = 'd53';
     const sp_gia_sort = 'k1';
     const sp_giakhuyenmai = 'f22';
     const sp_soluong = 'g85';
     const sp_soluongfake = 'h76';
     const sp_soluotmua = 'j88';
    //Thêm
     const sp_id_danhmuc = 'k22';
     const sp_id_chinhsach = 'l44';


     //Chỉ để trao đổi du liệu, ko có trong bảng
     const sp_noibat = 'i7';



     const __sp_id = 'ID';
     const __sp_ma = 'ID';
     const __sp_type = 'sp_type';
     const __sp_tensp = 'Tên sản phẩm';
     const __sp_masp = 'Mã sản phẩm';
     const __sp_linkseo = 'Link seo';
     const __sp_motaseo = 'Mô tả seo';
     const __sp_linkanhdaidien = 'sp_linkanhdaidien';
     const __sp_images = 'sp_images';
     const __sp_album = 'sp_album';
     const __sp_status = 'Trạng thái';
     const __sp_recycle = 'sp_recycle';
     const __sp_conhang = 'Tình trạng';
     const __sp_view = 'Lượt xem';
     const __sp_ngaytao = 'Ngày đăng';
     const __sp_ngayupdate = 'Ngày cập nhật';
     const __sp_idnguoitao = 'Người đăng';
     const __sp_idnguoiupdate = 'Người cập nhật';
     const __sp_id_ncc = 'NCC';
     const __sp_id_thuonghieu = 'Thương hiệu';
     const __sp_gia = 'Giá';
     const __sp_giakhuyenmai = 'sp_giakhuyenmai';
     const __sp_soluong = 'Số lượng';
     const __sp_soluongfake = 'sp_soluongfake';
     const __sp_soluotmua = 'sp_soluotmua';
    //Thêm
     const __sp_id_danhmuc = 'Danh mục';
     const __sp_id_chinhsach = 'Chính sách';



    const TRONGTHUNGRAC = 2;
    const NGOAITHUNGRAC = 1;

    const CONHANG = 1;
    const TAMHET = 2;
    const SAPVE = 3;
    const NGUNGBAN = 4;


    const XUATBAN = 1;
    const KHONGHIENTHI = 2;

    const SANPHAM = 1;
    const BAIVIET = 2;



    public static function cache($model)
    {
        $cache = Aabc::$app->dulieu;
        $cache_data = $model->attributes;       
        $cache_data['sp_linkseo'] = $model->sp_linkseo . '-'.D::url_sp.$model->sp_id.'.html'; 
        $cache_data['sp_listdm']['1'] = Sanpham::getSpdmIdDanhmucs($model)->andWhere(['dm_type' => 1])->column();
        $cache_data['sp_listdm']['2'] = Sanpham::getSpdmIdDanhmucs($model)->andWhere(['dm_type' => 2])->column();
        $cache_data['sp_listdm']['3'] = Sanpham::getSpdmIdDanhmucs($model)->andWhere(['dm_type' => 3])->column();
        $cache_data['sp_listdm']['4'] = Sanpham::getSpdmIdDanhmucs($model)->andWhere(['dm_type' => 4])->column();
        $cache_data['sp_listdm']['5'] = Sanpham::getSpdmIdDanhmucs($model)->andWhere(['dm_type' => 5])->column();

        $cache->set('sanpham'.$model->sp_id,$cache_data);
        return $cache_data; 
    }




     public static function getOptionsFind($q = NULL, $dm = ''){
        $sp = (Sanpham::M)::find()
                    ->select(['sp_id','sp_tensp','sp_images'])
                    ->andWhere(['like','sp_tensp',$q])
                    ->andWhere(['sp_type' => self::SANPHAM])
                    ->andWhere(['sp_recycle' => self::NGOAITHUNGRAC])
                    ->andWhere(['sp_status' => self::XUATBAN])
                    ->asArray()
                    ->limit(20)                    
                    ->all(); 
          if ($sp) {  
            $return = [];
            foreach ($sp as $k => $v) {   
                $img = '';
                if(!empty($v['sp_images'])){
                  $img_arr = explode('-', $v['sp_images']);
                  $img = $img_arr[0];
                }

                if(empty($img)){
                  $img = '';
                }else{
                  $img = Tuyen::_dulieu('image', $img, '25x25');
                }

                $_Sanphamdanhmuc = Aabc::$app->_model->Sanphamdanhmuc;                
                $spdm = $_Sanphamdanhmuc::find()
                                ->andWhere(['spdm_id_sp' => $v['sp_id']])
                                ->andWhere(['spdm_id_danhmuc' => $dm])
                                ->one();

                if($spdm){
                  $return[$k] = [
                        'id' => $v['sp_id'],
                        'text' => $v['sp_tensp'],
                        'img' => $img,
                        'check' => 'true',
                    ];
                }
                else{
                  $return[$k] = [
                        'id' => $v['sp_id'],
                        'text' => $v['sp_tensp'],
                        'img' => $img,
                    ];
                }
            }
            return $return;
        }
        return [];
    }




    public static function one($id='')
    {      
      // $t = Aabc::$app->dulieu;
      // $data = $t->get('get_sp_'.$id);
      //   if ($data === false){
            $data = (Sanpham::T)::find()->andWhere([Sanpham::sp_id => $id])->asArray()->one();
            // $t->set('get_sp_'.$id, $data);
        // }
        return $data;
    }


    public static function getConhangOptionColor(){
      return [    
           // ''  => '--Chọn--',    
          self::CONHANG => 'Còn hàng##mgr',
          self::TAMHET => 'Tạm hết##mbl',
          self::SAPVE => 'Hàng sắp về##mgr',
          self::NGUNGBAN => 'Ngừng kinh doanh##mre',
      ];
    }
    public static function getConhangOption(){
      return [     
          // ''  => '--Chọn--',
          self::CONHANG => 'Còn hàng',
          self::TAMHET => 'Tạm hết',
          self::SAPVE => 'Hàng sắp về',
          self::NGUNGBAN => 'Ngừng kinh doanh',
      ];
    }
    public static function getConhangLabel($value = NULL){
      $array = self::getConhangOption();
        if ($value === null || !array_key_exists($value, $array))
            return ' - ';
        return $array[$value];
    }
    public static function getConhangLabelColor($value = NULL){
      $array = [     
          // ''  => '--Chọn--',
          self::CONHANG => '<div class="text-center bg-success">Còn hàng</div>',
          self::TAMHET => '<div class="text-center bg-danger">Tạm hết</div>',
          self::SAPVE => '<div class="text-center bg-info">Hàng sắp về</div>',
          self::NGUNGBAN => '<div class="text-center bg-default">Ngừng kinh doanh</div>',
      ];
        if ($value === null || !array_key_exists($value, $array))
            return ' - ';
        return $array[$value];
    }



    public static function getTrangthaiOptionColor(){
      return [    
           // ''  => '--Chọn--',    
          self::XUATBAN => 'Xuất bản##mgr',
          self::KHONGHIENTHI => 'Bản nháp##mre',          
      ];
    }
    public static function getTrangthaiOption(){
      return [ 
           // ''  => '--Chọn--',       
          self::XUATBAN => 'Xuất bản',
          self::KHONGHIENTHI => 'Bản nháp',          
      ];
    }
    public static function getTrangthaiLabel($value = NULL){
      $array = self::getTrangthaiOption();
        if ($value === null || !array_key_exists($value, $array))
            return ' - ';
        return $array[$value];
    }

    public static function getTrangthaiLabelColor($value = NULL){      
      $array = [ 
           // ''  => '--Chọn--',       
          self::XUATBAN => '<div class="text-center bg-success">Xuất bản</div>',
          self::KHONGHIENTHI => 'Bản nháp',          
      ];
        if ($value === null || !array_key_exists($value, $array))
            return ' - ';
        return $array[$value];
    }


/////////////////////////Lien ket bang
    //Sanpham -1--n- Sanphamngonngu   -n--1- Ngonngu

    //Lấy Danh sách Sanphamngonngu có idsanpham
    public function getSanphamNgonngus($model)
    {        
      // return $this->hasMany(SanphamNgonngu::className(), ['spnn_idsanpham' => 'sp_id']);
      return $model->hasMany((Sanphamngonngu::M)::className(), ['spnn_idsanpham' => 'sp_id']);
    }    

    //Lấy Danh sách Ngonngu có quan hệ với sản phẩm này, thông qua bảng sanphamngonngu
    public function getSpnnIdngonngus($model)
    {        
      return $model->hasMany((Ngonngu::M)::className(), ['ngonngu_id' => 'spnn_idngonngu'])->viaTable('db_sanpham_ngonngu', ['spnn_idsanpham' => 'sp_id']);
    }




    public function getSpdmIdDanhmucs($model)
    {
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
        return $model->hasMany($_Danhmuc::className(), [Aabc::$app->_danhmuc->dm_id => Aabc::$app->_sanphamdanhmuc->spdm_id_danhmuc])->viaTable(Aabc::$app->_sanphamdanhmuc->table, [Aabc::$app->_sanphamdanhmuc->spdm_id_sp => Sanpham::sp_id])->andWhere(['dm_type' => 1]);
    }

    public function getSpdmIdDanhmucs_join()
    {
        $model = $this;
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
        return $model->hasMany($_Danhmuc::className(), ['dm_id' => 'spdm_id_danhmuc'])->viaTable(Aabc::$app->_sanphamdanhmuc->table, ['spdm_id_sp' => 'sp_id'])->andWhere(['dm_type' => 4])->orderBy(['spdm_sothutu' => SORT_DESC]);
    }

    public function getSpdmIdDanhmucsThongso($model)
    {
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
        return $model->hasMany($_Danhmuc::className(), [Aabc::$app->_danhmuc->dm_id => Aabc::$app->_sanphamdanhmuc->spdm_id_danhmuc])->viaTable(Aabc::$app->_sanphamdanhmuc->table, [Aabc::$app->_sanphamdanhmuc->spdm_id_sp => Sanpham::sp_id])->andWhere(['dm_level' => 2])->andWhere(['is not','dm_dmsp',null]);
    }











    public function getAllRecycle1_1()
   {      
      // $_Sanpham = Aabc::$app->_model->Sanpham;
       return   (Sanpham::M)::find()
                           ->andWhere(['sp_recycle' => Sanpham::TRONGTHUNGRAC])
                           ->andWhere(['sp_type' => Sanpham::SANPHAM])
                           // ->all();
                           ->count();
   }
    public function getAllRecycle1_2()
   {
       return   (Sanpham::M)::find()
                           ->andWhere(['sp_recycle' => Sanpham::TRONGTHUNGRAC])
                           ->andWhere(['sp_type' => Sanpham::BAIVIET])
                           ->all();
   }


   







   
   public function getAllRecycle0_1()
   {
       $_Sanpham = Aabc::$app->_model->Sanpham;
       return   (Sanpham::M)::find()
                           ->andWhere([Sanpham::sp_recycle => '2'])
                           ->andWhere([Sanpham::sp_type => '1'])
                           ->all();
   }
    public function getAllRecycle0_2()
   {
       $_Sanpham = Aabc::$app->_model->Sanpham;
       return   (Sanpham::M)::find()
                           ->andWhere([Sanpham::sp_recycle => '2'])
                           ->andWhere([Sanpham::sp_type => '2'])
                           ->all();
   }








    public function getAll1_1()
   {
       $_Sanpham = Aabc::$app->_model->Sanpham;
       return   (Sanpham::M)::find()
                           ->andWhere([Sanpham::sp_status => '1'])
                           ->andWhere([Sanpham::sp_recycle => '2'])
                           ->andWhere([Sanpham::sp_type => '1'])
                           ->all();
   }

    public function getAll1_2()
   {
       $_Sanpham = Aabc::$app->_model->Sanpham;
       return   (Sanpham::M)::find()
                           ->andWhere([Sanpham::sp_status => '1'])
                           ->andWhere([Sanpham::sp_recycle => '2'])
                           ->andWhere([Sanpham::sp_type => '2'])
                           ->all();
   }





    public function getAll2_1()
   {
       $_Sanpham = Aabc::$app->_model->Sanpham;
       return   (Sanpham::M)::find()
                           ->andWhere([Sanpham::sp_status => '2'])
                           ->andWhere([Sanpham::sp_recycle => '2'])
                           ->andWhere([Sanpham::sp_type => '1'])
                           ->all();
   }

    public function getAll2_2()
   {
       $_Sanpham = Aabc::$app->_model->Sanpham;
       return   (Sanpham::M)::find()
                           ->andWhere([Sanpham::sp_status => '2'])
                           ->andWhere([Sanpham::sp_recycle => '2'])
                           ->andWhere([Sanpham::sp_type => '2'])
                           ->all();
   }

}
