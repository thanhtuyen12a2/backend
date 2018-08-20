<?php
namespace backend\models;
use Aabc;
use aabc\helpers\ArrayHelper;
use common\cont\D;

class Danhmuc extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        return Aabc::$app->_danhmuc->table;        
    }

    const TRONGTHUNGRAC = 1;
    const NGOAITHUNGRAC = 2;

    const ON = 1;
    const OFF = 2;

    const SANPHAM = 1;
    const BAIVIET = 2;
    const NOIBAT = 3;
    const TINHNANG = 5;

    const MULTI = 1;
    const ONE = 2;

    public $list_sp_noibat;


    public $list_album;

    public function rules()
    {
        return [
            // [[Aabc::$app->_danhmuc->dm_ten], 'required'],
            [[Aabc::$app->_danhmuc->dm_idcha, Aabc::$app->_danhmuc->dm_thutu, Aabc::$app->_danhmuc->dm_sothutu, Aabc::$app->_danhmuc->dm_level, 'dm_groupmenu'], 'integer'],
            [[Aabc::$app->_danhmuc->dm_status, Aabc::$app->_danhmuc->dm_recycle, Aabc::$app->_danhmuc->dm_type], 'string'],

            [[Aabc::$app->_danhmuc->dm_id_chinhsach], 'safe'],

            [[Aabc::$app->_danhmuc->dm_ten], 'string', 'max' => 50],
            [[Aabc::$app->_danhmuc->dm_char, Aabc::$app->_danhmuc->dm_icon, Aabc::$app->_danhmuc->dm_background, Aabc::$app->_danhmuc->dm_ghichu], 'string', 'max' => 100],

            [[Aabc::$app->_danhmuc->dm_link], 'safe'],

            [['dm_link'], 'match', 'pattern' => '/^[a-z0-9_-]+$/','message' => 'Chỉ nhập chữ thường, số, dấu gạch ngang -', 'when' => function($model){
              return ($model->dm_type == 1 || $model->dm_type == 2);
            }],

            [['dm_email','dm_phone','dm_zalo','dm_skype'], 'string', 'max' => 100],

            [['dm_fb','dm_youtube','dm_viber'], 'string', 'max' => 100],

            [['dm_dmsp'], 'integer'],

            [['dm_multi'], 'integer'],

            [['dm_noibat'], 'integer'],

            [['dm_template'], 'string', 'max' => 100],

            [['dm_album'], 'string', 'max' => 255],

            [['dm_ten_ob'],'safe'],

            [['dm_showmax'], 'integer'],

            [['dm_allow_search'], 'integer'],


             [['dm_dmsp'], 'exist', 'skipOnError' => true, 'targetClass' => Danhmuc::className(), 'targetAttribute' => ['dm_dmsp' => 'dm_id']],

              [['dm_idcha'], 'exist', 'skipOnError' => true, 'targetClass' => Danhmuc::className(), 'targetAttribute' => ['dm_idcha' => 'dm_id']],


            [['list_sp_noibat'],'safe'],
            [['list_album'],'safe'],
            
            // [['dm_link'], 'match', 'pattern' => '/^[a-z0-9_-]+$/','message' => 'Chỉ nhập chữ thường, số, dấu gạch ngang -', 'when' => function($model){
            //     return ($model->dm_type != 4);
            // }],
        ];
    }



    public function attributeLabels()
    {
        return [
                        
            Aabc::$app->_danhmuc->dm_id => Aabc::$app->_danhmuc->__dm_id ,                        
            Aabc::$app->_danhmuc->dm_ten => Aabc::$app->_danhmuc->__dm_ten ,                        
            Aabc::$app->_danhmuc->dm_char => Aabc::$app->_danhmuc->__dm_char ,                        
            Aabc::$app->_danhmuc->dm_idcha => Aabc::$app->_danhmuc->__dm_idcha ,                        
            Aabc::$app->_danhmuc->dm_icon => Aabc::$app->_danhmuc->__dm_icon ,                        
            Aabc::$app->_danhmuc->dm_background => Aabc::$app->_danhmuc->__dm_background ,                        
            Aabc::$app->_danhmuc->dm_link => Aabc::$app->_danhmuc->__dm_link ,                        
            Aabc::$app->_danhmuc->dm_thutu => Aabc::$app->_danhmuc->__dm_thutu ,                        
            Aabc::$app->_danhmuc->dm_sothutu => Aabc::$app->_danhmuc->__dm_sothutu ,                        
            Aabc::$app->_danhmuc->dm_ghichu => Aabc::$app->_danhmuc->__dm_ghichu ,                        
            Aabc::$app->_danhmuc->dm_status => Aabc::$app->_danhmuc->__dm_status ,                        
            Aabc::$app->_danhmuc->dm_recycle => Aabc::$app->_danhmuc->__dm_recycle ,                        
            Aabc::$app->_danhmuc->dm_type => Aabc::$app->_danhmuc->__dm_type ,                        
            Aabc::$app->_danhmuc->dm_level => Aabc::$app->_danhmuc->__dm_level ,                 
            Aabc::$app->_danhmuc->dm_id_chinhsach => Aabc::$app->_danhmuc->__dm_id_chinhsach ,                 

            'dm_email' => 'Email',
            'dm_phone' => 'Điện thoại',

            'dm_fb' => 'Facebook',
            'dm_youtube' => 'Youtube',
            'dm_viber' => 'Viber',

            'dm_zalo' => 'Zalo',
            'dm_skype' => 'Skype',

            'dm_dmsp' => 'Danh mục sản phẩm',

            'dm_multi' => 'Lựa chọn',

            'dm_showmax' => 'Số hiển thị',

            'dm_allow_search' => 'Bật tìm kiếm',

            Aabc::$app->_danhmuc->dm_groupmenu => Aabc::$app->_danhmuc->__dm_groupmenu ,        ];
    }

    public static function cache($model)
    {
        $cache = Aabc::$app->dulieu;
        $cache_data = $model->attributes;

        // Aabc::error($model->dm_type);

        if($model->dm_type == 4){
          $cache_data['dm_listsp'] = $model::getIdSanphams($model)
                                        ->select(['`db_sanpham`.*,`db_sanpham_danhmuc`.*'])
                                        ->joinWith('spdmIdSp')
                                        ->orderBy(['spdm_sothutu' => SORT_DESC])
                                        ->andWhere(['sp_recycle' => '2'])
                                        ->andWhere(['sp_status' => '1'])
                                        // ->groupBy(['sp_id'])
                                        // ->all();
                                        ->column();
       
        }else{
          $cache_data['dm_listsp'] = $model::getSpdmIdSanphams($model)
                                        ->orderBy(['sp_id' => SORT_DESC])
                                        ->andWhere(['sp_recycle' => '2'])
                                        ->andWhere(['sp_status' => '1'])
                                        ->groupBy(['sp_id'])
                                        ->column();
        }


        if($model->dm_type == 1){

            //CS 1
            $km = $model::getChinhsach($model)
                          ->orderBy(['cs_id' => SORT_DESC])
                          ->where(['and',
                            ['cs_apdungcho' => Chinhsach::APDUNGDANHMUC],
                            ['cs_status' => Chinhsach::ON],
                            ['cs_recycle' => Chinhsach::NGOAITHUNGRAC],
                            ['cs_type' => Chinhsach::KHUYENMAI],
                        ])
                        ->column();
            $cache_data['dm_khuyenmai'] = $km;
            //CS 2
            $bh = $model::getChinhsach($model)
                          ->orderBy(['cs_id' => SORT_DESC])
                          ->where(['and',
                            ['cs_apdungcho' => Chinhsach::APDUNGDANHMUC],
                            ['cs_status' => Chinhsach::ON],
                            ['cs_recycle' => Chinhsach::NGOAITHUNGRAC],
                            ['cs_type' => Chinhsach::BAOHANH],
                        ])
                        ->column();
            $cache_data['dm_chinhsach'] = $bh;


            $cache_data['dm_link'] = $model->dm_link . '-'.D::url_dm.$model->dm_id.'.html';

            $cache_data['list_thongso'] = $model->getThongso()
                                                      ->select(['dm_id'])
                                                      ->andWhere(['dm_allow_search' => 1])
                                                      ->andWhere(['dm_level' => 1])                           
                                                      ->column();
        }

        if($model->dm_type == 2) $cache_data['dm_link'] = $model->dm_link . '-'.D::url_cm.$model->dm_id.'.html';

        if($model->dm_type == 5){
           if($model->dm_level == 1){
                  $cache_data['list_thongso_con'] = $model->getDanhmuccon()
                                                      ->select(['dm_id'])                                     
                                                      ->column();
            }
        }

        $cache->set('danhmuc'.$model->dm_id,$cache_data); 
        return $cache_data; 
    }


    public function Removenull($kc) //Loại bỏ trường ko nhập dữ liệu
    {        
      if(is_array($kc)) foreach ($kc as $k => $v) {
          if(isset($this[$k])) $this[$k] = '';
      }       
    }



    public static function getOptionsFind($q = '', $dm_type = ''){
        $dm = Danhmuc::find()
                    ->select(['dm_id','dm_ten'])
                    ->andWhere(
                      ($q == ''? :['like','dm_ten',$q])
                    )
                    ->andWhere(['dm_type' => $dm_type])
                    ->andWhere(['dm_recycle' => self::NGOAITHUNGRAC])
                    ->andWhere(['dm_status' => self::ON])
                    ->asArray()
                    ->limit(20)                    
                    ->all(); 

          if ($dm) {  
            $return = [];
            foreach ($dm as $k => $v) {   
                $img = '';                               
                $return[$k] = [
                      'id' => $v['dm_id'],
                      'text' => $v['dm_ten'],
                      'img' => $img,
                ];                
            }
            return $return;
        }
        return [];
    }


    public function beforeSave($insert)
    {      
        if(!empty($this->list_album)) $this->dm_album = json_encode($this->list_album);

        $this->dm_template = Cauhinh::template(); 
        if($this->dm_type == 4){ 

            $link = $this->dm_link;            
            if(is_array($link)){
                $link_s = $link['s'];
                if(!empty($link['c'][$link_s])){
                  $link_c = $link['c'][$link_s];
                }else{
                  $link_c = '';
                }                
                $link = [
                    's' => $link_s,
                    'c' => $link_c,
                ];              
              $this->dm_link = json_encode($link); 
            }


            $ten_ob = $this->dm_ten_ob;            
            if(is_array($ten_ob)){
                $link_s = $ten_ob['s'];
                if(!empty($ten_ob['c'][$link_s])){
                  $link_c = $ten_ob['c'][$link_s];
                }else{
                  $link_c = '';
                }                
                $ten_ob = [
                    's' => $link_s,
                    'c' => $link_c,
                ];              
              $this->dm_ten_ob = json_encode($ten_ob); 
            }  
        }else{  
          // $this->dm_link = json_encode($this->dm_link);
        }        
        return true;
    }

     public function afterSave($insert, $changedAttributes)
    {
      parent::afterSave( $insert, $changedAttributes );  
      self::cache($this);
    }


    public function afterFind()
    {        
        if($this->dm_type == 4){  
          $this->dm_link = json_decode($this->dm_link,true);
          $this->dm_ten_ob = json_decode($this->dm_ten_ob,true);
        }
        parent::afterFind();
    }  


    // public function getThongso()
    // {
    //     return $this->hasMany(Danhmuc::className(), )
    // }


    public static function getMultiOption(){
      return [              
          self::ONE => 'Chọn 1 giá trị',
          self::MULTI => 'Chọn nhiều giá trị',          
      ];
    }
     public static function getMultiLabel($value = NULL){
      $array = self::getMultiOption();
        if ($value === null || !array_key_exists($value, $array))
            return ' - ';
        return $array[$value];
    }


     public static function getAllowsearchOption(){
      return [              
          1 => 'Bật',
          2 => 'Không',
      ];
    }
     public static function getAllowsearchLabel($value = NULL){
      $array = [
         1 => 'Bật tìm kiếm',
         2 => 'Tắt',
      ];
        if ($value === null || !array_key_exists($value, $array))
            return ' - ';
        return $array[$value];
    }


    public function getSanphamOption()
     {        
        $model = (Sanpham::M)::find()
                             ->andWhere(['sp_recycle' => Sanpham::NGOAITHUNGRAC])
                             ->andWhere(['sp_status' => Sanpham::XUATBAN])
                             ->andWhere(['sp_type' => Sanpham::SANPHAM])
                             ->limit(200)
                             ->all();
        if($model){
            return ArrayHelper::map($model,'sp_id','sp_tensp');        
        }
        return [];
     }




    public function getDanhmucOption($type = NULL)
    {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       $model =  $_Danhmuc::find()
                          ->andWhere([Aabc::$app->_danhmuc->dm_status => $_Danhmuc::ON])
                          ->andWhere([Aabc::$app->_danhmuc->dm_recycle => $_Danhmuc::NGOAITHUNGRAC])    
                          ->andWhere([Aabc::$app->_danhmuc->dm_type => $type])
                          ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                          ->all();
        if($model){
            return ArrayHelper::map($model, Aabc::$app->_danhmuc->dm_id, Aabc::$app->_danhmuc->dm_char);
        }
        return [];
    }

   
     public function getChinhsachList()
    {
        $_Chinhsach = Aabc::$app->_model->Chinhsach;
        return $this->hasMany($_Chinhsach::className(), [Aabc::$app->_chinhsach->cs_id => Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach])->viaTable(Aabc::$app->_danhmucchinhsach->table, [Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc => Aabc::$app->_danhmuc->dm_id])->andWhere([Aabc::$app->_chinhsach->cs_status => '1'])->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])->all();
    }

    public function getThongso()
    {
        return $this->hasMany(Danhmuc::className(), ['dm_dmsp' => 'dm_id'])
                                  ->andWhere(['dm_recycle' => 2])
                                  ->orderBy(['dm_sothutu' => SORT_ASC]);        
    }


    public function getDanhmuccon()
    {
        return $this->hasMany(Danhmuc::className(), ['dm_idcha' => 'dm_id'])
                                  ->andWhere(['dm_recycle' => 2])
                                  ->orderBy(['dm_sothutu' => SORT_ASC]);        
    }





    public function getAllRecycle1_1()
   {
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '1'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '1'])
                           ->all();
   }
    public function getAllRecycle1_2()
   {
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '1'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '2'])
                           ->all();
   }
    public function getAllRecycle1_3()
   {
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '1'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '3'])
                           ->all();
   }
    
    public function getAllRecycle1_4($group = '')
   {
       $group = (int)($group);
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       if(empty($group)){
                return   $_Danhmuc::find()                           
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '1'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '4'])
                           ->all();
        }else{
                return   $_Danhmuc::find()
                           ->andWhere([
                                (empty($group))?:Aabc::$app->_danhmuc->dm_groupmenu => $group
                            ])
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '1'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '4'])
                           ->all();
        }
   }
   public function getAllRecycle1_5()
   {
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '1'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '5'])
                           ->all();
   }







   public function getAllRecycle0Component()
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])    
                           ->orderBy([Aabc::$app->_danhmuc->dm_thutu=>SORT_ASC])
                           ->all();
   }







   public function getAllRecycle0_1()
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])    
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '1'])
                           ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                           ->all();
   }
   public function getAllRecycle0_2()
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '2'])
                           ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                           ->all();
   }

   public function getAllRecycle0_3()
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])    
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '3'])
                           ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                           ->all();
   }
   public function getAllRecycle0_4()
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '4'])
                           ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                           ->all();
   }
   public function getAllRecycle0_5()
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '5'])
                           ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                           ->all();
   }



   public function getAllRecycle0_5level2()//Sử dụng khi thêm mới từ level2
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '5'])
                           ->andWhere(['IN', Aabc::$app->_danhmuc->dm_level, ['0','1']])
                           ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                           // ->andWhere([Aabc::$app->_danhmuc->dm_idcha => NULL])
                           ->all();
   }
   public function getAllRecycle0_5level1()//Sử dụng khi thêm mới từ level1
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '5'])
                           ->andWhere(['IN', Aabc::$app->_danhmuc->dm_level, ['0']])
                           ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                           // ->andWhere([Aabc::$app->_danhmuc->dm_idcha => NULL])
                           ->all();
   }
   public function getAllRecycle0_5level0()//Sử dụng khi thêm mới nhóm
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '5'])
                           ->andWhere(['NOT IN', Aabc::$app->_danhmuc->dm_level, ['0','1','2']])
                           ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                           // ->andWhere([Aabc::$app->_danhmuc->dm_idcha => NULL])
                           ->all();
   }









  




   public function getNoibatOption()
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       $noibat = $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_status => '1'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])    
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '4'])
                           ->andWhere(['dm_noibat' => '1'])
                           ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                           ->all();
      if($noibat){
         return ['' => '---Chọn---'] + ArrayHelper::map($noibat,Aabc::$app->_danhmuc->dm_id,Aabc::$app->_danhmuc->dm_char);
      }
   }


   public function getAll1_1()
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_status => '1'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])    
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '1'])
                           ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                           ->all();
   }

   public function getParent(){ 
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                            ->andWhere([Aabc::$app->_danhmuc->dm_status => '1'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])    
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => $this->dm_type])
                           ->andWhere(['<=',Aabc::$app->_danhmuc->dm_level,$this->dm_level])
                           ->andWhere(['!=',Aabc::$app->_danhmuc->dm_id,$this->dm_id])
                           ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                           ->all();
   }



   public function getAll1_2()
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                          ->andWhere([Aabc::$app->_danhmuc->dm_status => '1'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '2'])
                           ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                           ->all();
   }

   public function getAll1_3()
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                            ->andWhere([Aabc::$app->_danhmuc->dm_status => '1'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])    
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '3'])
                           ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                           ->all();
   }
   public function getAll1_4()
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                            ->andWhere([Aabc::$app->_danhmuc->dm_status => '1'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '4'])
                           ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                           ->all();
   }
   public function getAll1_5()
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                          ->andWhere([Aabc::$app->_danhmuc->dm_status => '1'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '5'])
                           ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                           ->all();
   }



   public function getAll1_5level2()//Sử dụng khi thêm mới từ level2
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                          ->andWhere([Aabc::$app->_danhmuc->dm_status => '1'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '5'])
                           ->andWhere(['IN', Aabc::$app->_danhmuc->dm_level, ['0','1']])
                           ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                           // ->andWhere([Aabc::$app->_danhmuc->dm_idcha => NULL])
                           ->all();
   }
   public function getAll1_5level1()//Sử dụng khi thêm mới từ level1
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                          ->andWhere([Aabc::$app->_danhmuc->dm_status => '1'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '5'])
                           ->andWhere(['IN', Aabc::$app->_danhmuc->dm_level, ['0']])
                           ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                           // ->andWhere([Aabc::$app->_danhmuc->dm_idcha => NULL])
                           ->all();
   }
   public function getAll1_5level0()//Sử dụng khi thêm mới nhóm
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_status => '1'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_type => '5'])
                           ->andWhere(['NOT IN', Aabc::$app->_danhmuc->dm_level, ['0','1','2']])
                           ->orderBy([Aabc::$app->_danhmuc->dm_sothutu=>SORT_ASC])
                           // ->andWhere([Aabc::$app->_danhmuc->dm_idcha => NULL])
                           ->all();
   }


    public function getAll1Component()
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                            ->andWhere([Aabc::$app->_danhmuc->dm_status => '1'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])    
                           ->orderBy([Aabc::$app->_danhmuc->dm_thutu=>SORT_ASC])
                           ->all();
   }



   




    public function getAll2()
   {
       $_Danhmuc = Aabc::$app->_model->Danhmuc;
       return   $_Danhmuc::find()
                           ->andWhere([Aabc::$app->_danhmuc->dm_status => '2'])
                           ->andWhere([Aabc::$app->_danhmuc->dm_recycle => '2'])
                           ->orderBy([Aabc::$app->_danhmuc->dm_thutu=>SORT_ASC])
                           ->all();
   }









    public function getDmIdcha()
    {
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
return $this->hasOne($_Danhmuc::className(), [Aabc::$app->_danhmuc->dm_id => Aabc::$app->_danhmuc->dm_idcha]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getDanhmucs()
    {
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
return $this->hasMany($_Danhmuc::className(), [Aabc::$app->_danhmuc->dm_idcha => Aabc::$app->_danhmuc->dm_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getDanhmucChinhsaches()
    {       
       return $this->hasMany(Danhmucchinhsach::className(), ['dmcs_id_danhmuc' => 'dm_id']);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getChinhsach($model)
    {        
      return $model->hasMany(Chinhsach::className(), ['cs_id' => 'dmcs_id_chinhsach'])->viaTable('db_danhmuc_chinhsach', ['dmcs_id_danhmuc' => 'dm_id']);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getDanhmucNgonngus($model)
    {
        return $model->hasMany((Danhmucngonngu::M)::className(), ['dmnn_id_danhmuc' => 'dm_id']);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getDmnnIdNgonngus()
    {
        $_Ngonngu = Aabc::$app->_model->Ngonngu;
return $this->hasMany($_Ngonngu::className(), [Aabc::$app->_ngonngu->ngonngu_id => Aabc::$app->_danhmucngonngu->dmnn_id_ngonngu])->viaTable(Aabc::$app->_danhmucngonngu->table, [Aabc::$app->_danhmucngonngu->dmnn_id_danhmuc => Aabc::$app->_danhmuc->dm_id]);
    }
    /**
     * @retur
     n \aabc\db\ActiveQuery
     */
    public function getSanphamDanhmucs()
    {
        return $this->hasMany(SanphamDanhmuc::className(), ['spdm_id_danhmuc' => 'dm_id']);
    }
    

       //Lấy Danh sách Sanpham có quan hệ với Danh mục này, thông qua bảng sanphamdanhmuc
    public function getSpdmIdSanphams($model)
    {
        $_Sanpham = Aabc::$app->_model->Sanpham;
        return $model->hasMany($_Sanpham::className(), ['sp_id' => 'spdm_id_sp'])->viaTable('db_sanpham_danhmuc', ['spdm_id_danhmuc' => 'dm_id']);
    }


       //Lấy Danh sách Sanpham tai sanphamdanhmuc
    public function getIdSanphams($model)
    {
        return $model->hasMany(Sanphamdanhmuc::className(), ['spdm_id_danhmuc' => 'dm_id']);
    }
  

     public function getDmDmsp()
    {
        return $this->hasOne(Danhmuc::className(), ['dm_id' => 'dm_dmsp']);
    }
   
    
}
