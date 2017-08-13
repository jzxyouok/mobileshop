<?php 
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\UploadBehavior;

class Banner extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%banner}}';
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
        if(empty($file) && empty($this->banner_img)){
            $this->addError('imageFile','图片不能为空');
            return false;
        }
        if(!empty($file)) {
            $this->banner_img = $file;
        }
        return true;
	}
	
	public static function batchInsert($colums, $data)
	{
		return Yii::$app->db->createCommand()->batchInsert(static::tableName(), $colums, $data)->execute();
	}
	
	public static function findById($Id)
	{
		return static::findOne(['id' => $Id]);
	}
	
	public static function findGroup($condition = ['status' => '1'], $groupcolums = 'banner_type')
	{
		$oBanner = static::findAll($condition);
		$aGroupRs = [];
		foreach($oBanner as $key => $value){
			$aGroupRs[$value[$groupcolums]][] = $value;
		}
		return $aGroupRs;
	}
	
	public function rules()
	{
		return [
			[['banner_title', 'banner_url', 'banner_type', 'status'], 'required'],
			[['imageFile'], 'file', 'extensions' => 'gif, jpg, png, jpeg','mimeTypes' => 'image/jpeg, image/png',],
			[['banner_img'], 'string', 'max' => 255],
		];
	}
	
    public function behaviors()
    {
        return [
            [
                'class' => UploadBehavior::className(),
                'saveDir' => 'banner-img/'
            ]
        ];
    }
}