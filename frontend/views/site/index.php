<?php

use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Mobile Shop';

$carouselIndicators = '';
$carouselItems = '';
foreach($oAdBig as $key => $value){
	$carouselIndicators .= '
					<li data-target="#carousel-example-generic" data-slide-to="'.$key.'" '.($key == 0 ? 'class="active"' : '').'></li>
					';
	$carouselItems .= '
					<div class="item'.($key == 0 ? ' active' : '') .'">
						<a href="'.$value->banner_url.'"><img src="'.$value->banner_img.'" alt="First slide"></a>
						<!-- Static Header -->
						<div class="header-text hidden-xs">
							<div class="col-md-12 text-center">
							</div>
						</div><!-- /header-text -->
					</div>';
}

$bannerItems = '';
foreach($oAdMid as $key => $value){
	$bannerItems .= '
						<div class="col-sm-4">
							<a href="'.$value->banner_url.'"><img src="'.$value->banner_img.'" /></a>
						</div>';
}
$sBannerItems = '';
foreach($oAdSmall as $key => $value){
	$sBannerItems .= '
					<div class="col-sm-6">
						<a href="'.$value->banner_url.'"><img src="'.$value->banner_img.'" /></a>
					</div>';
}

$SpecialGoodsItems = '';
foreach($oSpecialGoods as $key => $value){
	$SpecialGoodsItems .= '
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="product">
								<div class="image"><a href="'.Url::toRoute(['goods/show', 'id' => $value->id]).'"><img src="'.$value->goods_image.'" /></a></div>
								<div class="buttons">
									<a class="btn cart" href="'.Url::toRoute(['cart/add', 'goods_id' => $value->id]).'"><span class="glyphicon glyphicon-shopping-cart"></span></a>
									<a class="btn wishlist" href="'.Url::toRoute(['collect/add', 'id' => $value->id]).'"><span class="glyphicon glyphicon-heart"></span></a>
									<a class="btn compare" href="#"><span class="glyphicon glyphicon-transfer"></span></a>
								</div>
								<div class="caption">
									<div class="name"><h3><a href="'.Url::toRoute(['goods/show', 'id' => $value->id]).'">'.$value->goods_name.'</a></h3></div>
									<div class="price">$'.$value->goods_price.'<span>$'.$value->market_price.'</span></div>
									<div class="rating">' . Html::hiddenInput('rating', $value->rating, ['class' => 'rating', 'data-readonly' => 'data-readonly']) . '</div>
								</div>
							</div>
						</div>';
}

$FeaturedGoodsItems = '';
foreach($oFeaturedGoods as $key => $value){
	$FeaturedGoodsItems .= '
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="product">
								<div class="image"><a href="'.Url::toRoute(['goods/show', 'id' => $value->id]).'"><img src="'.$value->goods_image.'" /></a></div>
								<div class="buttons">
									<a class="btn cart" href="'.Url::toRoute(['cart/add', 'goods_id' => $value->id]).'"><span class="glyphicon glyphicon-shopping-cart"></span></a>
									<a class="btn wishlist" href="'.Url::toRoute(['collect/add', 'id' => $value->id]).'"><span class="glyphicon glyphicon-heart"></span></a>
									<a class="btn compare" href="#"><span class="glyphicon glyphicon-transfer"></span></a>
								</div>
								<div class="caption">
									<div class="name"><h3><a href="'.Url::toRoute(['goods/show', 'id' => $value->id]).'">'.$value->goods_name.'</a></h3></div>
									<div class="price">$'.$value->goods_price.'<span>$'.$value->market_price.'</span></div>
									<div class="rating">' . Html::hiddenInput('rating', $value->rating, ['class' => 'rating', 'data-readonly' => 'data-readonly']) . '</div>
								</div>
							</div>
						</div>';
}
?>
	<div id="page-content" class="home-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<!-- Carousel -->
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators hidden-xs">
							<?= $carouselIndicators ?>
						</ol>
						<!-- Wrapper for slides -->
						<div class="carousel-inner">
							<?= $carouselItems ?>
						</div>
						<!-- Controls -->
						<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left"></span>
						</a>
						<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right"></span>
						</a>
					</div><!-- /carousel -->
				</div>
			</div>
			<div class="row">
				<div class="banner">
							<?= $bannerItems ?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="heading"><h2>SPECIAL PRODUCTS</h2></div>
					<div class="products">
						<?= $SpecialGoodsItems?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="banner">
					<?= $sBannerItems ?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="heading"><h2>FEATURED PRODUCTS</h2></div>
					<div class="products">
						<?= $FeaturedGoodsItems?>
					</div>
				</div>
			</div>
		</div>
	</div>