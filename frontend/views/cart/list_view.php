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
								</ul>
							</div>
							<div class="price">$<?= $model->goods->goods_price?><span>$<?= $model->goods->market_price?></span></div>
							<label>Qty: </label> <?= Html::beginForm(['cart/update', 'id' => $model->id], 'post').Html::textInput('quantity', $model->goods_count, ['class' => 'form-inline quantity']).Html::submitButton('Update', ['class' => 'btn btn-2']).Html::endForm()?>
							<hr>
							<a href="<?= Url::toRoute(['/cart/delete', 'id' => $model->id])?>" class="btn btn-default pull-right">REMOVE</a>
						</div>
					</div>
					<div class="clear"></div>
				</div>	
			</div>