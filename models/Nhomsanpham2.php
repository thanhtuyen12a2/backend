<?php

namespace backend\models;

use Aabc;


class Nhomsanpham2 extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'db_nhomsanpham';
    }

    
    public function rules()
    {
        return [
            [['nsp_tennhom', 'nsp_idcha', 'nsp_thutu'], 'required'],
            [['nsp_idcha', 'nsp_thutu'], 'integer'],
            [['nsp_status', 'nsp_recycle'], 'string'],
            [['nsp_tennhom'], 'string', 'max' => 50],
            [['nsp_icon', 'nsp_ghichu'], 'string', 'max' => 100],
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
            'nsp_ghichu' => 'Nsp Ghichu',
            'nsp_status' => 'Nsp Status',
            'nsp_recycle' => 'Nsp Recycle',
        ];
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
