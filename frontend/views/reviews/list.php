<?php 

use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = 'Reviews';
?>
				<div class="col-lg-9">
					<div class="widget wid-categories">
						<div class="heading"><h4>Reviews</h4></div>
						<div class="content">
							<?= ListView::widget([
								'dataProvider' => $dataProvider,
								'itemView' => 'list_view',
								'summary' => false,
							]);?>
						</div>
					</div>
				</div>
