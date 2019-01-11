<?php

namespace backend\models;

use Aabc;


class Khachhang extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'db_khachhang';
    }

    
    public function rules()
    {
        return [
            [['kh_idnhomkhachhang', 'kh_gioitinh', 'kh_xungho'], 'integer'],
            [['kh_xacnhan'], 'string'],
            [['kh_lastlogin'], 'safe'],
            [['kh_ten', 'kh_sodienthoai'], 'string', 'max' => 50],
            [['kh_email'], 'string', 'max' => 100],
            [['kh_diachi', 'kh_matkhau'], 'string', 'max' => 255],
            [['kh_tendangnhap'], 'string', 'max' => 20],
            [['kh_auth_key'], 'string', 'max' => 32],

            ['kh_ten','kh_email','kh_sodienthoai', 'trim'],
            // [['kh_idnhomkhachhang'], 'exist', 'skipOnError' => true, 'targetClass' => Nhomkhachhang::className(), 'targetAttribute' => ['kh_idnhomkhachhang' => 'nkh_id']],
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'kh_id' => 'Kh ID',
            'kh_ten' => 'Kh Ten',
            'kh_sodienthoai' => 'Kh Sodienthoai',
            'kh_email' => 'Kh Email',
            'kh_diachi' => 'Kh Diachi',
            'kh_idnhomkhachhang' => 'Kh Idnhomkhachhang',
            'kh_xacnhan' => 'Kh Xacnhan',
            'kh_tendangnhap' => 'Kh Tendangnhap',
            'kh_auth_key' => 'Kh Auth Key',
            'kh_matkhau' => 'Kh Matkhau',
            'kh_lastlogin' => 'Kh Lastlogin',
            'kh_gioitinh' => 'Kh Gioitinh',
            'kh_xungho' => 'Kh Xungho',
        ];
    }

    
    // public function getDonhangs()
    // {
    //     return $this->hasMany(Donhang::className(), ['ddh_idkhachhang' => 'kh_id']);
    // }

    
    // public function getKhIdnhomkhachhang()
    // {
    //     return $this->hasOne(Nhomkhachhang::className(), ['nkh_id' => 'kh_idnhomkhachhang']);
    // }
}
