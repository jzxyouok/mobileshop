<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Json;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\assets\AppAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

	<nav id="top">
		<div class="container">
			<div class="row">
				<div class="col-xs-6">
				<!--<select class="language">
						<option value="English" selected>English</option>
						<option value="France">France</option>
						<option value="Germany">Germany</option>
					</select>
					<select class="currency">
						<option value="USD" selected>USD</option>
						<option value="EUR">EUR</option>
						<option value="DDD">DDD</option>
					</select>-->
				</div>
				<div class="col-xs-6">
					<ul class="top-link">
						<?= Yii::$app->user->isGuest ? '<li><a href="'.Url::toRoute(['/account/index']).'"><span class="glyphicon glyphicon-user"></span> My Account</a></li>' : '<li><a href="'.Url::toRoute(['/account/index']).'"><span class="glyphicon glyphicon-user"></span> Welcome ! '.Yii::$app->user->identity->first_name . ' ' . Yii::$app->user->identity->last_name .'</a><span> | </span><a href="'.Url::toRoute(['/site/logout']).'">Logout</a></li>' ?>
						<li><a href="<?= Url::toRoute(['/guestbook/index'])?>"><span class="glyphicon glyphicon-envelope"></span> Contact</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<!--Header-->
	<header class="container">
		<div class="row">
			<div class="col-md-4">
				<div id="logo"><a href="<?= Url::toRoute(['site/index']) ?>"><img src="<?php echo Yii::getAlias('@statics');  ?>/images/logo.png" /></a></div>
			</div>
			<div class="col-md-4">
				<?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['goods/search'], 'options' => ['class' => 'form-search']]); ?> 
					<input type="text" class="input-medium search-query" name="keyword" value="<?= isset($this->params['keyword']) ? $this->params['keyword'] : '' ?>">  
					<button type="submit" class="btn"><span class="glyphicon glyphicon-search"></span></button>  
				<?php ActiveForm::end(); ?>
			</div>
			<div class="col-md-4">
				<div id="cart"><a class="btn btn-1" href="<?= Url::toRoute(['/cart/list'])?>"><span class="glyphicon glyphicon-shopping-cart"></span>CART : 0 ITEM</a></div>
			</div>
		</div>
	</header>
	<!--Navigation-->
    <nav id="menu" class="navbar">
		<div class="container">
			<div class="navbar-header"><span id="heading" class="visible-xs">Categories</span>
			  <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<?= Nav::widget(Json::decode(Yii::$app->params['nav'], true))?>
			</div>
		</div>
	</nav>

    <?= $content ?>

	<footer>
		<div class="container">
			<div class="wrap-footer">
				<div class="row">
					<div class="col-md-3 col-footer footer-1">
						<img src="<?php echo Yii::getAlias('@statics');  ?>/images/logofooter.png" />
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
					</div>
					<div class="col-md-3 col-footer footer-2">
						<div class="heading"><h4>Customer Service</h4></div>
						<ul>
							<li><a href="<?= Url::toRoute(['/content/index', 'id' => '1'])?>">About Us</a></li>
							<li><a href="<?= Url::toRoute(['/content/index', 'id' => '2'])?>">Delivery Information</a></li>
							<li><a href="<?= Url::toRoute(['/content/index', 'id' => '3'])?>">Privacy Policy</a></li>
							<li><a href="<?= Url::toRoute(['/content/index', 'id' => '4'])?>">Terms & Conditions</a></li>
							<li><a href="<?= Url::toRoute(['/guestbook/index'])?>">Contact Us</a></li>
						</ul>
					</div>
					<div class="col-md-3 col-footer footer-3">
						<div class="heading"><h4>My Account</h4></div>
						<ul>
							<li><a href="<?= Url::toRoute(['/account/index'])?>">My Account</a></li>
							<li><a href="#">Brands</a></li>
							<li><a href="#">Gift Vouchers</a></li>
							<li><a href="#">Specials</a></li>
							<li><a href="#">Site Map</a></li>
						</ul>
					</div>
					<div class="col-md-3 col-footer footer-4">
						<div class="heading"><h4>Contact Us</h4></div>
						<ul>
							<li><span class="glyphicon glyphicon-home"></span>California, United States 3000009</li>
							<li><span class="glyphicon glyphicon-earphone"></span>+91 8866888111</li>
							<li><span class="glyphicon glyphicon-envelope"></span>infor@yoursite.com</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						Copyright &copy; 2017.Company name All rights reserved.
					</div>
					<div class="col-md-6">
						<div class="pull-right">
							<ul>
								<li><img src="<?php echo Yii::getAlias('@statics');  ?>/images/visa-curved-32px.png" /></li>
								<li><img src="<?php echo Yii::getAlias('@statics');  ?>/images/paypal-curved-32px.png" /></li>
								<li><img src="<?php echo Yii::getAlias('@statics');  ?>/images/discover-curved-32px.png" /></li>
								<li><img src="<?php echo Yii::getAlias('@statics');  ?>/images/maestro-curved-32px.png" /></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
