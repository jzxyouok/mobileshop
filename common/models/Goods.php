<?php 
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\UploadBehavior;

class Goods extends ActiveRecord
{
	
	public static function tableName()
	{
		return '{{%goods}}';
	}
	
	public function beforeSave($insert)
	{
		$res = parent::beforeSave($insert);
		if(!$res){
			return $res;
		}
        if (!$this->validate()) {
            Yii::info('Model not updated due to validation error.', __METHOD__);
            return false;
        }
        $file = $this->uploadImgFile();
        if(empty($file) && empty($this->goods_image)){
            $this->addError('imageFile','图片不能为空');
            return false;
        }
        if(!empty($file)) {
            $this->goods_image = $file;
        }
        return true;
	}
	
	public function rules()
	{
		return [
			[['goods_name', 'goods_number', 'brand_id', 'category_id', 'os_id', 'goods_price', 'market_price', 'goods_description', 'special', 'featured', 'status'], 'required'],
			[['imageFile'], 'file', 'extensions' => 'gif, jpg, png, jpeg','mimeTypes' => 'image/jpeg, image/png',],
			[['goods_image'], 'string', 'max' => 255],
			[['galleryFile'], 'file', 'extensions' => 'gif, jpg, png, jpeg','mimeTypes' => 'image/jpeg, image/png', 'maxFiles' => 4],
		];
	}
	
    public function attributeLabels()
    {
        return [
            'category_id' => 'Goods Category',
            'os_id' => 'Goods OS',
            'brand_id' => 'Goods Brand',
            'imageFile' => 'Goods Image',
			'galleryFile' => 'Goods Gallery',
        ];
    }
	
	public static function findById($Id)
	{
		return static::findOne(['id' => $Id]);
	}
	
    public function behaviors()
    {
        return [
            [
                'class' => UploadBehavior::className(),
                'saveDir' => 'goods-img/'
            ]
        ];
    }
	
    public function getGoodsbrand()
    {
        return $this->hasOne(Goodsbrand::className(), ['id' => 'brand_id']);
    }
}