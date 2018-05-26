<?php
namespace backend\models;
use Aabc;


class Domain extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        return Aabc::$app->domain->table;        
    }

    public function rules()
    {
        return [
            [[Aabc::$app->domain->dm_domain, Aabc::$app->domain->dm_length], 'required'],
            [[Aabc::$app->domain->dm_length], 'integer'],
            [[Aabc::$app->domain->dm_timedownload], 'safe'],
            [[Aabc::$app->domain->dm_status, Aabc::$app->domain->dm_recycle, Aabc::$app->domain->dm_tiemnang], 'string'],
            [[Aabc::$app->domain->dm_domain], 'string', 'max' => 50],
            [[Aabc::$app->domain->dm_chude], 'string', 'max' => 250],
            [[Aabc::$app->domain->dm_email], 'string', 'max' => 255],
            [[Aabc::$app->domain->dm_source], 'string', 'max' => 30],
            [['dm_domain'], 'unique'],
        ];
    }



    public function attributeLabels()
    {
        return [
                        
            Aabc::$app->domain->dm_id => Aabc::$app->domain->__dm_id ,                        
            Aabc::$app->domain->dm_domain => Aabc::$app->domain->__dm_domain ,                        
            Aabc::$app->domain->dm_length => Aabc::$app->domain->__dm_length ,                        
            Aabc::$app->domain->dm_status => Aabc::$app->domain->__dm_status ,                        
            Aabc::$app->domain->dm_recycle => Aabc::$app->domain->__dm_recycle ,                        
            Aabc::$app->domain->dm_tiemnang => Aabc::$app->domain->__dm_tiemnang ,                        
            Aabc::$app->domain->dm_chude => Aabc::$app->domain->__dm_chude ,                        
            Aabc::$app->domain->dm_source => Aabc::$app->domain->__dm_source ,
            Aabc::$app->domain->dm_email => Aabc::$app->domain->__dm_email ,
            Aabc::$app->domain->dm_timedownload => Aabc::$app->domain->__dm_timedownload ,        ];
    }

    public function getAllRecycle1()
   {
       return  Domain::find()
                           ->andWhere([Aabc::$app->domain->dm_recycle => '1'])
                           ->all();
   }
   public function getAllRecycle0()
   {
       return  Domain::find()
                           ->andWhere([Aabc::$app->domain->dm_recycle => '2'])                            
                           ->all();
   }
    public function getAllStatus1()
   {
       return  Domain::find()
                           // ->andWhere([Aabc::$app->domain->dm_status => '1'])
                           ->andWhere([Aabc::$app->domain->dm_recycle => '2'])
                           ->all();
   }
    public function getAllStatus2()
   {
       return  Domain::find()
                           // ->andWhere([Aabc::$app->domain->dm_status => '2'])
                           ->andWhere([Aabc::$app->domain->dm_recycle => '2'])
                           ->all();
   }








}
