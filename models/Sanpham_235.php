<?php
namespace backend\models;
use Aabc;
use aabc\helpers\ArrayHelper;
use common\cont\D;

class Sanpham_235 extends \aabc\db\ActiveRecord
{    
    public static function tableName()
    {
        return Sanpham::table;        
    }
    
    private $_attributes; //Array Danh muc    
    public function __construct() {
        $this->_attributes = [
            Sanpham::sp_id => null,
            Sanpham::sp_ma => null,
            Sanpham::sp_type => null,
            Sanpham::sp_tensp => null,
            Sanpham::sp_masp => null,
            Sanpham::sp_linkseo => null,
            Sanpham::sp_motaseo => null,
            Sanpham::sp_images => null,
            Sanpham::sp_status => null,
            Sanpham::sp_recycle => null,
            Sanpham::sp_conhang => null,
            Sanpham::sp_view => null,
            Sanpham::sp_ngaytao => null,
            Sanpham::sp_ngayupdate => null,
            Sanpham::sp_idnguoitao => null,
            Sanpham::sp_idnguoiupdate => null,
            Sanpham::sp_id_ncc => null,
            Sanpham::sp_id_thuonghieu => null,
            Sanpham::sp_gia => null,
            Sanpham::sp_gia_sort => null,
            Sanpham::sp_giakhuyenmai => null,
            Sanpham::sp_soluong => null,
            Sanpham::sp_soluongfake => null,
            Sanpham::sp_soluotmua => null,
            Sanpham::sp_id_danhmuc => null,
            Sanpham::sp_id_chinhsach => null,

            Sanpham::sp_noibat => null,
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
        $_User = Aabc::$app->_model->User;

        return [  
            [['sp_tensp','sp_id','sp_ma','sp_type','sp_masp','sp_linkseo','sp_motaseo','sp_images','sp_status','sp_recycle','sp_conhang','sp_view','sp_ngaytao','sp_ngayupdate','sp_idnguoitao','sp_idnguoiupdate','sp_id_ncc','sp_id_thuonghieu','sp_gia','sp_gia_sort','sp_giakhuyenmai','sp_soluong','sp_soluongfake','sp_soluotmua','sp_id_danhmuc','sp_id_chinhsach'], 'safe'],
          // [['sp_tensp'], 'string'],
            [[Sanpham::sp_tensp,Sanpham::sp_linkseo, Sanpham::sp_ngaytao, Sanpham::sp_gia], 'required'],

            [[Sanpham::sp_id_danhmuc],'required' ,'when' => function($model){
              return $model->sp_type == 1;
            }],

            [[Sanpham::sp_type ,Sanpham::sp_images, Sanpham::sp_status, Sanpham::sp_recycle, Sanpham::sp_conhang], 'string'],
            // [[Sanpham::sp_gia,Sanpham::sp_giakhuyenmai], 'string', 'max' => 11],
            [[Sanpham::sp_ma,Sanpham::sp_view, Sanpham::sp_idnguoitao, Sanpham::sp_idnguoiupdate, Sanpham::sp_id_ncc, Sanpham::sp_id_thuonghieu,  Sanpham::sp_soluong, Sanpham::sp_soluongfake, Sanpham::sp_soluotmua], 'integer'],
            [[Sanpham::sp_ngaytao, Sanpham::sp_ngayupdate, Sanpham::sp_id_danhmuc,  Sanpham::sp_id_chinhsach], 'safe'],
            

            [[Sanpham::sp_gia, Sanpham::sp_gia_sort, Sanpham::sp_giakhuyenmai], 'string', 'max' => 50],  

            [[Sanpham::sp_masp], 'match', 'pattern' => '/^[a-zA-Z0-9_]+$/','message' => 'Chỉ nhập chữ và số'],
            [[Sanpham::sp_tensp], 'string', 'max' => 100],            
            [[Sanpham::sp_masp], 'string', 'max' => 20],
            // [[Sanpham::sp_masp], 'unique','message' => 'Đã bị trùng'],
            [['sp_masp'], 'unique','message' => 'Đã bị trùng'],
            
            // [[Sanpham::sp_masp], function ($attribute,$model) {
                    // if(!empty($model[Sanpham::sp_masp])){
                      // $m = (Sanpham::M)::find()->andWhere(['sp_masp' => $model[Sanpham::sp_masp]])->one();
                      // if ($m) {
                      //     $this->addError($attribute, 'Đã bị trùng.'.$model[Sanpham::sp_masp]);
                      // }else{
                          // $this->addError($attribute, $model->sp_masp);
                      // }
                    // }
                    // }],
            
            [[Sanpham::sp_linkseo], 'string', 'max' => 160],
            // [[Sanpham::sp_linkseo], 'url', 'defaultScheme' => 'http'],
            [[Sanpham::sp_linkseo], 'match', 'pattern' => '/^[a-z0-9_-]+$/','message' => 'Chỉ nhập chữ thường, số, dấu gạch ngang -'],
            [[Sanpham::sp_motaseo], 'string', 'max' => 160],            
            [[Sanpham::sp_images], 'string', 'max' => 255],
            
            [[Sanpham::sp_idnguoitao], 'exist', 'skipOnError' => true, 'targetClass' => $_User::className(), 'targetAttribute' => [Sanpham::sp_idnguoitao => Aabc::$app->_user->id]],
            [[Sanpham::sp_idnguoiupdate], 'exist', 'skipOnError' => true, 'targetClass' => $_User::className(), 'targetAttribute' => [Sanpham::sp_idnguoiupdate => Aabc::$app->_user->id]],

            [[Sanpham::sp_noibat],'safe'],
        ];
    }



    public function attributeLabels()
    {
        return [
                        
            Sanpham::sp_id => Sanpham::__sp_id ,                        
            Sanpham::sp_ma => Sanpham::__sp_ma ,
            Sanpham::sp_type => Sanpham::__sp_type ,
            Sanpham::sp_tensp => Sanpham::__sp_tensp ,                        
            Sanpham::sp_masp => Sanpham::__sp_masp ,                        
            Sanpham::sp_linkseo => Sanpham::__sp_linkseo ,                        
            Sanpham::sp_motaseo => Sanpham::__sp_motaseo , 
                                 
            Sanpham::sp_images => Sanpham::__sp_images ,                        
            Sanpham::sp_status => Sanpham::__sp_status ,                        
            Sanpham::sp_recycle => Sanpham::__sp_recycle ,                        
            Sanpham::sp_conhang => Sanpham::__sp_conhang ,                        
            Sanpham::sp_view => Sanpham::__sp_view ,                        
            Sanpham::sp_ngaytao => Sanpham::__sp_ngaytao ,                        
            Sanpham::sp_ngayupdate => Sanpham::__sp_ngayupdate ,                        
            Sanpham::sp_idnguoitao => Sanpham::__sp_idnguoitao ,                        
            Sanpham::sp_idnguoiupdate => Sanpham::__sp_idnguoiupdate ,                        
            Sanpham::sp_id_ncc => Sanpham::__sp_id_ncc ,                        
            Sanpham::sp_id_thuonghieu => Sanpham::__sp_id_thuonghieu , 
            
            Sanpham::sp_id_danhmuc => Sanpham::__sp_id_danhmuc ,  //Thêm, nên không có trong table
            Sanpham::sp_id_chinhsach => Sanpham::__sp_id_chinhsach ,  //Thêm, nên không có trong table

            Sanpham::sp_gia => Sanpham::__sp_gia ,
            Sanpham::sp_gia_sort => Sanpham::__sp_gia ,
            Sanpham::sp_giakhuyenmai => Sanpham::__sp_giakhuyenmai ,                        
            Sanpham::sp_soluong => Sanpham::__sp_soluong ,                        
            Sanpham::sp_soluongfake => Sanpham::__sp_soluongfake ,                        
            Sanpham::sp_soluotmua => Sanpham::__sp_soluotmua ,
          ];
    }



    public function beforeSave($insert)
    {
        // $this->sp_id = $this[Sanpham::sp_id]; 
        $this->sp_ma = strtoupper($this[Sanpham::sp_ma]);
        $this->sp_type = $this[Sanpham::sp_type]; 
        $this->sp_tensp = $this[Sanpham::sp_tensp]; 
        $this->sp_masp = $this[Sanpham::sp_masp]; 
        $this->sp_linkseo = $this[Sanpham::sp_linkseo]; 
        $this->sp_motaseo = $this[Sanpham::sp_motaseo]; 
        $this->sp_images = $this[Sanpham::sp_images]; 
        $this->sp_status = $this[Sanpham::sp_status]; 
        $this->sp_recycle = $this[Sanpham::sp_recycle]; 
        $this->sp_conhang = $this[Sanpham::sp_conhang]; 
        $this->sp_view = $this[Sanpham::sp_view]; 
        $this->sp_ngaytao = $this[Sanpham::sp_ngaytao]; 
        $this->sp_ngayupdate = $this[Sanpham::sp_ngayupdate]; 
        $this->sp_idnguoitao = $this[Sanpham::sp_idnguoitao]; 
        $this->sp_idnguoiupdate = $this[Sanpham::sp_idnguoiupdate]; 
        $this->sp_id_ncc = $this[Sanpham::sp_id_ncc]; 
        $this->sp_id_thuonghieu = $this[Sanpham::sp_id_thuonghieu]; 
        $this->sp_gia = $this[Sanpham::sp_gia];
        $this->sp_gia_sort = $this[Sanpham::sp_gia];
        $this->sp_giakhuyenmai = $this[Sanpham::sp_giakhuyenmai]; 
        $this->sp_soluong = $this[Sanpham::sp_soluong]; 
        $this->sp_soluongfake = $this[Sanpham::sp_soluongfake]; 
        $this->sp_soluotmua = $this[Sanpham::sp_soluotmua]; 
        $this->sp_id_danhmuc = $this[Sanpham::sp_id_danhmuc]; 
        $this->sp_id_chinhsach = $this[Sanpham::sp_id_chinhsach];    
        

        if($this->sp_type == 2 ){
            if(empty($this->sp_gia)) $this->sp_gia = '0';
            if(empty($this->sp_giakhuyenmai)) $this->sp_giakhuyenmai = '0';
        }

        if(!empty($this->sp_ngaytao)){
            $this->sp_ngaytao = date("Y-m-d H:i:s",time());
        }

        if(empty($this->sp_status)) $this->sp_status = '1';
        if(empty($this->sp_recycle)) $this->sp_recycle = '2';
        if(empty($this->sp_conhang)) $this->sp_conhang = '1';
            
        Sanpham::cache($this);       
        return true;
    }
   

     public function afterFind()
    {   
        // if(is_numeric($this->sp_gia)) $this->sp_gia = number_format($this->sp_gia).'đ';  
        // if(is_numeric($this->sp_giakhuyenmai)) $this->sp_giakhuyenmai = number_format($this->sp_giakhuyenmai) .'đ';

        $this[Sanpham::sp_id] =  $this->sp_id; 
        $this[Sanpham::sp_ma] =  $this->sp_ma;
        $this[Sanpham::sp_type] =  $this->sp_type;
        $this[Sanpham::sp_tensp] =  $this->sp_tensp;
        $this[Sanpham::sp_masp] =  $this->sp_masp; 
        $this[Sanpham::sp_linkseo] =  $this->sp_linkseo;
        $this[Sanpham::sp_motaseo] =  $this->sp_motaseo;
        $this[Sanpham::sp_images] =  $this->sp_images;
        $this[Sanpham::sp_status] =  $this->sp_status; 
        $this[Sanpham::sp_recycle] =  $this->sp_recycle;
        $this[Sanpham::sp_conhang] =  $this->sp_conhang;
        $this[Sanpham::sp_view] =  $this->sp_view;
        $this[Sanpham::sp_ngaytao] =  $this->sp_ngaytao;
        $this[Sanpham::sp_ngayupdate] =  $this->sp_ngayupdate; 
        $this[Sanpham::sp_idnguoitao] =  $this->sp_idnguoitao;
        $this[Sanpham::sp_idnguoiupdate] =  $this->sp_idnguoiupdate;
        $this[Sanpham::sp_id_ncc] =  $this->sp_id_ncc;
        $this[Sanpham::sp_id_thuonghieu] =  $this->sp_id_thuonghieu; 
        $this[Sanpham::sp_gia] =  $this->sp_gia;
        $this[Sanpham::sp_gia_sort] =  $this->sp_gia_sort;
        $this[Sanpham::sp_giakhuyenmai] =  $this->sp_giakhuyenmai;
        $this[Sanpham::sp_soluong] =  $this->sp_soluong;
        $this[Sanpham::sp_soluongfake] =  $this->sp_soluongfake; 
        $this[Sanpham::sp_soluotmua] =  $this->sp_soluotmua;
        $this[Sanpham::sp_id_danhmuc] =  $this->sp_id_danhmuc;
        $this[Sanpham::sp_id_chinhsach] =  $this->sp_id_chinhsach;
      
      // print_r($this);die;

        parent::afterFind();
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
          Sanpham::CONHANG => 'Còn hàng##mgr',
          Sanpham::TAMHET => 'Tạm hết##mbl',
          Sanpham::SAPVE => 'Hàng sắp về##mgr',
          Sanpham::NGUNGBAN => 'Ngừng kinh doanh##mre',
      ];
    }
    public static function getConhangOption(){
      return [     
          // ''  => '--Chọn--',
          Sanpham::CONHANG => 'Còn hàng',
          Sanpham::TAMHET => 'Tạm hết',
          Sanpham::SAPVE => 'Hàng sắp về',
          Sanpham::NGUNGBAN => 'Ngừng kinh doanh',
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
          Sanpham::CONHANG => '<div class="text-center bg-success">Còn hàng</div>',
          Sanpham::TAMHET => '<div class="text-center bg-danger">Tạm hết</div>',
          Sanpham::SAPVE => '<div class="text-center bg-info">Hàng sắp về</div>',
          Sanpham::NGUNGBAN => '<div class="text-center bg-default">Ngừng kinh doanh</div>',
      ];
        if ($value === null || !array_key_exists($value, $array))
            return ' - ';
        return $array[$value];
    }



