<?php
namespace backend\controllers;

use Yii;
use common\models\Cart;
use common\models\Customer;
use common\models\Goods;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;


/**
 * Site controller
 */
class CartController extends BaseController
{
    public function actionList()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Cart::find(),
			'pagination' => [
				'pageSize' => 20,
			],
		]);
		return $this->render('list',['dataProvider' => $dataProvider]);
	}
	
	public function actionCreate()
	{
		$model = new Cart();
		if (Yii::$app->request->isPost) {
			if($model->load(Yii::$app->request->post()) && $model->save()){
				return $this->redirect('list');
			}
		}
		$oCustomer = Customer::find()->all();
		$oGoods = Goods::findAll(['status' => '1']);
		return $this->render('edit', ['model' => $model, 'oCustomer' => $oCustomer, 'oGoods' => $oGoods]);
	}
	
	public function actionUpdate()
	{
		if($id = Yii::$app->request->get('id')){
			$model = Cart::findById($id);
			if(Yii::$app->request->isPost){
				if($model->load(Yii::$app->request->post()) && $model->save()){
					return $this->redirect('list');
				}
			}
			$oCustomer = Customer::find()->all();
			$oGoods = Goods::findAll(['status' => '1']);
			return $this->render('edit', ['model' => $model, 'oCustomer' => $oCustomer, 'oGoods' => $oGoods]);
		}else{
			throw new NotFoundHttpException('Not Found Page!');
		}
		
	}
	
	public function actionDelete()
	{
		
		if (Yii::$app->request->get('id')) {
			$model = Cart::findById(Yii::$app->request->get('id'));
			if($model && $model->delete()){
				return $this->redirect('list');
			}else{
				throw new NotFoundHttpException('Delete Failed!');
			}
		} else {
			throw new NotFoundHttpException('Delete Failed!');
		}
	}
}
