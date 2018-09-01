<?php
namespace backend\models;
use Aabc;
use aabc\helpers\ArrayHelper;
use backend\models\Danhmucchinhsach;

class Chinhsach extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        // return Aabc::$app->_chinhsach->table;
        return 'db_chinhsach';
    }

    const TRONGTHUNGRAC = 1;
    const NGOAITHUNGRAC = 2;

    const ON = 1;
    const OFF = 2;

    const KHUYENMAI = 1;
    const BAOHANH = 2;
    const GIAOHANG = 3;

    const APDUNGTATCA = 1;
    const APDUNGDANHMUC = 2;
    const APDUNGSANPHAM = 3;


    public function actionController()
    {
        return [
            'chinhsach'.':'.'i_km' => 'chinhsach/i_km',
            'chinhsach'.':'.'i_bh' => 'chinhsach/i_bh',

            'chinhsach'.':'.'c_km' => 'chinhsach/c_km',
            'chinhsach'.':'.'c_bh' => 'chinhsach/c_bh',

            'chinhsach'.':'.'u_km' => 'chinhsach/u_km',
            'chinhsach'.':'.'u_bh' => 'chinhsach/u_bh',
        ];
    }

    public function rules()
    {
        return [
            [[Aabc::$app->_chinhsach->cs_type, Aabc::$app->_chinhsach->cs_typetyle, Aabc::$app->_chinhsach->cs_apdungcho, Aabc::$app->_chinhsach->cs_dieukien, Aabc::$app->_chinhsach->cs_status, Aabc::$app->_chinhsach->cs_recycle], 'string'],
            [[Aabc::$app->_chinhsach->cs_ten], 'required'],
            [[Aabc::$app->_chinhsach->cs_tylechietkhau, Aabc::$app->_chinhsach->cs_noidungdieukien], 'integer'],
            [[Aabc::$app->_chinhsach->cs_ngaytao, Aabc::$app->_chinhsach->cs_ngaybatdau, Aabc::$app->_chinhsach->cs_ngayketthuc], 'safe'],
            [[Aabc::$app->_chinhsach->cs_ten], 'string', 'max' => 80],
            [[Aabc::$app->_chinhsach->cs_code], 'string', 'max' => 20],
            [[Aabc::$app->_chinhsach->cs_ghichu], 'string', 'max' => 200],

            [['cs_link'], 'string', 'max' => 255],
            [['cs_icon'], 'string', 'max' => 100],

            [[Aabc::$app->_chinhsach->cs_id_danhmuc, Aabc::$app->_chinhsach->cs_id_sp], 'safe'],

        ];
    }



    public function attributeLabels()
    {
        return [
                        
            Aabc::$app->_chinhsach->cs_id => Aabc::$app->_chinhsach->__cs_id ,                        
            Aabc::$app->_chinhsach->cs_type => Aabc::$app->_chinhsach->__cs_type ,                        
            Aabc::$app->_chinhsach->cs_ten => Aabc::$app->_chinhsach->__cs_ten ,                        
            Aabc::$app->_chinhsach->cs_code => Aabc::$app->_chinhsach->__cs_code ,                        
            Aabc::$app->_chinhsach->cs_ghichu => Aabc::$app->_chinhsach->__cs_ghichu ,                        
            Aabc::$app->_chinhsach->cs_typetyle => Aabc::$app->_chinhsach->__cs_typetyle ,                        
            Aabc::$app->_chinhsach->cs_tylechietkhau => Aabc::$app->_chinhsach->__cs_tylechietkhau ,                        
            Aabc::$app->_chinhsach->cs_apdungcho => Aabc::$app->_chinhsach->__cs_apdungcho ,                        
            Aabc::$app->_chinhsach->cs_dieukien => Aabc::$app->_chinhsach->__cs_dieukien ,                        
            Aabc::$app->_chinhsach->cs_noidungdieukien => Aabc::$app->_chinhsach->__cs_noidungdieukien ,                        
            Aabc::$app->_chinhsach->cs_status => Aabc::$app->_chinhsach->__cs_status ,                        
            Aabc::$app->_chinhsach->cs_recycle => Aabc::$app->_chinhsach->__cs_recycle ,                        
            Aabc::$app->_chinhsach->cs_ngaytao => Aabc::$app->_chinhsach->__cs_ngaytao ,                        
            Aabc::$app->_chinhsach->cs_ngaybatdau => Aabc::$app->_chinhsach->__cs_ngaybatdau ,                        
            Aabc::$app->_chinhsach->cs_ngayketthuc => Aabc::$app->_chinhsach->__cs_ngayketthuc ,        
            Aabc::$app->_chinhsach->cs_id_danhmuc => Aabc::$app->_chinhsach->__cs_id_danhmuc 
            ,
            Aabc::$app->_chinhsach->cs_id_sp => Aabc::$app->_chinhsach->__cs_id_sp 
            ,
            'cs_link' => 'Link bài viết',
            'cs_icon' => 'Icon',
            ];
    }

  public function getKhuyenmaiOption($type = NULL)
  {
    $_Chinhsach = Aabc::$app->_model->Chinhsach;
    $chinhsach =  $_Chinhsach::find()
                           ->andWhere([Aabc::$app->_chinhsach->cs_status => $_Chinhsach::ON])
                           ->andWhere([Aabc::$app->_chinhsach->cs_recycle => $_Chinhsach::NGOAITHUNGRAC])
                           ->andWhere([Aabc::$app->_chinhsach->cs_type => $type])
                           ->orderBy([Aabc::$app->_chinhsach->cs_apdungcho => SORT_ASC]) 
                           ->all();      
    if($chinhsach){
        foreach ($chinhsach as $keycs => $valuecs) {
            if($valuecs[Aabc::$app->_chinhsach->cs_apdungcho] == $_Chinhsach::APDUNGTATCA){
                $chinhsach[$keycs][Aabc::$app->_chinhsach->cs_ten] = '<i>Tất cả</i>'.$valuecs[Aabc::$app->_chinhsach->cs_ten] . '%&<i class="haut haut_all">(Áp dụng tất cả sản phẩm)</i>'.'#$'.$valuecs[Aabc::$app->_chinhsach->cs_apdungcho];
            }
            if($valuecs[Aabc::$app->_chinhsach->cs_apdungcho] == $_Chinhsach::APDUNGDANHMUC){

                $list_dm = Danhmucchinhsach::find()
                                      ->where(['dmcs_id_chinhsach' => $valuecs['cs_id']])
                                      ->all();
                $ten_dm = '';
                if($list_dm){
                    $ten_dm = '%&<i class="haut">(Áp dụng riêng cho Danh mục sản phẩm: ';
                    $dem = 0;
                    foreach ($list_dm as $dm) {
                      $ten_dm .= ($dem > 0?', ':'').'<b>'.$dm->dmcsIdDanhmuc->dm_ten.'</b>';
                      $dem += 1;
                    }
                    $ten_dm .= ')</i>';
                }

                $chinhsach[$keycs][Aabc::$app->_chinhsach->cs_ten] = $valuecs[Aabc::$app->_chinhsach->cs_ten] . $ten_dm .'#$'.$valuecs[Aabc::$app->_chinhsach->cs_apdungcho];
            }
      }
      // die;

      // echo '<pre>';
      // print_r($chinhsach);
      // echo '</pre>';
      // die;

      return ArrayHelper::map($chinhsach,Aabc::$app->_chinhsach->cs_id, function($model){
         return $model->cs_ten;
      });
    }
    return [];
  }

    public function afterSave($insert, $changedAttributes)
    {
      parent::afterSave( $insert, $changedAttributes );    

      //All Khuyen mai
      $all_khuyenmai = Chinhsach::find()
                  ->select('cs_id')
                  ->where(['and',
                    ['cs_type' => self::KHUYENMAI],
                    ['cs_apdungcho' => self::APDUNGTATCA],
                    ['cs_status' => self::ON],
                    ['cs_recycle' => self::NGOAITHUNGRAC],
                  ])
                  ->orderBy(['cs_id' => SORT_DESC])
                  ->column();

      //All CHinh sach
      $all_chinhsach = Chinhsach::find()
                  ->select('cs_id')
                  ->where(['and',
                    ['cs_type' => self::BAOHANH],
                    ['cs_apdungcho' => self::APDUNGTATCA],
                    ['cs_status' => self::ON],
                    ['cs_recycle' => self::NGOAITHUNGRAC],
                  ])
                  ->orderBy(['cs_id' => SORT_DESC])
                  ->column();

      $cache = Aabc::$app->dulieu;
      $cache->set('csallkhuyenmai', $all_khuyenmai);
      $cache->set('csallchinhsach', $all_chinhsach);

      self::cache($this);
    }

    public static function cache($model)
    {
        $cache = Aabc::$app->dulieu;
        $cache_data = $model->attributes;
        $cache->set('cs'.$model->cs_id,$cache_data);
        return $cache_data;
    }


    public function beforeValidate()
    {
      if(!empty($this->cs_link)) $this->cs_link = json_encode($this->cs_link);

      if(!empty($this->cs_ngaybatdau)) $this->cs_ngaybatdau = date('Y-m-d',strtotime($this->cs_ngaybatdau));
      if(!empty($this->cs_ngayketthuc)) $this->cs_ngayketthuc = date('Y-m-d',strtotime($this->cs_ngayketthuc));
      return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }


    public function afterFind()
    {        
        if(!empty($this->cs_link)) $this->cs_link = json_decode($this->cs_link,true);
        
        if(!empty($this->cs_ngaybatdau)) $this->cs_ngaybatdau = date('d-m-Y',strtotime($this->cs_ngaybatdau));
        if(!empty($this->cs_ngayketthuc)) $this->cs_ngayketthuc = date('d-m-Y',strtotime($this->cs_ngayketthuc));
        parent::afterFind();
    } 



    public function getAllRecycle1_1()
    {
        $_Chinhsach = Aabc::$app->_model->Chinhsach;
       return   $_Chinhsach::find()
                           ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '1'])
                           ->andWhere([Aabc::$app->_chinhsach->cs_type => '1'])
                           ->all();
    }
    public function getAllRecycle1_2()
    {
        $_Chinhsach = Aabc::$app->_model->Chinhsach;
       return   $_Chinhsach::find()
                           ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '1'])
                           ->andWhere([Aabc::$app->_chinhsach->cs_type => '2'])
                           ->all();
    }
    public function getAllRecycle1_3()
    {
        $_Chinhsach = Aabc::$app->_model->Chinhsach;
       return   $_Chinhsach::find()
                           ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '1'])
                           ->andWhere([Aabc::$app->_chinhsach->cs_type => '3'])
                           ->all();
    }







   public function getAllRecycle0_1()
   {
       $_Chinhsach = Aabc::$app->_model->Chinhsach;
       return   $_Chinhsach::find()
                           ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])
                           ->andWhere([Aabc::$app->_chinhsach->cs_type => '1'])
                           ->all();
   }   
  


   public function getAllRecycle0_2()
   {
       $_Chinhsach = Aabc::$app->_model->Chinhsach;
       return   $_Chinhsach::find()
                           ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])
                           ->andWhere([Aabc::$app->_chinhsach->cs_type => '2'])                         
                           ->all();
   }
   public function getAllRecycle0_3()
   {
       $_Chinhsach = Aabc::$app->_model->Chinhsach;
       return   $_Chinhsach::find()
                           ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])   
                           ->andWhere([Aabc::$app->_chinhsach->cs_type => '3'])
                           ->all();
   }









    public function getAll1_1()
   {
       $_Chinhsach = Aabc::$app->_model->Chinhsach;
       return   $_Chinhsach::find()
                           ->andWhere([Aabc::$app->_chinhsach->cs_status => '1'])
                           ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])
                           ->andWhere([Aabc::$app->_chinhsach->cs_type => '1'])
                           ->orderBy([Aabc::$app->_chinhsach->cs_apdungcho => SORT_ASC]) 
                           ->all();
   }



    public function getAll1_2()
   {
       $_Chinhsach = Aabc::$app->_model->Chinhsach;
       return   $_Chinhsach::find()
                           ->andWhere([Aabc::$app->_chinhsach->cs_status => '1'])
                           ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])
                           ->andWhere([Aabc::$app->_chinhsach->cs_type => '2'])
                           ->orderBy([Aabc::$app->_chinhsach->cs_apdungcho => SORT_ASC]) 
                           ->all();
   }
    public function getAll1_3()
   {
       $_Chinhsach = Aabc::$app->_model->Chinhsach;
       return   $_Chinhsach::find()
                           ->andWhere([Aabc::$app->_chinhsach->cs_status => '1'])
                           ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])
                           ->andWhere([Aabc::$app->_chinhsach->cs_type => '3'])
                           ->orderBy([Aabc::$app->_chinhsach->cs_apdungcho => SORT_ASC]) 
                           ->all();
   }








    public function getAll2()
   {
       $_Chinhsach = Aabc::$app->_model->Chinhsach;
       return   $_Chinhsach::find()
                           ->andWhere([Aabc::$app->_chinhsach->cs_status => '2'])
                           ->andWhere([Aabc::$app->_chinhsach->cs_recycle => '2'])
                           ->all();
   }










 /**
     * @return \aabc\db\ActiveQuery
     */
    public function getChinhsachNgonngus()
    {
        $_ChinhsachNgonngu = Aabc::$app->_model->ChinhsachNgonngu;
return $this->hasMany($_ChinhsachNgonngu::className(), [Aabc::$app->_chinhsachngonngu->csnn_id_chinhsach => Aabc::$app->_chinhsach->cs_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getCsnnIdNgonngus()
    {
        $_Ngonngu = Aabc::$app->_model->Ngonngu;
return $this->hasMany($_Ngonngu::className(), [Aabc::$app->_ngonngu->ngonngu_id => Aabc::$app->_chinhsachngonngu->csnn_id_ngonngu])->viaTable(Aabc::$app->_chinhsachngonngu->table, [Aabc::$app->_chinhsachngonngu->csnn_id_chinhsach => Aabc::$app->_chinhsach->cs_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getDanhmucChinhsaches($model)
    {        
      return $model->hasMany(Danhmucchinhsach::className(), [Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach => Aabc::$app->_chinhsach->cs_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getDmcsIdDanhmucs($model = null)
    {
      if($model){
        $_Danhmuc = Aabc::$app->_model->Danhmuc;      
        return $model->hasMany(Danhmuc::className(), [Aabc::$app->_danhmuc->dm_id => Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc])->viaTable(Aabc::$app->_danhmucchinhsach->table, [Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach => Aabc::$app->_chinhsach->cs_id]);
      }else{
        return $this->hasMany(Danhmuc::className(), [Aabc::$app->_danhmuc->dm_id => Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc])->viaTable(Aabc::$app->_danhmucchinhsach->table, [Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach => Aabc::$app->_chinhsach->cs_id]);
      }
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getDonhangs()
    {
        $_Donhang = Aabc::$app->_model->Donhang;
return $this->hasMany($_Donhang::className(), [Aabc::$app->_donhang->ddh_idkhuyenmai => Aabc::$app->_chinhsach->cs_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSanphamChinhsaches()
    {
        $_SanphamChinhsach = Aabc::$app->_model->SanphamChinhsach;
return $this->hasMany($_SanphamChinhsach::className(), [Aabc::$app->_sanphamchinhsach->spcs_id_chinhsach => Aabc::$app->_chinhsach->cs_id]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSpcsIdSps($model = null)
    {
        if($model){
           
          return $model->hasMany((Sanpham::M)::className(), ['sp_id' => Aabc::$app->_sanphamchinhsach->spcs_id_sp])->viaTable(Aabc::$app->_sanphamchinhsach->table, [Aabc::$app->_sanphamchinhsach->spcs_id_chinhsach => Aabc::$app->_chinhsach->cs_id]);
        }else{        
          return $this->hasMany((Sanpham::M)::className(), ['sp_id' => Aabc::$app->_sanphamchinhsach->spcs_id_sp])->viaTable(Aabc::$app->_sanphamchinhsach->table, [Aabc::$app->_sanphamchinhsach->spcs_id_chinhsach => Aabc::$app->_chinhsach->cs_id]);
        }
    }





}