    public static function getTrangthaiOptionColor(){
      return [    
           // ''  => '--Chọn--',    
          Sanpham::XUATBAN => 'Xuất bản##mgr',
          Sanpham::KHONGHIENTHI => 'Không hiển thị##mre',          
      ];
    }
    public static function getTrangthaiOption(){
      return [ 
           // ''  => '--Chọn--',       
          Sanpham::XUATBAN => 'Xuất bản',
          Sanpham::KHONGHIENTHI => 'Không hiển thị',          
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
          Sanpham::XUATBAN => '<div class="text-center bg-success">Xuất bản</div>',
          Sanpham::KHONGHIENTHI => 'Không hiển thị',          
      ];
        if ($value === null || !array_key_exists($value, $array))
            return ' - ';
        return $array[$value];
    }





    public function getDanhmucList($type)
    {
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
        return $this->hasMany($_Danhmuc::className(), [Aabc::$app->_danhmuc->dm_id => Aabc::$app->_sanphamdanhmuc->spdm_id_danhmuc])
                    ->viaTable(Aabc::$app->_sanphamdanhmuc->table, [Aabc::$app->_sanphamdanhmuc->spdm_id_sp => Sanpham::sp_id])
                    ->andWhere(['dm_recycle' => $_Danhmuc::NGOAITHUNGRAC])
                    ->andWhere(['dm_type' => $type])
                    ->all();
    }








