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
            [['spdm_id_sp', 'spdm_id_danhmuc'], 'required'],
            [['spdm_id_sp', 'spdm_id_danhmuc'], 'integer'],

            [['spdm_type'],'integer'],

            [['spdm_info'],'string', 'max' => 255],

            [['spdm_sothutu'],'string', 'max' => 20],

            [['spdm_id_danhmuc'], 'exist', 'skipOnError' => true, 'targetClass' =>  $_Danhmuc::className(), 'targetAttribute' => ['spdm_id_danhmuc' => Aabc::$app->_danhmuc->dm_id]],
            [['spdm_id_sp'], 'exist', 'skipOnError' => true, 'targetClass' =>  $_Sanpham::className(), 'targetAttribute' => ['spdm_id_sp' => Aabc::$app->_sanpham->sp_id]],
        ];
    }



    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }    
        if($this->isNewRecord)  $this['spdm_sothutu'] = (string)time(); 
        return true;
    }


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave( $insert, $changedAttributes );
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
        $dm = $_Danhmuc::find()->andWhere(['dm_id' => $this->spdm_id_danhmuc])->one();
        if($dm) $_Danhmuc::cache($dm);        
    }


    public function afterDelete()
    {   
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
        $dm = $_Danhmuc::find()->andWhere(['dm_id' => $this->spdm_id_danhmuc])->one();
        if($dm) $_Danhmuc::cache($dm);  
        parent::afterDelete();        
    }


    public static function xoatatca($condition = null)
    {
        $_Sanphamdanhmuc = Aabc::$app->_model->Sanphamdanhmuc;  
        $spdm_delete_all = $_Sanphamdanhmuc::find()
                                        ->andWhere($condition)
                                        ->all();
        $_Sanphamdanhmuc::deleteAll($condition);

        foreach ($spdm_delete_all as $spdm_delete_one) {
            $spdm_delete_one->afterDelete();
        }
    }




    public function attributeLabels()
    {
        return [
                        
            'spdm_id_sp' => Aabc::$app->_sanphamdanhmuc->__spdm_id_sp ,                        
            'spdm_id_danhmuc' => Aabc::$app->_sanphamdanhmuc->__spdm_id_danhmuc ,        ];
    }

  


    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSpdmIdDanhmuc()
    {
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
return $this->hasOne($_Danhmuc::className(), [Aabc::$app->_danhmuc->dm_id => 'spdm_id_danhmuc']);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSpdmIdSp()
    {
        $_Sanpham = Aabc::$app->_model->Sanpham;
        return $this->hasOne($_Sanpham::className(), ['sp_id' => 'spdm_id_sp']);
    }


    public function getThongtinSanpham()
    {
        $_Sanpham = Aabc::$app->_model->Sanpham;
        return $this->hasOne($_Sanpham::className(), ['sp_id' => 'spdm_id_sp']);
    }



}
