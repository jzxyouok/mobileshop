<?php 
use yii\helpers\Url;
use yii\helpers\Html;
?>

			<div class="row">
				<div class="product well">
					<div class="col-md-3">
						<div class="image">
							<img src="<?= $model->goods->goods_image?>" />
						</div>
					</div>
					<div class="col-md-9">
						<div class="caption">
							<div class="name"><h3><a href="<?= Url::toRoute(['goods/show', 'id' => $model->goods->id])?>"><?= $model->goods->goods_name?></a></h3></div>
							<div class="info">	
								<ul>
									<li>Brand: <?= $model->goods->goodsbrand->brand_name?></li>
									<li>ID: <?= $model->goods->goods_number?></li>
									<li>Qty: <?= $model->goods_count?></li>
								</ul>
							</div>
							<div class="price">$<?= $model->goods->goods_price?><span>$<?= $model->goods->market_price?></span></div>
							<hr>
							<?= $model->reviews_status ? '' : '<a href="' . Url::toRoute(['reviews/add', 'id' => $model->id]) . '" class="btn btn-2 pull-right">Add Reviews</a>'?>
						</div>
					</div>
					<div class="clear"></div>
				</div>	
			</div>