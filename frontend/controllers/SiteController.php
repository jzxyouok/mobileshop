<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\form\resetPasswordForm;
use common\models\Customer;
use common\models\Goods;
use common\models\Banner;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'login'],
                'rules' => [
                    [
                        'actions' => ['signup', 'login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
		$oBanner = Banner::findGroup();
		$oAdBig = isset($oBanner[1]) ? $oBanner[1] : [];
		$oAdMid = isset($oBanner[2]) ? $oBanner[2] : [];
		$oAdSmall = isset($oBanner[3]) ? $oBanner[3] : [];
		$oSpecialGoods = Goods::find()->where(['special' => '1', 'status' => '1'])->limit(4)->all();
		$oFeaturedGoods = Goods::find()->where(['featured' => '1', 'status' => '1'])->limit(4)->all();
        return $this->render('index', ['oAdBig' => $oAdBig, 'oAdMid' => $oAdMid, 'oAdSmall' => $oAdSmall, 'oSpecialGoods' => $oSpecialGoods, 'oFeaturedGoods' => $oFeaturedGoods]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['account/index']);
        }

        $model = new Customer(['scenario' => 'login']);
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['account/index']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
		if(Yii::$app->request->post('mailVerifyCode') == Yii::$app->session->get('mailVerifyCode')){
			$model = new Customer(['scenario' => 'signup']);
			if ($model->load(Yii::$app->request->post())) {
				if ($customer = $model->signup()) {
					if (Yii::$app->getUser()->login($customer)) {
						return $this->goHome();
					}
				}
			}
		}
        $model = new Customer(['scenario' => 'login']);
        return $this->redirect('login', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword()
    {
        try {
            $model = new ResetPasswordForm();
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
		if(Yii::$app->request->post('mailVerifyCode') == Yii::$app->session->get('mailVerifyCode')){
			if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
				Yii::$app->session->setFlash('success', 'New password saved.');
	
				return $this->render('resetPassword-success');
			}
		}

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
	
	public function actionSendMail()
	{
		if(Yii::$app->request->isAjax){
			$customerEmail = Yii::$app->request->post('email');
			$subject = '验证邮件';
			$code = rand(100000,999999);
			Yii::$app->session->set('mailVerifyCode', $code);
			$from = [Yii::$app->params['adminEmail'] => Yii::$app->params['webName']];
			$content = "<p>You Verify Code Is <b>$code</b> </p>";
			$mail = \Yii::$app->mailer->compose()->setFrom($from)->setTo($customerEmail)->setSubject($subject)->setHtmlBody($content)->send();
			if($mail){
				echo 'success';
			}
			else{
				echo 'fail';
			}
		}
	}
	
}
