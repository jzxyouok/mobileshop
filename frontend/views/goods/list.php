<?php

use yii\helpers\Url;
use yii\widgets\ListView;
/* @var $this yii\web\View */

$this->title = 'Mobile Shop';
?>
	<div id="page-content" class="single-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul class="breadcrumb">
						<li><a href="<?= Url::toRoute(['/site/index'])?>">Home</a></li>
						<li><a href="<?= Url::toRoute(['/goods/list'])?>">Category</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div id="main-content" class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							<div class="products">
			<?= ListView::widget([
				'dataProvider' => $dataProvider,
				'itemView' => 'list_view',
				'summary' => false,
			]);?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	