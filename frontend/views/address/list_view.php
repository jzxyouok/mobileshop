<?php 
use yii\helpers\Url;
use yii\helpers\Html;
?>

			<div class="row">
				<div class="product well">
					<div class="col-md-12">
						<div class="caption">
							<div class="info">	
								<ul>
									<li>Receiver : <?= $model->receiver?></li>
									<li>Address : <?= $model->address?></li>
									<li>Phone : <?= $model->mobile?></li>
									<li>Email : <?= $model->email?></li>
									<li>Is Defalut : <?= $model->isdefault ? 'Yes' : 'No'?></li>
								</ul>
							</div>
							<a href="<?= Url::toRoute(['/address/update', 'id' => $model->id])?>" class="btn btn-default pull-right">EDIT</a>
							<a href="<?= Url::toRoute(['/address/delete', 'id' => $model->id])?>" class="btn btn-default pull-right">REMOVE</a>
						</div>
					</div>
					<div class="clear"></div>
				</div>	
			</div>