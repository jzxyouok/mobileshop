<?php 

use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = 'Address';
?>
				<div class="col-lg-9">
					<div class="widget wid-categories">
						<div class="heading"><h4>Address</h4></div>
						<div class="content">
							<?= ListView::widget([
								'dataProvider' => $dataProvider,
								'itemView' => 'list_view',
								'summary' => false,
							]);?>
							<a href="<?= Url::toRoute(['address/add'])?>" class="btn btn-1">+Add Address</a>
						</div>
					</div>
				</div>
