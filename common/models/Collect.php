<?php 
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

class Collect extends ActiveRecord
{
	

	/**
	* @inheritdoc
	* 插入创建者及创建时间/更新者及更新时间
	*/
	public function behaviors()
	{
		return [
			[
			'class' => TimestampBehavior::className(),
			'value' => new Expression('NOW()'),
			],
			BlameableBehavior::className(),
		];
	}
	
	public function rules()
	{
		return [
			[['customer_id', 'goods_id'], 'required'],
		];
	}
	
	public static function tableName()
	{
		return '{{%collect}}';
	}
	
	public static function batchInsert($colums, $data)
	{
		return Yii::$app->db->createCommand()->batchInsert(static::tableName(), $colums, $data)->execute();
	}
	
	public static function findById($Id)
	{
		return static::findOne(['id' => $Id]);
	}
	
	public function getGoods()
	{
        return $this->hasOne(Goods::className(), ['id' => 'goods_id']);
	}

    // 订单和客户通过 Customer.id -> customer_id 关联建立一对一关系
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
	
}