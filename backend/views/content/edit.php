<?php 
use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Content';
?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

<?php 
echo Nav::widget([
 'items' => [
     [
         'label' => 'Show All',
         'url' => ['content/list'],
         'linkOptions' => ['class'=>'style'],  //设置链接的样式
     ],
     [
         'label' => 'Add To',
		 'url' => ['content/create'],
		 'linkOptions' => ['class'=>'style'],
     ],
 ],
 'options' => ['class' =>'nav-pills'], // 设置导航的样式
]);

?>
    <div class="row">
        <div class="col-lg-10">
            <?php $form = ActiveForm::begin(['id' => 'edit-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
				
				<?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className(), [ 
					'clientOptions' => [ 
						'imageManagerJson' => ['/redactor/upload/image-json'], 
						'imageUpload' => ['/redactor/upload/image'], 
						'fileUpload' => ['/redactor/upload/file'], 
						'lang' => 'en_US', 
						'plugins' => ['clips', 'fontcolor','imagemanager'],
					] 
				]) ?>

                <?= $form->field($model, 'status')->radioList(['0' => 'Disable', '1' => 'Enable']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>