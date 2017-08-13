<?php 
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

class Order extends ActiveRecord
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
		return '{{%order}}';
	}
	
	public function rules()
	{
		return [
			[['customer_id', 'order_number', 'subtotal', 'total', 'shipping', 'pay_status', 'order_status'], 'required'],
		];
	}
	
	public static function findById($Id)
	{
		return static::findOne(['id' => $Id]);
	}

    // 订单和客户通过 Customer.id -> customer_id 关联建立一对一关系
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
	
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }
	
    public function getOrdergoods()
    {
        return $this->hasMany(Ordergoods::className(), ['order_id' => 'id']);
    }
}