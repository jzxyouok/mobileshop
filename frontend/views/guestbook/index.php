<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
/**/
?>
	<div id="page-content" class="single-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul class="breadcrumb">
						<li><a href="index.html">Home</a></li>
						<li><a href="<?= Url::toRoute(['guestbook/index'])?>">Contact Us</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="heading"><h1>CONTACT US</h1></div>
				</div>
				<div class="col-md-6" style="margin-bottom: 30px;">
					<?php $form = ActiveForm::begin(['id' => 'ff'])]); ?>
					
						<?= $form->field($model, 'name')->label(false)->textInput(['placeholder' => 'Your Name *', 'id' => 'name', 'class' => 'form-control', 'required data-validation-required-message' => 'Please enter your name.']) ?>
						
						<?= $form->field($model, 'email')->label(false)->textInput(['placeholder' => 'Your Email *', 'id' => 'email', 'class' => 'form-control', 'required data-validation-required-message' => 'Please enter your email address.']) ?>
						
						<?= $form->field($model, 'mobile')->label(false)->textInput(['placeholder' => 'Your Phone *', 'id' => 'phone', 'class' => 'form-control', 'required data-validation-required-message' => 'Please enter your phone number.']) ?>
						
						<?= $form->field($model, 'message')->label(false)->textarea(['placeholder' => 'Your Message *', 'id' => 'message', 'class' => 'form-control', 'required data-validation-required-message' => 'Please enter your a message.']) ?>
						
						<?= Html::submitButton('Send Message', ['class' => 'btn btn-1']) ?>
						
					<?php ActiveForm::end(); ?>
				</div>
				<div class="col-md-6">
					<p><span class="glyphicon glyphicon-home"></span> California, United States 3000009</p>
					<p><span class="glyphicon glyphicon-earphone"></span> +6221 888 888 90 , +6221 888 88891</p>
					<p><span class="glyphicon glyphicon-envelope"></span> info@yourdomain.com</p>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3164.289259162295!2d-120.7989351!3d37.5246781!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8091042b3386acd7%3A0x3b4a4cedc60363dd!2sMain+St%2C+Denair%2C+CA+95316%2C+Hoa+K%E1%BB%B3!5e0!3m2!1svi!2s!4v1434016649434" width="95%" height="230" frameborder="0" style="border:0"></iframe>
				</div>
			</div>
		</div>
	</div>