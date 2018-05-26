<?php

namespace backend\models;

use Aabc;


class Itemhelp extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'db_itemhelp';
    }

    
    public function rules()
    {
        return [
            [['ih_noidung', 'ih_sothutu', 'ih_ten'], 'required'],
            [['ih_noidung'], 'string'],
            [['ih_sothutu', 'ih_id_grouphelp'], 'integer'],
            [['ih_ten'], 'string', 'max' => 20],
            [['ih_action', 'ih_check', 'ih_focus'], 'string', 'max' => 30],
            [['ih_id_grouphelp'], 'exist', 'skipOnError' => true, 'targetClass' => Grouphelp::className(), 'targetAttribute' => ['ih_id_grouphelp' => 'gh_id']],
        ];
    }

    


    public function attributeLabels()
    {
        return [
                        'ih_id' => 'ID',
                        'ih_ten' => 'Tên',
                        'ih_action' => 'Action',
                        'ih_check' => 'Check',
                        'ih_focus' => 'Focus',
                        'ih_noidung' => 'Nội dung',
                        'ih_sothutu' => 'Stt',
                        'ih_id_grouphelp' => 'Group',
        ];
    }


 //    public function getAllRecycle1()
 //   {
 //       return  Itemhelp::find()
 //                           ->andWhere(['ih_recycle' => '1'])
 //                           ->all();
 //   }


 //   public function getAllRecycle0()
 //   {
 //       return  Itemhelp::find()
 //                           ->andWhere(['ih_recycle' => '2'])                            
 //                           ->all();
 //   }


 //    public function getAllStatus1()
 //   {
 //       return  Itemhelp::find()
 //                           ->andWhere(['ih_status' => '1'])
 //                           ->andWhere(['ih_recycle' => '2'])
 //                           ->all();
 //   }


 // public function getAllStatus2()
 //   {
 //       return  Itemhelp::find()
 //                           ->andWhere(['ih_status' => '2'])
 //                           ->andWhere(['ih_recycle' => '2'])
 //                           ->all();
 //   }




    


    public function getIhIdGrouphelp()
    {
        return $this->hasOne(Grouphelp::className(), ['gh_id' => 'ih_id_grouphelp']);
    }
}