     /**
     * @return \aabc\db\ActiveQuery
     */
    public function getDathangnhacungcapChitiets()
    {
        $_DathangnhacungcapChitiet = Aabc::$app->_model->DathangnhacungcapChitiet;
return $this->hasMany($_DathangnhacungcapChitiet::className(), [Aabc::$app->_dathangnhacungcapchitiet->dhnccct_idsanpham => Sanpham::sp_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getDhnccctIddhnccs()
    {
        $_Dathangnhacungcap = Aabc::$app->_model->Dathangnhacungcap;
return $this->hasMany($_Dathangnhacungcap::className(), [Aabc::$app->_dathangnhacungcap->dhncc_id => Aabc::$app->_db_dathangnhacungcap_chitiet->dhnccct_iddhncc])->viaTable(Aabc::$app->_db_dathangnhacungcap_chitiet->table, [Aabc::$app->_dathangnhacungcap->dhnccct_idsanpham => Sanpham::sp_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getDonhangChitiets()
    {
        $_DonhangChitiet = Aabc::$app->_model->DonhangChitiet;
return $this->hasMany($_DonhangChitiet::className(), [Aabc::$app->_donhangchitiet->ddhct_idsanpham => Sanpham::sp_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getDdhctIddonhangs()
    {
        $_Donhang = Aabc::$app->_model->Donhang;
return $this->hasMany($_Donhang::className(), [Aabc::$app->_donhang->ddh_id => Aabc::$app->_db_donhang_chitiet->ddhct_iddonhang])->viaTable(Aabc::$app->_db_donhang_chitiet->table, [Aabc::$app->_donhang->ddhct_idsanpham => Sanpham::sp_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getKiemkekhoChitiets()
    {
        $_KiemkekhoChitiet = Aabc::$app->_model->KiemkekhoChitiet;
return $this->hasMany($_KiemkekhoChitiet::className(), [Aabc::$app->_kiemkekhochitiet->kkk_idsanpham => Sanpham::sp_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getKkkIdkiemkekhos()
    {
        $_Kiemkekho = Aabc::$app->_model->Kiemkekho;
return $this->hasMany($_Kiemkekho::className(), [Aabc::$app->_kiemkekho->kkk_id => Aabc::$app->_db_kiemkekho_chitiet->kkk_idkiemkekho])->viaTable(Aabc::$app->_db_kiemkekho_chitiet->table, [Aabc::$app->_kiemkekho->kkk_idsanpham => Sanpham::sp_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getPhieugiaohangChitiets()
    {
        $_PhieugiaohangChitiet = Aabc::$app->_model->PhieugiaohangChitiet;
return $this->hasMany($_PhieugiaohangChitiet::className(), [Aabc::$app->_phieugiaohangchitiet->pghct_idsanpham => Sanpham::sp_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getPghctIdphieugiaohangs()
    {
        $_Phieugiaohang = Aabc::$app->_model->Phieugiaohang;
return $this->hasMany($_Phieugiaohang::className(), [Aabc::$app->_phieugiaohang->pgh_id => Aabc::$app->_db_phieugiaohang_chitiet->pghct_idphieugiaohang])->viaTable(Aabc::$app->_db_phieugiaohang_chitiet->table, [Aabc::$app->_phieugiaohang->pghct_idsanpham => Sanpham::sp_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getPhieunhaphangChitiets()
    {
        $_PhieunhaphangChitiet = Aabc::$app->_model->PhieunhaphangChitiet;
return $this->hasMany($_PhieunhaphangChitiet::className(), [Aabc::$app->_phieunhaphangchitiet->pnhct_idsanpham => Sanpham::sp_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getPnhctIdphieunhaphangs()
    {
        $_Phieunhaphang = Aabc::$app->_model->Phieunhaphang;
return $this->hasMany($_Phieunhaphang::className(), [Aabc::$app->_phieunhaphang->pnh_id => Aabc::$app->_db_phieunhaphang_chitiet->pnhct_idphieunhaphang])->viaTable(Aabc::$app->_db_phieunhaphang_chitiet->table, [Aabc::$app->_phieunhaphang->pnhct_idsanpham => Sanpham::sp_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSpIdNcc()
    {
        $_Nhacungcap = Aabc::$app->_model->Nhacungcap;
        return $this->hasOne($_Nhacungcap::className(), [Aabc::$app->_nhacungcap->ncc_id => Sanpham::sp_id_ncc]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSpIdnguoitao()
    {
        $_User = Aabc::$app->_model->User;
return $this->hasOne($_User::className(), [Aabc::$app->_user->id => Sanpham::sp_idnguoitao]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSpIdnguoiupdate()
    {
        $_User = Aabc::$app->_model->User;
return $this->hasOne($_User::className(), [Aabc::$app->_user->id => Sanpham::sp_idnguoiupdate]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */


  public function getSanphamChinhsaches()
    {
        $_SanphamChinhsach = Aabc::$app->_model->SanphamChinhsach;
return $this->hasMany($_SanphamChinhsach::className(), [Aabc::$app->_sanphamchinhsach->spcs_id_sp => Sanpham::sp_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSpcsIdChinhsaches()
    {
        $_Chinhsach = Aabc::$app->_model->Chinhsach;
return $this->hasMany($_Chinhsach::className(), [Aabc::$app->_chinhsach->cs_id => Aabc::$app->_sanphamchinhsach->spcs_id_chinhsach])->viaTable(Aabc::$app->_sanphamchinhsach->table, [Aabc::$app->_sanphamchinhsach->spcs_id_sp => Sanpham::sp_id]);
    }






    
    public function getSanphamDanhmucs()
    {       
        return $this->hasMany(Sanphamdanhmuc::className(), ['spdm_id_sp' => 'sp_id']);
    }


    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSpdmIdDanhmucs()
    {
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
return $this->hasMany($_Danhmuc::className(), [Aabc::$app->_danhmuc->dm_id => Aabc::$app->_sanphamdanhmuc->spdm_id_danhmuc])->viaTable(Aabc::$app->_sanphamdanhmuc->table, [Aabc::$app->_sanphamdanhmuc->spdm_id_sp => Sanpham::sp_id]);
    }

    




    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSanphamKhohangs()
    {
        $_SanphamKhohang = Aabc::$app->_model->SanphamKhohang;
return $this->hasMany($_SanphamKhohang::className(), [Aabc::$app->_sanphamkhohang->spkh_id_sanpham => Sanpham::sp_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSpkhIdKhohangs()
    {
        $_Khohang = Aabc::$app->_model->Khohang;
return $this->hasMany($_Khohang::className(), [Aabc::$app->_khohang->khohang_id => Aabc::$app->_db_sanpham_khohang->spkh_id_khohang])->viaTable(Aabc::$app->_db_sanpham_khohang->table, [Aabc::$app->_khohang->spkh_id_sanpham => Sanpham::sp_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */



    /**
     * @return \aabc\db\ActiveQuery
     */
  
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSanphamTags()
    {
        $_SanphamTag = Aabc::$app->_model->SanphamTag;
return $this->hasMany($_SanphamTag::className(), [Aabc::$app->_sanphamtag->spt_id_sanpham => Sanpham::sp_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSptIdTags()
    {
        $_Tag = Aabc::$app->_model->Tag;
return $this->hasMany($_Tag::className(), [Aabc::$app->_tag->tag_id => Aabc::$app->_db_sanpham_tag->spt_id_tag])->viaTable(Aabc::$app->_db_sanpham_tag->table, [Aabc::$app->_db_sanpham_tag->spt_id_sanpham => Sanpham::sp_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSanphamTinhnangs()
    {
        $_SanphamTinhnang = Aabc::$app->_model->SanphamTinhnang;
return $this->hasMany($_SanphamTinhnang::className(), [Aabc::$app->_sanphamtinhnang->sptn_idsanpham => Sanpham::sp_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSptnIdtinhnangs()
    {
        $_Tinhnang = Aabc::$app->_model->Tinhnang;
return $this->hasMany($_Tinhnang::className(), [Aabc::$app->_tinhnang->tinhnang_id => Aabc::$app->_db_sanpham_tinhnang->sptn_idtinhnang])->viaTable(Aabc::$app->_db_sanpham_tinhnang->table, [Aabc::$app->_db_sanpham_tinhnang->sptn_idsanpham => Sanpham::sp_id]);
    }



}
