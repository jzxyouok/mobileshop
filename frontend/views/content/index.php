<?php 

use yii\helpers\Url;
/**/
?>
	<div id="page-content" class="single-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul class="breadcrumb">
						<li><a href="<?= Url::toRoute(['/site/index'])?>">Home</a></li>
						<li><a href="<?= Url::toRoute(['/content/index', 'id' => $model->id])?>"><?= $model->name?></a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<?= $model->content?>
				</div>
			</div>
		</div>
	</div>	