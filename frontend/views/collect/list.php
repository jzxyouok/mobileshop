<?php 

use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = 'Collection';
?>
				<div class="col-lg-9">
					<div class="widget wid-categories">
						<div class="heading"><h4>Collection</h4></div>
						<div class="content">
							<?= ListView::widget([
								'dataProvider' => $dataProvider,
								'itemView' => 'list_view',
								'summary' => false,
							]);?>
							<a href="<?= Url::toRoute(['site/index'])?>" class="btn btn-1">+Add Collect</a>
						</div>
					</div>
				</div>
