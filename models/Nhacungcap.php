<?php
namespace backend\models;
use Aabc;
/**
**/


/**
 * This is the model class for table "db_nhacungcap".
 *
 * @property integer $ncc_id
 * @property string $ncc_ten
 * @property string $ncc_diachi
 * @property string $ncc_dienthoai
 * @property string $ncc_mst
 * @property string $ncc_email
 * @property string $ncc_nguoilamviec
 * @property string $ncc_ghichu
*
 *
 * @property Sanpham[] $sanphams
 */
class Nhacungcap extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        return Aabc::$app->_nhacungcap->table;        
    }

    public function rules()
    {
        return [
            [[Aabc::$app->_nhacungcap->ncc_ten], 'required'],
            [[Aabc::$app->_nhacungcap->ncc_ten, Aabc::$app->_nhacungcap->ncc_diachi], 'string', 'max' => 200],
            [[Aabc::$app->_nhacungcap->ncc_dienthoai, Aabc::$app->_nhacungcap->ncc_mst], 'string', 'max' => 15],
            [[Aabc::$app->_nhacungcap->ncc_email], 'string', 'max' => 50],
            [[Aabc::$app->_nhacungcap->ncc_nguoilamviec], 'string', 'max' => 30],
            [[Aabc::$app->_nhacungcap->ncc_ghichu], 'string', 'max' => 255],
        ];
    }



    public function attributeLabels()
    {
        return [
                        
            Aabc::$app->_nhacungcap->ncc_id => Aabc::$app->_nhacungcap->__ncc_id ,                        
            Aabc::$app->_nhacungcap->ncc_ten => Aabc::$app->_nhacungcap->__ncc_ten ,                        
            Aabc::$app->_nhacungcap->ncc_diachi => Aabc::$app->_nhacungcap->__ncc_diachi ,                        
            Aabc::$app->_nhacungcap->ncc_dienthoai => Aabc::$app->_nhacungcap->__ncc_dienthoai ,                        
            Aabc::$app->_nhacungcap->ncc_mst => Aabc::$app->_nhacungcap->__ncc_mst ,                        
            Aabc::$app->_nhacungcap->ncc_email => Aabc::$app->_nhacungcap->__ncc_email ,                        
            Aabc::$app->_nhacungcap->ncc_nguoilamviec => Aabc::$app->_nhacungcap->__ncc_nguoilamviec ,                        
            Aabc::$app->_nhacungcap->ncc_ghichu => Aabc::$app->_nhacungcap->__ncc_ghichu ,        ];
    }

    public function getAllRecycle1()
   {
       return  Nhacungcap::find()
                           ->andWhere([Aabc::$app->_nhacungcap->ncc_recycle => '1'])
                           ->all();
   }
   public function getAllRecycle0()
   {
       return  Nhacungcap::find()
                           ->andWhere([Aabc::$app->_nhacungcap->ncc_recycle => '2'])                            
                           ->all();
   }
    public function getAllStatus1()
   {
       return  Nhacungcap::find()
                           ->andWhere([Aabc::$app->_nhacungcap->ncc_status => '1'])
                           ->andWhere([Aabc::$app->_nhacungcap->ncc_recycle => '2'])
                           ->all();
   }
    public function getAllStatus2()
   {
       return  Nhacungcap::find()
                           ->andWhere([Aabc::$app->_nhacungcap->ncc_status => '2'])
                           ->andWhere([Aabc::$app->_nhacungcap->ncc_recycle => '2'])
                           ->all();
   }



    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSanphams()
    {
        return $this->hasMany(Sanpham::className(), [Aabc::$app->_sanpham->sp_id_ncc => Aabc::$app->_nhacungcap->ncc_id]);
    }





}
