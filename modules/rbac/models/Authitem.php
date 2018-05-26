<?php

namespace backend\modules\rbac\models;

use Aabc;


class Authitem extends \aabc\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'db_auth_item';
    }

    
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'name' => 'Tên quyền',
            'type' => 'Level',
            'description' => 'Description',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    //Kết nối bảng child, đếm những quyền nào được phân cho admin, trả vào checkbox
    public function getAuthitemdev(){
        return $this->hasOne(AuthItemChild::className(), ['child' => 'name'])->andWhere(['parent' => 'dev'])->count();
    }
    public function getAuthitemadmin(){
        return $this->hasOne(AuthItemChild::className(), ['child' => 'name'])->andWhere(['parent' => 'admin'])->count();
    }
    public function getAuthitemmanager(){
        return $this->hasOne(AuthItemChild::className(), ['child' => 'name'])->andWhere(['parent' => 'manager'])->count();
    }
    public function getAuthitemuser(){
        return $this->hasOne(AuthItemChild::className(), ['child' => 'name'])->andWhere(['parent' => 'user'])->count();
    }


    //Đếm số quyền được phân cho parent tại bảng child
    public function getAuthitemcount(){
        return $this->hasOne(AuthItemChild::className(), ['parent' => 'name'])->count();
    }


    
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['item_name' => 'name']);
    }

    
    public function getAuthItemChildren()
    {
        return $this->hasMany(AuthItemChild::className(), ['parent' => 'name']);
    }

    
    public function getAuthItemChildren0()
    {
        return $this->hasMany(AuthItemChild::className(), ['child' => 'name']);
    }

    
    public function getChildren()
    {
        return $this->hasMany(Authitem::className(), ['name' => 'child'])->viaTable('db_auth_item_child', ['parent' => 'name']);
    }

    
    public function getParents()
    {
        return $this->hasMany(Authitem::className(), ['name' => 'parent'])->viaTable('db_auth_item_child', ['child' => 'name']);
    }
}
