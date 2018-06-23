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

    public function rules()
    {
        return [
            [[Aabc::$app->_danhmuc->dm_ten], 'required'],
            [[Aabc::$app->_danhmuc->dm_idcha, Aabc::$app->_danhmuc->dm_thutu, Aabc::$app->_danhmuc->dm_sothutu, Aabc::$app->_danhmuc->dm_level, 'dm_groupmenu'], 'integer'],
            [[Aabc::$app->_danhmuc->dm_status, Aabc::$app->_danhmuc->dm_recycle, Aabc::$app->_danhmuc->dm_type], 'string'],

            [[Aabc::$app->_danhmuc->dm_id_chinhsach], 'safe'],

            [[Aabc::$app->_danhmuc->dm_ten], 'string', 'max' => 50],
            [[Aabc::$app->_danhmuc->dm_char, Aabc::$app->_danhmuc->dm_icon, Aabc::$app->_danhmuc->dm_background, Aabc::$app->_danhmuc->dm_ghichu], 'string', 'max' => 100],

            [[Aabc::$app->_danhmuc->dm_link], 'safe'],

            [['dm_email','dm_phone','dm_zalo','dm_skype'], 'string', 'max' => 100],

            [['dm_fb','dm_youtube','dm_viber'], 'string', 'max' => 100],

            [['dm_dmsp'], 'integer'],

            [['dm_multi'], 'integer'],

            [['dm_noibat'], 'integer'],

            [['dm_template'], 'string', 'max' => 100],

            [['dm_showmax'], 'integer'],

             [['dm_dmsp'], 'exist', 'skipOnError' => true, 'targetClass' => Danhmuc::className(), 'targetAttribute' => ['dm_dmsp' => 'dm_id']],

              [['dm_idcha'], 'exist', 'skipOnError' => true, 'targetClass' => Danhmuc::className(), 'targetAttribute' => ['dm_idcha' => 'dm_id']],

            [['list_sp_noibat'],'safe'],
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

            Aabc::$app->_danhmuc->dm_groupmenu => Aabc::$app->_danhmuc->__dm_groupmenu ,        ];
    }

    public static function cache($model)
    {
        $cache = Aabc::$app->dulieu;
        $cache_data = $model->attributes;        
        $cache_data['dm_listsp'] = $model::getSpdmIdSanphams($model)
                                        ->orderBy(['sp_id' => SORT_DESC])
                                        ->andWhere(['sp_recycle' => '2'])
                                        ->andWhere(['sp_status' => '1'])
                                        ->column();
        if($model->dm_type == 1) $cache_data['dm_link'] = $model->dm_link . '-'.D::url_dm.$model->dm_id.'.html';
        if($model->dm_type == 2) $cache_data['dm_link'] = $model->dm_link . '-'.D::url_cm.$model->dm_id.'.html';
        $cache->set('danhmuc'.$model->dm_id,$cache_data); 
        return $cache_data; 
    }


    public function Removenull($kc) //Loại bỏ trường ko nhập dữ liệu
    {        
      if(is_array($kc)) foreach ($kc as $k => $v) {
          if(isset($this[$k])) $this[$k] = '';
      }       
    }



    public function beforeSave($insert)
    {             
        $this->dm_template = Cauhinh::template(); 
        if($this->dm_type == 4){ 

            $link = $this->dm_link;
            // echo '<pre>';
            // print_r($link);
            if(is_array($link)){
              // if(!empty($link['s']) && !empty($link['c'])){
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
              // }
              $this->dm_link = json_encode($link); 
            }  
        }else{  
          // $this->dm_link = json_encode($this->dm_link);
        }
        Danhmuc::cache($this);
        return true;
    }


     public function afterFind()
    {        
        if($this->dm_type == 4){  
          $this->dm_link = json_decode($this->dm_link,true);
        }
        parent::afterFind();
    }  




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
        $_DanhmucChinhsach = Aabc::$app->_model->DanhmucChinhsach;
return $this->hasMany($_DanhmucChinhsach::className(), [Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc => Aabc::$app->_danhmuc->dm_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getDmcsIdChinhsaches()
    {
        $_Chinhsach = Aabc::$app->_model->Chinhsach;
return $this->hasMany($_Chinhsach::className(), [Aabc::$app->_chinhsach->cs_id => Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach])->viaTable(Aabc::$app->_danhmucchinhsach->table, [Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc => Aabc::$app->_danhmuc->dm_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getDanhmucNgonngus()
    {
        $_DanhmucNgonngu = Aabc::$app->_model->DanhmucNgonngu;
return $this->hasMany($_DanhmucNgonngu::className(), [Aabc::$app->_danhmucngonngu->dmnn_id_danhmuc => Aabc::$app->_danhmuc->dm_id]);
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

  

     public function getDmDmsp()
    {
        return $this->hasOne(Danhmuc::className(), ['dm_id' => 'dm_dmsp']);
    }
   
    
}
