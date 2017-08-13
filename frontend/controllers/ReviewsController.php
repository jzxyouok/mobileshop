<?php 
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Order;
use common\models\Ordergoods;
use common\models\Goods;
use common\models\Reviews;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class ReviewsController extends Controller
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

	public function actionList()
	{
		$query = Reviews::find()->where(['customer_id' => Yii::$app->user->id]);
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
		$model = new Reviews();
		if (Yii::$app->request->isPost) {
			//检查订单商品是否存在
			if($oOrdergoods = Ordergoods::find()->where(['id' => Yii::$app->request->get('id'), 'reviews_status' => '0'])->one()){
				//检查发布评价者身份
				if($oOrdergoods->order->customer_id == Yii::$app->user->id){
					$model->customer_id = Yii::$app->user->id;
					$model->goods_id = $oOrdergoods->goods_id;
					if($model->load(Yii::$app->request->post()) && $model->save()){
						//更新商品评价Goods->rating
						$model->goods->rating = Reviews::find()->where(['goods_id' => $model->goods_id])->average('rating');
						$model->goods->save();
						//更新订单商品评价状态Ordergoods->reviews_status
						$oOrdergoods->reviews_status = 1;
						$oOrdergoods->save();
						return $this->redirect('list');
					}
				}
			}
		}
		return $this->render('edit', ['model' => $model]);
	}
}