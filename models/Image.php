<?php
namespace backend\models;
use Aabc;
use Aabc\base\Model;
use aabc\helpers\Url; /*Them*/

/**
 * This is the model class for table "db_image".
 *
 * @property string $image_id
 * @property string $image_tenfile
 * @property string $image_link
 * @property string $image_recycle
 * @property string $image_status
 * @property integer $image_byte
*
 */
class Image extends \aabc\db\ActiveRecord
{    
    public $image_tenfilemoi;

    public static function tableName()
    {
        return Aabc::$app->_image->table;
    }

    public function rules()
    {
        return [            
            [[Aabc::$app->_image->image_recycle, Aabc::$app->_image->image_status], 'string'],
            [[Aabc::$app->_image->image_byte], 'integer'],
            [[Aabc::$app->_image->image_tenfile], 'string', 'max' => 30],
            [[Aabc::$app->_image->image_morong], 'string', 'max' => 5],
            [[Aabc::$app->_image->image_link], 'string', 'max' => 200],
            [[Aabc::$app->_image->image_size], 'string', 'max' => 10],
            [['image_tenfilemoi'], 'string', 'max' => 30],  
        ];
    }



    public function attributeLabels()
    {
        return [            
            Aabc::$app->_image->image_id => Aabc::$app->_image->__image_id ,                        
            Aabc::$app->_image->image_tenfile => Aabc::$app->_image->__image_tenfile ,   
            Aabc::$app->_image->image_morong => Aabc::$app->_image->__image_morong ,   
            Aabc::$app->_image->image_link => Aabc::$app->_image->__image_link ,                        
            Aabc::$app->_image->image_recycle => Aabc::$app->_image->__image_recycle ,                        
            Aabc::$app->_image->image_status => Aabc::$app->_image->__image_status ,                        
            Aabc::$app->_image->image_byte => Aabc::$app->_image->__image_byte ,       
            Aabc::$app->_image->image_size => Aabc::$app->_image->__image_size ,
            'image_tenfilemoi' => 'Tên mới' ,    ];
    }


    public static function cache($model)
    {
        $cache = Aabc::$app->dulieu;
        $cache_data = $model->attributes;  
        $cache_data['fulllink'] = $model['image_link'] . $model['image_tenfile'] . '-' . $model['image_id'] . $model['image_morong'];
        $cache_data['filename'] = $model['image_tenfile'] . '-' . $model['image_id'] . $model['image_morong'];             
        $cache->set('image'.$model->image_id,$cache_data); 
        return $cache_data; 
    }



     public function afterFind()
    {   
        parent::afterFind();
    }  



    public function getAllRecycle1()
   {
        $_Image = Aabc::$app->_model->Image;
       return   $_Image::find()
                           ->andWhere([Aabc::$app->_image->image_recycle => '1'])
                           ->all();
   }
   public function getAllRecycle0()
   {
       $_Image = Aabc::$app->_model->Image;
       return   $_Image::find()
                           ->andWhere([Aabc::$app->_image->image_recycle => '2'])                            
                           ->all();
   }
    public function getAllStatus1()
   {
       $_Image = Aabc::$app->_model->Image;
       return   $_Image::find()
                           ->andWhere([Aabc::$app->_image->image_status => '1'])
                           ->andWhere([Aabc::$app->_image->image_recycle => '2'])
                           ->all();
   }
    public function getAllStatus2()
   {
       $_Image = Aabc::$app->_model->Image;
       return   $_Image::find()
                           ->andWhere([Aabc::$app->_image->image_status => '2'])
                           ->andWhere([Aabc::$app->_image->image_recycle => '2'])
                           ->all();
   }








}
