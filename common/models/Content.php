<?php 
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Content extends ActiveRecord
{
	
	public static function tableName()
	{
		return '{{%content}}';
	}
	
	public function rules()
	{
		return [
			[['name', 'content', 'status'], 'required'],
		];
	}
	
	public static function findById($Id)
	{
		return static::findOne(['id' => $Id]);
	}
}