<?php 
use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Customer';
?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

<?php 
echo Nav::widget([
 'items' => [
     [
         'label' => 'Show All',
         'url' => ['customer/list'],
         'linkOptions' => ['class'=>'style'],  //设置链接的样式
     ],
     [
         'label' => 'Add To',
		 'url' => ['customer/create'],
		 'linkOptions' => ['class'=>'style'],
     ],
 ],
 'options' => ['class' =>'nav-pills'], // 设置导航的样式
]);

?>
    <div class="row">
        <div class="col-lg-10">
            <?php $form = ActiveForm::begin(['id' => 'edit-form']); ?>

                <?= $form->field($model, 'first_name')->textInput(['autofocus' => true]) ?>
				
                <?= $form->field($model, 'last_name')->textInput() ?>
				
                <?= $form->field($model, 'email')->textInput() ?>
				
                <?= $form->field($model, 'mobile')->textInput() ?>
				
                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'gender')->radioList(['1' => 'Male', '2' => 'Female']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>