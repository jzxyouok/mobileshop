<?php 
use yii\helpers\Url;
use yii\helpers\Html;
?>

			<div class="row">
				<div class="product well">
					<div class="col-md-12">
						<div class="caption">
							<div class="name"><h3><a href="<?= Url::toRoute(['order/show', 'id' => $model->id])?>">NO. <?= $model->order_number?></a></h3></div>
							<div class="info">	
								<ul>
									<li>Date : <?= $model->created_at?></li>
								</ul>
							</div>
							<div class="price">$<?= $model->total?></div>
							<hr>
							<a href="<?= Url::toRoute(['order/show', 'id' => $model->id])?>" class="btn btn-default pull-right">More</a>
						</div>
					</div>
					<div class="clear"></div>
				</div>	
			</div>