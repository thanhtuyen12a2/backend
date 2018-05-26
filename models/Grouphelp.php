<?php

namespace backend\models;

use Aabc;


class Grouphelp extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'db_grouphelp';
    }

    
    public function rules()
    {
        return [
            [['gh_ten'], 'required'],
            [['gh_ten'], 'string', 'max' => 30],
            [['gh_mota'], 'string', 'max' => 100],
        ];
    }

    


    public function attributeLabels()
    {
        return [
                        'gh_id' => 'Gh ID',
                        'gh_ten' => 'Gh Ten',
                        'gh_mota' => 'Gh Mota',
        ];
    }


   //  public function getAllRecycle1()
   // {
   //     return  Grouphelp::find()
   //                         ->andWhere(['gh_recycle' => '1'])
   //                         ->all();
   // }


   // public function getAllRecycle0()
   // {
   //     return  Grouphelp::find()
   //                         ->andWhere(['gh_recycle' => '2'])                            
   //                         ->all();
   // }


   //  public function getAllStatus1()
   // {
   //     return  Grouphelp::find()
   //                         ->andWhere(['gh_status' => '1'])
   //                         ->andWhere(['gh_recycle' => '2'])
   //                         ->all();
   // }


 // public function getAllStatus2()
 //   {
 //       return  Grouphelp::find()
 //                           ->andWhere(['gh_status' => '2'])
 //                           ->andWhere(['gh_recycle' => '2'])
 //                           ->all();
 //   }




    


    public function getItemhelps()
    {
        return $this->hasMany(Itemhelp::className(), ['ih_id_grouphelp' => 'gh_id']);
    }
}
