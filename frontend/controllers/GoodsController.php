<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Html;
use common\models\Goods;
use common\models\Goodsgallery;
use common\models\Reviews;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * Goods controller
 */
class GoodsController extends Controller
{
    public function actionList()
	{
		$aWhere = ['status' => '1'];
		if($category_id = Yii::$app->request->get('category_id')){
			$aWhere = array_merge($aWhere, ['category_id' => $category_id]);
		}
		if($keyword = Yii::$app->request->get('keyword')){
			$aWhere = array_merge($aWhere, ['like','goods_name',$keyword]);
		}
		$query = Goods::find()->where($aWhere);
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => Yii::$app->params['pageSize'],
			],
		]);
		
		return $this->render('list', ['dataProvider' => $dataProvider]);
	}
	
	public function actionShow()
	{
		if($id = Yii::$app->request->get('id')){
			$model = Goods::findById($id);
			$oGoodsgallery = Goodsgallery::find()->where(['goods_id' => $id])->all();
			
			$oReviews = new ActiveDataProvider([
				'query' => Reviews::find()->where(['goods_id' => $id]),
				'pagination' => [
					'pageSize' => 20,
				],
			]);
			
			$brand = $model->goodsbrand;
			$oLastest = Goods::find()->where(['status' => 1])->orderBy('created_at,id')->limit(3)->all();
			return $this->render('show', ['model' => $model, 'oGoodsgallery' => $oGoodsgallery, 'oReviews' => $oReviews, 'brand' => $brand, 'oLastest' => $oLastest]);
		}else{
			throw new NotFoundHttpException('Not Found Page!');
		}
		
	}
	
    public function actionSearch()
    {
        $keyword = Html::encode(strip_tags(Yii::$app->request->get('keyword')));
        $query = Goods::find()
            ->andFilterWhere(['or',['like', 'goods_name', $keyword],['like', 'goods_description', $keyword]])
            ->andFilterWhere(['status'=>'1']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder'=>['id'=>SORT_DESC]],
            'pagination' => ['pageSize'=>Yii::$app->params['pageSize']]
        ]);
        $this->view->params['keyword'] = $keyword;
        return $this->render('list', [
            'searchModel' => new Goods(),
            'dataProvider' => $dataProvider
        ]);
    }
}
