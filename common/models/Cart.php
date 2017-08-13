<?php 
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

class Cart extends ActiveRecord
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

	public static function tableName()
	{
		return '{{%cart}}';
	}
	
	public function rules()
	{
		return [
			[['customer_id', 'goods_id', 'goods_count'], 'required'],
		];
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