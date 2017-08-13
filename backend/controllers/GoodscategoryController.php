<?php
namespace backend\controllers;

use Yii;
use common\models\Goodscategory;
use common\models\Goodsbrand;
use common\models\Goodsos;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;


/**
 * Site controller
 */
class GoodscategoryController extends BaseController
{
    public function actionList()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Goodscategory::find(),
			'pagination' => [
				'pageSize' => 20,
			],
		]);
		return $this->render('list',['dataProvider' => $dataProvider]);
	}
	
	public function actionCreate()
	{
		$model = new Goodscategory();
		if (Yii::$app->request->isPost) {
			if($model->load(Yii::$app->request->post()) && $model->save()){
				return $this->redirect('list');
			}
		}
		$oGoodsos = Goodsos::findAll(['status' => '1']);
		$oGoodsbrand = Goodsbrand::findAll(['status' => '1']);
		return $this->render('edit', ['model' => $model, 'oGoodsbrand' => $oGoodsbrand, 'oGoodsos' => $oGoodsos]);
	}
	
	public function actionUpdate()
	{
		if($id = Yii::$app->request->get('id')){
			$model = Goodscategory::findById($id);
			if(Yii::$app->request->isPost){
				if($model->load(Yii::$app->request->post()) && $model->save()){
					return $this->redirect('list');
				}
			}
			$oGoodsos = Goodsos::findAll(['status' => '1']);
			$oGoodsbrand = Goodsbrand::findAll(['status' => '1']);
			return $this->render('edit', ['model' => $model, 'oGoodsbrand' => $oGoodsbrand, 'oGoodsos' => $oGoodsos]);
		}else{
			throw new NotFoundHttpException('Not Found Page!');
		}
		
	}
	
	public function actionDelete()
	{
		
		if (Yii::$app->request->get('id')) {
			$model = Goodscategory::findById(Yii::$app->request->get('id'));
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
