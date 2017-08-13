<?php 

use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = 'Order';
?>
				<div class="col-lg-9">
					<div class="widget wid-categories">
						<div class="heading"><h4>Order</h4></div>
						<div class="content">
							<?= ListView::widget([
								'dataProvider' => $dataProvider,
								'itemView' => 'list_view',
								'summary' => false,
							]);?>
						</div>
					</div>
				</div>
