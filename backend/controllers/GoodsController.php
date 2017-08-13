<?php
namespace backend\controllers;

use Yii;
use common\models\Goods;
use common\models\Goodscategory;
use common\models\Goodsos;
use common\models\Goodsbrand;
use common\models\Goodsgallery;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;


/**
 * Site controller
 */
class GoodsController extends BaseController
{
    public function actionList()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Goods::find(),
			'pagination' => [
				'pageSize' => 20,
			],
		]);
		return $this->render('list',['dataProvider' => $dataProvider]);
	}
	
	public function actionCreate()
	{
		$model = new Goods();
		if (Yii::$app->request->isPost) {
			if($model->load(Yii::$app->request->post()) && $model->save()){
				if($aGalleryFile = $model->uploadGalleryFile()){
					$aGalleryData = [];
					foreach($aGalleryFile as $key => $value){
						$aGalleryData[$key] = [$model->id, $value];
					}
					if($aGalleryData){
						Goodsgallery::batchInsert(['goods_id','img_url'], $aGalleryData);
					}
				}
				
				return $this->redirect('list');
			}
		}
		$oGoodscategory = Goodscategory::findAll(['status' => '1']);
		$oGoodsos = Goodsos::findAll(['status' => '1']);
		$oGoodsbrand = Goodsbrand::findAll(['status' => '1']);
		return $this->render('edit', ['model' => $model, 'oGoodsbrand' => $oGoodsbrand, 'oGoodscategory' => $oGoodscategory, 'oGoodsos' => $oGoodsos]);
	}
	
	public function actionUpdate()
	{
		if($id = Yii::$app->request->get('id')){
			$model = Goods::findById($id);
			if(Yii::$app->request->isPost){
				if($model->load(Yii::$app->request->post()) && $model->save()){
					if($aGalleryFile = $model->uploadGalleryFile()){
						$aGalleryData = [];
						foreach($aGalleryFile as $key => $value){
							$aGalleryData[$key] = [$model->id, $value];
						}
						if($aGalleryData){
							Goodsgallery::batchInsert(['goods_id','img_url'], $aGalleryData);
						}
					}
					return $this->redirect('list');
				}
			}
			$oGoodscategory = Goodscategory::findAll(['status' => '1']);
			$oGoodsos = Goodsos::findAll(['status' => '1']);
			$oGoodsbrand = Goodsbrand::findAll(['status' => '1']);
			$oGoodsgallery = Goodsgallery::find()->where(['goods_id' => $model->id])->asArray()->all();
			
			// @param $p1 Array 需要预览的商品图，是商品图的一个集合
			// @param $p2 Array 对应商品图的操作属性，我们这里包括商品图删除的地址和商品图的id
			$p1 = $p2 = [];
			if ($oGoodsgallery) {
				foreach ($oGoodsgallery as $k => $v) {
					$p1[$k] = $v['img_url'];
					$p2[$k] = [
						// 要删除商品图的地址
						'url' => Url::to(['/goodsgallery/delete', 'id' => $v['id']]),
						// 商品图对应的商品图id
						'key' => $v['id'],
					];
				}
			}
			return $this->render('edit', ['model' => $model, 'oGoodsbrand' => $oGoodsbrand, 'oGoodscategory' => $oGoodscategory, 'oGoodsos' => $oGoodsos, 'p1' => $p1, 'p2' => $p2,]);
		}else{
			throw new NotFoundHttpException('Not Found Page!');
		}
		
	}
	
	public function actionDelete()
	{
		
		if (Yii::$app->request->get('id')) {
			$model = Goods::findById(Yii::$app->request->get('id'));
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
