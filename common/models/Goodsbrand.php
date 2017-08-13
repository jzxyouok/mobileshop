<?php 
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Goodsbrand extends ActiveRecord
{
	
	public static function tableName()
	{
		return '{{%goods_brand}}';
	}
	
	public function rules()
	{
		return [
			[['brand_name', 'status'], 'required'],
		];
	}
	
	public static function findById($Id)
	{
		return static::findOne(['id' => $Id]);
	}
}