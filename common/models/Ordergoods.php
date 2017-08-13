<?php 
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

class OrderGoods extends ActiveRecord
{

	public static function tableName()
	{
		return '{{%order_goods}}';
	}
	
	public function rules()
	{
		return [
			[['order_id', 'goods_id', 'goods_count', 'total'], 'required'],
		];
	}
	
	public static function findById($Id)
	{
		return static::findOne(['id' => $Id]);
	}

    // 订单商品和订单通过 Order.id -> order_id 关联建立一对一关系
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
    // 订单商品和商品通过 Goods.id -> goods_id 关联建立一对一关系
	public function getGoods()
	{
        return $this->hasOne(Goods::className(), ['id' => 'goods_id']);
	}
	// 一次插入多条数据
	public static function batchInsert($colums, $data)
	{
		return Yii::$app->db->createCommand()->batchInsert(static::tableName(), $colums, $data)->execute();
	}
}