<?php
namespace backend\models;
use Aabc;
use Aabc\base\Model;
use Aabc\web\UploadedFile;

class Up extends \Aabc\base\Model
{
    /**
     * @var UploadedFile[]
     */
    // public $imageFiles;
    private $_attributes;
    
    public function __construct() {
        $this->_attributes = [Aabc::$app->_up->imageFiles => null];
    }
    public function __get($name)
    {
        if (array_key_exists($name, $this->_attributes))
            return $this->_attributes[$name];
        return parent::__get($name);
    }
    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->_attributes))
            $this->_attributes[$name] = $value;
        else parent::__set($name, $value);
    }


    public function rules()
    {
        return [
            [[Aabc::$app->_up->imageFiles], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 20, 'maxSize' => (1024 * 1024 * 5)],

            // ['image', 'image', 'minWidth' => 250, 'maxWidth' => 250,'minHeight' => 250, 'maxHeight' => 250, 'extensions' => 'jpg, gif, png', 'maxSize' => 1024 * 1024 * 2],
        ];
    }
    
     public function attributeLabels()
    {
        return [
            Aabc::$app->_up->imageFiles => Aabc::$app->_up->__imageFiles,
        ];
    }
   
}

