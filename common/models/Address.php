<?php 
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

class Address extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%Address}}';
	}
	
	public function rules()
	{
		return [
			[['address', 'email', 'mobile', 'receiver', 'isdefault'], 'required'],
			[['customer_id'], 'safe']
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
}