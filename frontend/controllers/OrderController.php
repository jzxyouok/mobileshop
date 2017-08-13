<?php 
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Cart;
use common\models\Ordergoods;
use common\models\Order;
use common\models\Address;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class OrderController extends Controller
{
	
	public $layout = 'account-main';
	
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
	
	public function actionList()
	{
		$aWhere = ['customer_id' => Yii::$app->user->id];
		if($status = Yii::$app->request->get('status')){
			switch($status){
				case 'current' :
					$aWhere = array_merge($aWhere, ['order_status' => 1]);
					break;
				case 'past' :
					$aWhere = array_merge($aWhere, ['order_status' => 2]);
					break;
				case 'returns' :
					$aWhere = array_merge($aWhere, ['order_status' => 3]);
					break;
			}
		}
		$query = Order::find()->where($aWhere);
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => 9,
			],
		]);
		return $this->render('list', ['dataProvider' => $dataProvider]);
	}
	
	public function actionAdd()
	{
		if($address = Yii::$app->request->post('address')){
			if(Address::findOne(['id' => $address])){
				if($oCart = Cart::findAll(['customer_id' => Yii::$app->user->id])){
					$tax = 0.0;
					$subtotal = 0.0;
					$items = [];
					foreach($oCart as $key => $value){
						$subtotal += $value->goods_count * $value->goods->goods_price;
						$items[] = [$value->goods->goods_name, 'USD', $value->goods_count, $value->goods->goods_number, $value->goods->goods_price];
					}
					$model = new Order();
					$model->customer_id = Yii::$app->user->id;
					$model->order_number = time() . rand(100,999);
					$model->shipping = \Yii::$app->params['shipping'];
					$model->subtotal = $subtotal;
					$model->total = $subtotal + $model->shipping;
					$model->address_id = $address;
					$model->pay_status = 1;
					$model->order_status = 1;
					$model->save();
					$aBatchData = [];
					foreach($oCart as $key => $value){
						$aBatchData[] = [$model->id, $value->goods_id, $value->goods_count, $value->goods_count * $value->goods->goods_price];
					}
					if(Ordergoods::batchInsert(['order_id', 'goods_id', 'goods_count', 'total'], $aBatchData)){
						Cart::deleteAll('customer_id = '.Yii::$app->user->id);
						return $this->redirect(Yii::$app->paypal->getLink(Yii::$app->paypal->getDemoPaymentUsingPayPal('http://www.mobileshop.front/', $items, $model->shipping, $tax, $subtotal, $model->total)->links,'approval_url'));
					}
				}
			}
		}
		return $this->redirect('/cart/list');
	}
	
	public function actionShow()
	{
		if($id = Yii::$app->request->get('id')){
			if($model = Order::find()->where(['customer_id' => Yii::$app->user->id, 'id' => $id])->one()){
				$oAddress = $model->address;
				$query = Ordergoods::find()->where(['order_id' => $id]);
				$dataProvider = new ActiveDataProvider([
					'query' => $query,
					'pagination' => [
						'pageSize' => 9,
					],
				]);
				return $this->render('show', ['model' => $model, 'oAddress' => $oAddress, 'dataProvider' => $dataProvider]);
			}else{
				throw new NotFoundHttpException('Not Found Page!');
			}
		}else{
			throw new NotFoundHttpException('Not Found Page!');
		}
	}
}