<?php

namespace backend\modules\rbac\models;

use Aabc;


class Authitemchild extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'db_auth_item_child';
    }

    
    public function rules()
    {
        return [
            [['parent', 'child'], 'required'],
            [['parent', 'child'], 'string', 'max' => 64],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::className(), 'targetAttribute' => ['parent' => 'name']],
            [['child'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::className(), 'targetAttribute' => ['child' => 'name']],
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'parent' => 'Nhóm quyền',
            'child' => 'Quyền',
        ];
    }

    
    public function getAuthitem()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'parent']);
    }

    
    public function getChild0()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'child']);
    }
}
