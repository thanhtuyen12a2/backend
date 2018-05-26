<?php
namespace backend\models;
use Aabc;
/**
**/


/**
 * This is the model class for table "db_cauhinhcaidat".
 *
 * @property integer $chcd_id
 * @property string $chcd_ten
 * @property string $chcd_logo
 * @property string $chcd_diachi
 * @property string $chcd_dienthoai
 * @property string $chcd_email
 * @property string $chcd_website
 * @property string $chcd_tieudeseo
 * @property string $chcd_motaseo
 * @property string $chcd_googlebot
 * @property string $chcd_robots
 * @property string $chcd_ananytic
 * @property string $chcd_fbid
 * @property string $chcd_fbapp
 * @property string $chcd_fbpixel
 * @property string $chcd_googlewmt
 * @property string $chcd_tiente
 * @property string $chcd_vitritiente
 * @property string $chcd_trongluong
 * @property string $chcd_dodai
 * @property string $chcd_dientich
 * @property string $chcd_donvitinh
*
 */
class Cauhinhcaidat extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        return Aabc::$app->_cauhinhcaidat->table;        
    }

    public function rules()
    {
        return [
            [[Aabc::$app->_cauhinhcaidat->chcd_googlebot, Aabc::$app->_cauhinhcaidat->chcd_robots, Aabc::$app->_cauhinhcaidat->chcd_tiente, Aabc::$app->_cauhinhcaidat->chcd_vitritiente, Aabc::$app->_cauhinhcaidat->chcd_trongluong, Aabc::$app->_cauhinhcaidat->chcd_dodai, Aabc::$app->_cauhinhcaidat->chcd_dientich, Aabc::$app->_cauhinhcaidat->chcd_donvitinh], 'string'],
            [[Aabc::$app->_cauhinhcaidat->chcd_vitritiente, Aabc::$app->_cauhinhcaidat->chcd_trongluong, Aabc::$app->_cauhinhcaidat->chcd_dodai, Aabc::$app->_cauhinhcaidat->chcd_dientich, Aabc::$app->_cauhinhcaidat->chcd_donvitinh], 'required'],
            [[Aabc::$app->_cauhinhcaidat->chcd_ten, Aabc::$app->_cauhinhcaidat->chcd_diachi, Aabc::$app->_cauhinhcaidat->chcd_fbpixel], 'string', 'max' => 200],
            [[Aabc::$app->_cauhinhcaidat->chcd_logo, Aabc::$app->_cauhinhcaidat->chcd_dienthoai, Aabc::$app->_cauhinhcaidat->chcd_email, Aabc::$app->_cauhinhcaidat->chcd_website], 'string', 'max' => 40],
            [[Aabc::$app->_cauhinhcaidat->chcd_tieudeseo], 'string', 'max' => 60],
            [[Aabc::$app->_cauhinhcaidat->chcd_motaseo], 'string', 'max' => 150],
            [[Aabc::$app->_cauhinhcaidat->chcd_ananytic], 'string', 'max' => 50],
            [[Aabc::$app->_cauhinhcaidat->chcd_fbid, Aabc::$app->_cauhinhcaidat->chcd_fbapp, Aabc::$app->_cauhinhcaidat->chcd_googlewmt], 'string', 'max' => 20],
        ];
    }



    public function attributeLabels()
    {
        return [
                        
            Aabc::$app->_cauhinhcaidat->chcd_id => Aabc::$app->_cauhinhcaidat->__chcd_id ,                        
            Aabc::$app->_cauhinhcaidat->chcd_ten => Aabc::$app->_cauhinhcaidat->__chcd_ten ,                        
            Aabc::$app->_cauhinhcaidat->chcd_logo => Aabc::$app->_cauhinhcaidat->__chcd_logo ,                        
            Aabc::$app->_cauhinhcaidat->chcd_diachi => Aabc::$app->_cauhinhcaidat->__chcd_diachi ,                        
            Aabc::$app->_cauhinhcaidat->chcd_dienthoai => Aabc::$app->_cauhinhcaidat->__chcd_dienthoai ,                        
            Aabc::$app->_cauhinhcaidat->chcd_email => Aabc::$app->_cauhinhcaidat->__chcd_email ,                        
            Aabc::$app->_cauhinhcaidat->chcd_website => Aabc::$app->_cauhinhcaidat->__chcd_website ,                        
            Aabc::$app->_cauhinhcaidat->chcd_tieudeseo => Aabc::$app->_cauhinhcaidat->__chcd_tieudeseo ,                        
            Aabc::$app->_cauhinhcaidat->chcd_motaseo => Aabc::$app->_cauhinhcaidat->__chcd_motaseo ,                        
            Aabc::$app->_cauhinhcaidat->chcd_googlebot => Aabc::$app->_cauhinhcaidat->__chcd_googlebot ,                        
            Aabc::$app->_cauhinhcaidat->chcd_robots => Aabc::$app->_cauhinhcaidat->__chcd_robots ,                        
            Aabc::$app->_cauhinhcaidat->chcd_ananytic => Aabc::$app->_cauhinhcaidat->__chcd_ananytic ,                        
            Aabc::$app->_cauhinhcaidat->chcd_fbid => Aabc::$app->_cauhinhcaidat->__chcd_fbid ,                        
            Aabc::$app->_cauhinhcaidat->chcd_fbapp => Aabc::$app->_cauhinhcaidat->__chcd_fbapp ,                        
            Aabc::$app->_cauhinhcaidat->chcd_fbpixel => Aabc::$app->_cauhinhcaidat->__chcd_fbpixel ,                        
            Aabc::$app->_cauhinhcaidat->chcd_googlewmt => Aabc::$app->_cauhinhcaidat->__chcd_googlewmt ,                        
            Aabc::$app->_cauhinhcaidat->chcd_tiente => Aabc::$app->_cauhinhcaidat->__chcd_tiente ,                        
            Aabc::$app->_cauhinhcaidat->chcd_vitritiente => Aabc::$app->_cauhinhcaidat->__chcd_vitritiente ,                        
            Aabc::$app->_cauhinhcaidat->chcd_trongluong => Aabc::$app->_cauhinhcaidat->__chcd_trongluong ,                        
            Aabc::$app->_cauhinhcaidat->chcd_dodai => Aabc::$app->_cauhinhcaidat->__chcd_dodai ,                        
            Aabc::$app->_cauhinhcaidat->chcd_dientich => Aabc::$app->_cauhinhcaidat->__chcd_dientich ,                        
            Aabc::$app->_cauhinhcaidat->chcd_donvitinh => Aabc::$app->_cauhinhcaidat->__chcd_donvitinh ,        ];
    }

    public function getAllRecycle1()
   {
        $_Cauhinhcaidat = Aabc::$app->_model->Cauhinhcaidat;
       return   $_Cauhinhcaidat::find()
                           ->andWhere([Aabc::$app->_cauhinhcaidat->chcd_recycle => '1'])
                           ->all();
   }
   public function getAllRecycle0()
   {
       $_Cauhinhcaidat = Aabc::$app->_model->Cauhinhcaidat;
       return   $_Cauhinhcaidat::find()
                           ->andWhere([Aabc::$app->_cauhinhcaidat->chcd_recycle => '2'])                            
                           ->all();
   }




    public function getAll1()
   {
       $_Cauhinhcaidat = Aabc::$app->_model->Cauhinhcaidat;
       return   $_Cauhinhcaidat::find()
                           ->andWhere([Aabc::$app->_cauhinhcaidat->chcd_status => '1'])
                           ->andWhere([Aabc::$app->_cauhinhcaidat->chcd_recycle => '2'])
                           ->all();
   }
    public function getAll2()
   {
       $_Cauhinhcaidat = Aabc::$app->_model->Cauhinhcaidat;
       return   $_Cauhinhcaidat::find()
                           ->andWhere([Aabc::$app->_cauhinhcaidat->chcd_status => '2'])
                           ->andWhere([Aabc::$app->_cauhinhcaidat->chcd_recycle => '2'])
                           ->all();
   }










}
