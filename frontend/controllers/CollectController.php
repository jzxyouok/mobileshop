<?php 
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Collect;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class CollectController extends Controller
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
		$query = Collect::find()->where(['customer_id' => Yii::$app->user->id]);
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
		$model = new Collect();
		if ($id = Yii::$app->request->get('id')) {
			if(Collect::find()->where(['id' => Yii::$app->request->get('id'), 'customer_id' => Yii::$app->user->id])->one()){
				return $this->redirect('list');
			}
			$model->customer_id = Yii::$app->user->id;
			$model->goods_id = $id;
			if($model->save()){
				return $this->redirect('list');
			}
		}else{
			throw new NotFoundHttpException('Not Found Page!');
		}
	}
	
	
	public function actionDelete()
	{
		
		if (Yii::$app->request->get('id')) {
			$model = Collect::find()->where(['id' => Yii::$app->request->get('id'), 'customer_id' => Yii::$app->user->id])->one();
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