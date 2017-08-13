<?php
namespace backend\controllers;

use Yii;
use common\models\Customer;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;


/**
 * Site controller
 */
class CustomerController extends BaseController
{
    public function actionList()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Customer::find(),
			'pagination' => [
				'pageSize' => 20,
			],
		]);
		return $this->render('list',['dataProvider' => $dataProvider]);
	}
	
	public function actionCreate()
	{
		$model = new Customer();
		if (Yii::$app->request->isPost) {
			if($model->load(Yii::$app->request->post()) && $model->save()){
				return $this->redirect('list');
			}
		}
		return $this->render('edit', ['model' => $model]);
	}
	
	public function actionUpdate()
	{
		if($id = Yii::$app->request->get('id')){
			$model = Customer::findById($id);
			if(Yii::$app->request->isPost){
				if($model->load(Yii::$app->request->post()) && $model->save()){
					return $this->redirect('list');
				}
			}
			return $this->render('edit', ['model' => $model]);
		}else{
			throw new NotFoundHttpException('Not Found Page!');
		}
		
	}
	
	public function actionDelete()
	{
		
		if (Yii::$app->request->get('id')) {
			$model = Customer::findById(Yii::$app->request->get('id'));
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
