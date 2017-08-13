<?php 

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Reviews';
?>
				<div class="col-lg-9">
					<div class="widget wid-categories">
						<div class="heading"><h4>Reviews</h4></div>
						<div class="content">
            <?php $form = ActiveForm::begin(['id' => 'reviews-form']); ?>
			
				<?= $form->field($model, 'rating')->hiddenInput(['class' => 'rating'])?>
				
				
				
                <?= $form->field($model, 'content')->textarea(['autofocus' => true]) ?>
				
				<?= Html::submitButton('Submit', ['class' => 'btn btn-1', 'name' => 'submit-button']) ?>
				
			<?php ActiveForm::end(); ?>
						</div>
					</div>
				</div>