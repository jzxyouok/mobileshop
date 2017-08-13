<?php 
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Goodsos extends ActiveRecord
{
	
	public static function tableName()
	{
		return '{{%goods_os}}';
	}
	
	public function rules()
	{
		return [
			[['os_name', 'status'], 'required'],
		];
	}
	
	public static function findById($Id)
	{
		return static::findOne(['id' => $Id]);
	}
}