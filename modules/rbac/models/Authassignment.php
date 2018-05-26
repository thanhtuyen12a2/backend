<?php

namespace backend\modules\rbac\models;

use Aabc;


class Authassignment extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'db_auth_assignment';
    }

    
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['created_at'], 'integer'],
            [['item_name', 'user_id'], 'string', 'max' => 64],
            [['item_name'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::className(), 'targetAttribute' => ['item_name' => 'name']],
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'item_name' => 'Nhóm quyền',
            'user_id' => 'Người dùng',
            'created_at' => 'Created At',
        ];
    }

    
    public function getItemName()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'item_name']);
    }
}
