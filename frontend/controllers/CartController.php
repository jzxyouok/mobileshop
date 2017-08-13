<?php 
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Cart;
use common\models\Customer;
use common\models\Address;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class CartController extends Controller
{
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
		$query = Cart::find()->where(['customer_id' => Yii::$app->user->id]);
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => 9,
			],
		]);
		$subtotal = 0.0;
		$total = 0.0;
		if($oCart = Cart::findAll(['customer_id' => Yii::$app->user->id])){
			foreach($oCart as $key => $value){
				$subtotal += $value->goods_count * $value->goods->goods_price;
			}		
			$total = $subtotal + \Yii::$app->params['shipping'];
			$subtotal = number_format($subtotal, 1, '.', '');
			$total = number_format($total, 1, '.', '');
		}
		$oAddress = Address::findAll(['customer_id' => Yii::$app->user->id]);
		return $this->render('list', ['dataProvider' => $dataProvider, 'oAddress' => $oAddress, 'subtotal' => $subtotal, 'total' => $total]);
	}
	
	public function actionAdd()
	{
		if($goods_id = Yii::$app->request->get('goods_id')){
			$model = Cart::find()->where(['customer_id' => Yii::$app->user->id, 'goods_id' => $goods_id])->one();
			$quantity = Yii::$app->request->post('quantity') ? Yii::$app->request->post('quantity') : 1;
			if($model){
				$model->goods_count += $quantity;
			}else{
				$model = new Cart();
				$model->customer_id = Yii::$app->user->id;
				$model->goods_id = $goods_id;
				$model->goods_count = $quantity;
			}
			if($model->save()){
				$cartCount = Cart::find()->where(['customer_id' => Yii::$app->user->id])->count('goods_count');
				Yii::$app->response->cookies->add(new \yii\web\Cookie([
					'name' => 'cartCount',
					'value' => $cartCount,
					'expire' => 3600 * 24 * 30,
				]));
				return $this->redirect('list');
			}else{
				throw new NotFoundHttpException('Add Failed!');
			}
		}else{
			throw new NotFoundHttpException('Add Failed!');
		}
	}
	
	public function actionUpdate()
	{
		if($model = Cart::find()->where(['customer_id' => Yii::$app->user->id, 'id' => Yii::$app->request->get('id')])->one()){
			$quantity = Yii::$app->request->post('quantity') ? Yii::$app->request->post('quantity') : 1;
			$model->goods_count = $quantity;
			if($model->save()){
				$cartCount = Cart::find()->where(['customer_id' => Yii::$app->user->id])->count('goods_count');
				Yii::$app->response->cookies->add(new \yii\web\Cookie([
					'name' => 'cartCount',
					'value' => $cartCount,
					'expire' => 3600 * 24 * 30,
				]));
				return $this->redirect('list');
			}else{
				throw new NotFoundHttpException('Update Failed!');
			}
		}else{
			throw new NotFoundHttpException('Update Failed!');
		}
	}
	
	
	public function actionDelete()
	{
		
		if (Yii::$app->request->get('id')) {
			$model = Cart::find()->where(['id' => Yii::$app->request->get('id'), 'customer_id' => Yii::$app->user->id])->one();
			if($model && $model->delete()){
				$cartCount = Cart::find()->where(['customer_id' => Yii::$app->user->id])->count('goods_count');
				Yii::$app->response->cookies->add(new \yii\web\Cookie([
					'name' => 'cartCount',
					'value' => $cartCount,
					'expire' => 3600 * 24 * 30,
				]));
				return $this->redirect('list');
			}else{
				throw new NotFoundHttpException('Delete Failed!');
			}
		} else {
			throw new NotFoundHttpException('Delete Failed!');
		}
	}
}