<?php 
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Guestbook extends ActiveRecord
{
	
	public static function tableName()
	{
		return '{{%guestbook}}';
	}
	
	public function rules()
	{
		return [
			[['name', 'email', 'mobile', 'message'], 'required'],
		];
	}
	
	public static function findById($Id)
	{
		return static::findOne(['id' => $Id]);
	}
}