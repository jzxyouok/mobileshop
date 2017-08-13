<?php 
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="well">
	<div class="row">
		<div class="col-md-4">
			<ul>
				<li>
					Date : <?= $model->created_at?>
				</li>
				<li>
					<?= $model->customer->gender == 1 ? 'Mr. ' : 'Miss '?><?= $model->customer->last_name?>
				</li>
			</ul>
		</div>
		<div class="col-md-8">
			<ul>
				<li>
					Rating : <?= Html::hiddenInput('rating', $model->rating, ['class' => 'rating', 'data-readonly' => 'data-readonly'])?>
				</li>
				<li>
					Message : <?= $model->content?>
				</li>
			</ul>
		</div>
	</div>
</div>