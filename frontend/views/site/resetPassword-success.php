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
					<div class="heading"><h2>Your Password have been Reset ! </h2></div>
					<a href="<?= Url::toRoute(['site/login'])?>" class="btn btn-1">Go To Login Page</a>
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
