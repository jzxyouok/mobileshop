<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
	<div id="page-content" class="single-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul class="breadcrumb">
						<li><a href="<?= Url::toRoute(['site/index'])?>">Home</a></li>
						<li><a href="<?= Url::toRoute(['site/login'])?>">Account</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="heading"><h2>Login</h2></div>
						<?php $form = ActiveForm::begin(['id' => 'ff1']); ?>
						
						<?= $form->field($model, 'username')->label(false)->textInput(['placeholder' => 'Username :', 'id' => 'username', 'class' => 'form-control']) ?>
						
						<?= $form->field($model, 'password')->label(false)->passwordInput(['placeholder' => 'Password :', 'id' => 'password', 'class' => 'form-control']) ?>
						
						
						<?= $form->field($model, 'rememberMe')->checkbox() ?>
						
						<?= Html::submitButton('Login', ['class' => 'btn btn-1', 'name' => 'login-button', 'id' => 'login']) ?>
						<a href="<?= Url::toRoute(['site/reset-password'])?>">Forgot Your Password ?</a>
					<?php ActiveForm::end(); ?>
				</div>
				<div class="col-md-6">
					<div class="heading"><h2>New User ? Create An Account.</h2></div>
					<?php $form = ActiveForm::begin(['id' => 'ff2','action' => Url::toRoute(['site/signup'])]); ?>
					
						<?= $form->field($model, 'first_name')->label(false)->textInput(['placeholder' => 'First Name :', 'id' => 'firstname', 'class' => 'form-control']) ?>
					
						<?= $form->field($model, 'last_name')->label(false)->textInput(['placeholder' => 'Last Name :', 'id' => 'lastname', 'class' => 'form-control']) ?>
						
						<?= $form->field($model, 'email')->label(false)->textInput(['placeholder' => 'Email Address :', 'id' => 'email', 'class' => 'form-control']) ?>
						<div class="row">
							<div class="col-lg-5 col-md-5 col-xs-12">
						<?= $form->field($model, 'mailVerifyCode')->label(false)->textInput(['placeholder' => 'Email Verify Code :', 'class' => 'form-control']) ?>								
							</div>
							<div class="col-lg-7 col-md-7 col-xs-12">
						<?= Html::a('Get Email Verify Code', 'javascript:;', ['class' => 'btn btn-primary btn-lg', 'id' => 'get-code'])?>								
							</div>
						</div>
						
						<?= $form->field($model, 'mobile')->label(false)->textInput(['placeholder' => 'Mobile :', 'id' => 'phone', 'class' => 'form-control']) ?>
						
						<?= $form->field($model, 'gender')->radioList(['1' => 'Male', '2' => 'Female']) ?>
						
						<?= $form->field($model, 'password')->label(false)->passwordInput(['placeholder' => 'Password :', 'id' => 'password', 'class' => 'form-control']) ?>
						
						<?= $form->field($model, 'repassword')->label(false)->passwordInput(['placeholder' => 'Retype Password :', 'id' => 'repassword', 'class' => 'form-control']) ?>
						<?= $form->field($model, 'agree')->label(' I agree to your website.')->checkbox(['id' => 'agree',]) ?>
						
						<button type="submit" class="btn btn-1">Create</button>
					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>
<?= $this->registerJs("
	$(function(){
		$('#get-code').click(function(){
			var email = $('#email').val();
			var url = '" . Url::toRoute(['/site/send-mail']) . "';
			if(email){
				sendVerifyCode(email, url);
			}else{
				$('#email').attr('autofocus', true);
			}
		});
	});
");?>
