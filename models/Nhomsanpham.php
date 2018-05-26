<?php

namespace backend\models;

use Aabc;


class Nhomsanpham extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'db_nhomsanpham';
    }

    
    public function rules()
    {
        return [
            [['nsp_tennhom', 'nsp_idcha', 'nsp_thutu'], 'required'],
            [['nsp_idcha', 'nsp_thutu', 'nsp_sothutu'], 'integer'],
            [['nsp_status', 'nsp_recycle'], 'string'],
            [['nsp_tennhom'], 'string', 'max' => 50],
            [['nsp_icon', 'nsp_ghichu', 'nsp_char'], 'string', 'max' => 100],
            [['nsp_link'], 'string', 'max' => 150],
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'nsp_id' => 'Nsp ID',
            'nsp_tennhom' => 'Nsp Tennhom',
            'nsp_idcha' => 'Nsp Idcha',
            'nsp_icon' => 'Nsp Icon',
            'nsp_link' => 'Nsp Link',
            'nsp_thutu' => 'Nsp Thutu',
            'nsp_sothutu' => 'Nsp SoThutu',
            'nsp_ghichu' => 'Nsp Ghichu',
            'nsp_status' => 'Nsp Status',
            'nsp_recycle' => 'Nsp Recycle',
            'nsp_char' => 'Nsp Char',
        ];
    }

    
    public function getAllRecycle1()
    {
        return  Nhomsanpham::find()
                            ->andWhere(['nsp_recycle' => '1'])
                            ->all();
    }
 

    public function getAllRecycle0()
    {
        return  Nhomsanpham::find()
                            ->andWhere(['nsp_recycle' => '2'])
                            ->orderBy(['nsp_thutu'=>SORT_ASC])
                            ->all();
    }

    public function getAllNhomsanpham()
    {
        return Nhomsanpham::find()
                            ->andWhere(['nsp_recycle' => '2'])
                            // ->andWhere(['nsp_status' => '1'])
                            ->orderBy(['nsp_thutu'=>SORT_ASC])
                            ->all();
    }

     public function getAllSothutu()
    {
        return Nhomsanpham::find()    
                        ->andWhere(['nsp_recycle' => '2'])
                        ->andWhere(['nsp_status' => '1'])                    
                        ->orderBy(['nsp_sothutu' => SORT_ASC])
                        ->all();
    }



    public function getNhomsanphamNgonngus()
    {
        return $this->hasMany(NhomsanphamNgonngu::className(), ['nspnn_idnhomsanpham' => 'nsp_id']);
    }

    
    public function getNspnnIdngonngus()
    {
        return $this->hasMany(Ngonngu::className(), ['ngonngu_id' => 'nspnn_idngonngu'])->viaTable('db_nhomsanpham_ngonngu', ['nspnn_idnhomsanpham' => 'nsp_id']);
    }

    
    public function getSanphams()
    {
        return $this->hasMany(Sanpham::className(), ['sp_id_nhomsanpham' => 'nsp_id']);
    }
}
