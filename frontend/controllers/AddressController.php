<?php 
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Address;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class AddressController extends Controller
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
		$query = Address::find()->where(['customer_id' => Yii::$app->user->id]);
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
		$model = new Address();
		if (Yii::$app->request->isPost) {
			$model->customer_id = Yii::$app->user->id;
			if($model->load(Yii::$app->request->post()) && $model->save()){
				return $this->redirect('list');
			}
		}
		return $this->render('edit', ['model' => $model]);
	}
	
	public function actionUpdate()
	{
		if($id = Yii::$app->request->get('id')){
			$model = Address::findById($id);
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
			$model = Address::find()->where(['id' => Yii::$app->request->get('id'), 'customer_id' => Yii::$app->user->id])->one();
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