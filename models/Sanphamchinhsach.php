<?php
namespace backend\models;
use Aabc;
/**
**/


/**
 * This is the model class for table "db_sanpham_chinhsach".
 *
 * @property integer $spcs_id_chinhsach
 * @property integer $spcs_id_sp
*
 *
 * @property $_Chinhsach = Aabc::$app->_model->Chinhsach[] $spcsIdChinhsach
 * @property $_Sanpham = Aabc::$app->_model->Sanpham[] $spcsIdSp
 */
class Sanphamchinhsach extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        return Aabc::$app->_sanphamchinhsach->table;        
    }

    public function rules()
    {
        $_Chinhsach = Aabc::$app->_model->Chinhsach;
        $_Sanpham = Aabc::$app->_model->Sanpham;
        
        return [
            [[Aabc::$app->_sanphamchinhsach->spcs_id_chinhsach, Aabc::$app->_sanphamchinhsach->spcs_id_sp], 'required'],
            [[Aabc::$app->_sanphamchinhsach->spcs_id_chinhsach, Aabc::$app->_sanphamchinhsach->spcs_id_sp], 'integer'],
            // [[Aabc::$app->_sanphamchinhsach->spcs_id_chinhsach], 'exist', 'skipOnError' => true, 'targetClass' => $_Chinhsach::className(), 'targetAttribute' => [Aabc::$app->_sanphamchinhsach->spcs_id_chinhsach => Aabc::$app->_chinhsach->cs_id]],
            // [[Aabc::$app->_sanphamchinhsach->spcs_id_sp], 'exist', 'skipOnError' => true, 'targetClass' => $_Sanpham::className(), 'targetAttribute' => [Aabc::$app->_sanphamchinhsach->spcs_id_sp => Aabc::$app->_sanpham->sp_id]],
        ];
    }


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave( $insert, $changedAttributes );        
        $sp = (Sanpham::M)::find()->andWhere(['sp_id' => $this->spcs_id_sp])->one();
        if($sp){            
            Sanpham::cache($sp);
        }
        self::cache($this);
    }

    public static function cache($model)
    {
        $cache = Aabc::$app->dulieu;
        $cache_data = $model->attributes;
        $cache->set('cssp'.$model->spcs_id_chinhsach.'000'.$model->spcs_id_sp, $cache_data); 
        return $cache_data;
    }




    public function attributeLabels()
    {
        return [
                        
            Aabc::$app->_sanphamchinhsach->spcs_id_chinhsach => Aabc::$app->_sanphamchinhsach->__spcs_id_chinhsach ,                        
            Aabc::$app->_sanphamchinhsach->spcs_id_sp => Aabc::$app->_sanphamchinhsach->__spcs_id_sp ,        ];
    }

    public function getAllRecycle1()
   {
        $_Sanphamchinhsach = Aabc::$app->_model->Sanphamchinhsach;
       return   $_Sanphamchinhsach::find()
                           ->andWhere([Aabc::$app->_sanphamchinhsach->spcs_recycle => '1'])
                           ->all();
   }
   public function getAllRecycle0()
   {
       $_Sanphamchinhsach = Aabc::$app->_model->Sanphamchinhsach;
       return   $_Sanphamchinhsach::find()
                           ->andWhere([Aabc::$app->_sanphamchinhsach->spcs_recycle => '2'])                            
                           ->all();
   }
    public function getAllStatus1()
   {
       $_Sanphamchinhsach = Aabc::$app->_model->Sanphamchinhsach;
       return   $_Sanphamchinhsach::find()
                           ->andWhere([Aabc::$app->_sanphamchinhsach->spcs_status => '1'])
                           ->andWhere([Aabc::$app->_sanphamchinhsach->spcs_recycle => '2'])
                           ->all();
   }
    public function getAllStatus2()
   {
       $_Sanphamchinhsach = Aabc::$app->_model->Sanphamchinhsach;
       return   $_Sanphamchinhsach::find()
                           ->andWhere([Aabc::$app->_sanphamchinhsach->spcs_status => '2'])
                           ->andWhere([Aabc::$app->_sanphamchinhsach->spcs_recycle => '2'])
                           ->all();
   }



    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSpcsIdChinhsach()
    {
        $_Chinhsach = Aabc::$app->_model->Chinhsach;
return $this->hasOne($_Chinhsach::className(), [Aabc::$app->_chinhsach->cs_id => Aabc::$app->_sanphamchinhsach->spcs_id_chinhsach]);
    }
    /**
     * @return \aabc\db\ActiveQuery
     */
    public function getSpcsIdSp()
    {
        $_Sanpham = Aabc::$app->_model->Sanpham;
return $this->hasOne($_Sanpham::className(), [Aabc::$app->_sanpham->sp_id => Aabc::$app->_sanphamchinhsach->spcs_id_sp]);
    }





}
