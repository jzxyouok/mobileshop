<?php 
use yii\helpers\Url;
use yii\helpers\Html;
?>
				<div class="col-lg-3 col-md-3 col-xs-12">
					<div class="product">
						<div class="image"><a href="<?= Url::toRoute(['goods/show', 'id' => $model->id])?>"><img src="<?= $model->goods_image?>" /></a></div>
						<div class="buttons">
							<a class="btn cart" href="<?= Url::toRoute(['cart/add', 'goods_id' => $model->id])?>"><span class="glyphicon glyphicon-shopping-cart"></span></a>
							<a class="btn wishlist" href="<?= Url::toRoute(['collect/add', 'id' => $model->id])?>"><span class="glyphicon glyphicon-heart"></span></a>
							<a class="btn compare" href="#"><span class="glyphicon glyphicon-transfer"></span></a>
						</div>
						<div class="caption">
							<div class="name"><h3><a href="product.html"><?= $model->goods_name?></a></h3></div>
							<div class="price">$<?= $model->goods_price?><span>$<?= $model->market_price?></span></div>
							<div class="rating"><?= Html::hiddenInput('rating', $model->rating, ['class' => 'rating', 'data-readonly' => 'data-readonly'])?></div>
						</div>
					</div>
				</div>