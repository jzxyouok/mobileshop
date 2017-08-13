<?php 
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Json;

class Goodscategory extends ActiveRecord
{
	
	public static function tableName()
	{
		return '{{%goods_category}}';
	}
	
	public function rules()
	{
		return [
			[['category_name', 'status'], 'required'],
			[['os_group', 'brand_group'], 'safe'],
		];
	}
	
	public function beforeSave($insert)
	{
		$res = parent::beforeSave($insert);
		if(!$res){
			return $res;
		}
		if($this->os_group){
			$this->os_group = Json::encode($this->os_group);
		}
		if($this->brand_group){
			$this->brand_group = Json::encode($this->brand_group);
		}
		return true;
	}
	
	public function afterFind()
	{
		parent::afterFind();
		if($this->os_group){
			$this->os_group = Json::decode($this->os_group);
		}
		if($this->brand_group){
			$this->brand_group = Json::decode($this->brand_group);
		}
	}
	
	public static function findById($Id)
	{
		return static::findOne(['id' => $Id]);
	}
}