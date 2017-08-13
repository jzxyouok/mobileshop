<?php 
use yii\helpers\Url;
use yii\helpers\Html;
?>

			<div class="row">
				<div class="product well">
					<div class="col-md-2">
						<div class="image">
							<img src="<?= $model->goods->goods_image?>" />
						</div>
					</div>
					<div class="col-md-10">
						<div class="caption">
							<div class="name"><h3><a href="<?= Url::toRoute(['goods/show', 'id' => $model->goods->id])?>"><?= $model->goods->goods_name?></a></h3></div>
							<div class="price">$<?= $model->goods->goods_price?><span>$<?= $model->goods->market_price?></span></div>
							<hr>
							<div class="row">	
								<div class="col-md-3">Rating : </div><div class="col-md-9"><?= Html::hiddenInput('rating', $model->rating, ['class' => 'rating', 'data-readonly' => 'data-readonly'])?></div>
							</div>
							<div class="row">
								<div class="col-md-3">Content : </div><div class="col-md-9"><?= $model->content?></div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>	
			</div>