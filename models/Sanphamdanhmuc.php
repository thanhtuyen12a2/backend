<?php
namespace backend\models;
use Aabc;
/**
**/


/**
 * This is the model class for table "db_sanpham_danhmuc".
 *
 * @property integer $spdm_id_sp
 * @property integer $spdm_id_danhmuc
*
 *
 * @property $_Danhmuc = Aabc::$app->_model->Danhmuc[] $spdmIdDanhmuc
 * @property $_Sanpham = Aabc::$app->_model->Sanpham[] $spdmIdSp
 */
class Sanphamdanhmuc extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        // return Aabc::$app->_sanphamdanhmuc->table;        
        return 'db_sanpham_danhmuc';
    }

    public function rules()
    {
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
        $_Sanpham = Aabc::$app->_model->Sanpham ;
        return [
            [[Aabc::$app->_sanphamdanhmuc->spdm_id_sp, Aabc::$app->_sanphamdanhmuc->spdm_id_danhmuc], 'required'],
            [[Aabc::$app->_sanphamdanhmuc->spdm_id_sp, Aabc::$app->_sanphamdanhmuc->spdm_id_danhmuc], 'integer'],
            [[Aabc::$app->_sanphamdanhmuc->spdm_id_danhmuc], 'exist', 'skipOnError' => true, 'targetClass' =>  $_Danhmuc::className(), 'targetAttribute' => [Aabc::$app->_sanphamdanhmuc->spdm_id_danhmuc => Aabc::$app->_danhmuc->dm_id]],
            [[Aabc::$app->_sanphamdanhmuc->spdm_id_sp], 'exist', 'skipOnError' => true, 'targetClass' =>  $_Sanpham::className(), 'targetAttribute' => [Aabc::$app->_sanphamdanhmuc->spdm_id_sp => Aabc::$app->_sanpham->sp_id]],
        ];
    }



    public function attributeLabels()
    {
        return [
                        
            Aabc::$app->_sanphamdanhmuc->spdm_id_sp => Aabc::$app->_sanphamdanhmuc->__spdm_id_sp ,                        
            Aabc::$app->_sanphamdanhmuc->spdm_id_danhmuc => Aabc::$app->_sanphamdanhmuc->__spdm_id_danhmuc ,        ];
    }

  


    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSpdmIdDanhmuc()
    {
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
return $this->hasOne($_Danhmuc::className(), [Aabc::$app->_danhmuc->dm_id => Aabc::$app->_sanphamdanhmuc->spdm_id_danhmuc]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSpdmIdSp()
    {
        $_Sanpham = Aabc::$app->_model->Sanpham;
return $this->hasOne($_Sanpham::className(), [Aabc::$app->_sanpham->sp_id => Aabc::$app->_sanphamdanhmuc->spdm_id_sp]);
    }





}
