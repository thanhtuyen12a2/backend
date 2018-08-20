<?php
namespace backend\models;
use Aabc;
/**
**/


/**
 * This is the model class for table "db_danhmuc_chinhsach".
 *
 * @property integer $dmcs_id_danhmuc
 * @property integer $dmcs_id_chinhsach
*
 *
 * @property $_Chinhsach = Aabc::$app->_model->Chinhsach[] $dmcsIdChinhsach
 * @property $_Danhmuc = Aabc::$app->_model->Danhmuc[] $dmcsIdDanhmuc
 */
class Danhmucchinhsach extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        return Aabc::$app->_danhmucchinhsach->table;        
    }

    public function rules()
    {
        $_Chinhsach = Aabc::$app->_model->Chinhsach ;
        $_Danhmuc = Aabc::$app->_model->Danhmuc ;
        return [
            [[Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc, Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach], 'required'],
            [[Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc, Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach], 'integer'],
            // [[Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach], 'exist', 'skipOnError' => true, 'targetClass' => $_Chinhsach::className(), 'targetAttribute' => [Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach => Aabc::$app->_chinhsach->cs_id]],
            // [[Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc], 'exist', 'skipOnError' => true, 'targetClass' => $_Danhmuc::className(), 'targetAttribute' => [Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc => Aabc::$app->_danhmuc->dm_id]],
        ];
    }



    public function attributeLabels()
    {
        return [
                        
            Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc => Aabc::$app->_danhmucchinhsach->__dmcs_id_danhmuc ,                        
            Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach => Aabc::$app->_danhmucchinhsach->__dmcs_id_chinhsach ,        ];
    }

   


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave( $insert, $changedAttributes );
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
        $dm = $_Danhmuc::find()->andWhere(['dm_id' => $this->dmcs_id_danhmuc])->one();
        if($dm){            
            $_Danhmuc::cache($dm);        
        }
        self::cache($this);
    }

    public static function cache($model)
    {
        $cache = Aabc::$app->dulieu;
        $cache_data = $model->attributes;
        $cache->set('csdm'.$model->dmcs_id_chinhsach.'000'.$model->dmcs_id_danhmuc, $cache_data); 
        return $cache_data;
    }


    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getDmcsIdChinhsach()
    {
        $_Chinhsach = Aabc::$app->_model->Chinhsach;
return $this->hasOne($_Chinhsach::className(), [Aabc::$app->_chinhsach->cs_id => Aabc::$app->_danhmucchinhsach->dmcs_id_chinhsach]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getDmcsIdDanhmuc()
    {
        $_Danhmuc = Aabc::$app->_model->Danhmuc;
        return $this->hasOne($_Danhmuc::className(), [Aabc::$app->_danhmuc->dm_id => Aabc::$app->_danhmucchinhsach->dmcs_id_danhmuc]);
    }





}
