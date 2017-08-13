<?php 

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Address';
?>
				<div class="col-lg-9">
					<div class="widget wid-categories">
						<div class="heading"><h4>Address</h4></div>
						<div class="content">
            <?php $form = ActiveForm::begin(['id' => 'address-form']); ?>
			
                <?= $form->field($model, 'receiver')->textInput(['autofocus' => true]) ?>
			
                <?= $form->field($model, 'address')->textInput() ?>
			
                <?= $form->field($model, 'mobile')->textInput() ?>
			
                <?= $form->field($model, 'email')->textInput() ?>
				
				<?= $form->field($model, 'isdefault')->radioList(['1' => 'Yes', '0' => 'No'], ['value' => '1']) ?>
				
				<?= Html::submitButton('Submit', ['class' => 'btn btn-1', 'name' => 'submit-button']) ?>
				
			<?php ActiveForm::end(); ?>
						</div>
					</div>
				</div>
