<?php 
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Goodsgallery extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%goods_gallery}}';
	}
	
	public static function batchInsert($colums, $data)
	{
		return Yii::$app->db->createCommand()->batchInsert(static::tableName(), $colums, $data)->execute();
	}
	
	public static function findById($Id)
	{
		return static::findOne(['id' => $Id]);
	}
	
}