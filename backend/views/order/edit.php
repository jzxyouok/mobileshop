<?php 
use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

$this->title = 'Order';
?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

<?php 
echo Nav::widget([
 'items' => [
     [
         'label' => 'Show All',
         'url' => ['order/list'],
         'linkOptions' => ['class'=>'style'],  //设置链接的样式
     ],
     [
         'label' => 'Add To',
		 'url' => ['order/create'],
		 'linkOptions' => ['class'=>'style'],
     ],
 ],
 'options' => ['class' =>'nav-pills'], // 设置导航的样式
]);

?>
    <div class="row">
        <div class="col-lg-10">
            <?php $form = ActiveForm::begin(['id' => 'edit-form']); ?>
				
                <?= $form->field($model, 'order_number')->textInput(['autofocus' => true]) ?>
				
                <?= $form->field($model, 'subtotal')->textInput() ?>
				
                <?= $form->field($model, 'shipping')->textInput() ?>
				
                <?= $form->field($model, 'total')->textInput() ?>
				
                <?= $form->field($model, 'address_id')->dropDownList(ArrayHelper::map($oAddress,'id', 'address'), ['prompt' => '--Select Address--']); ?>
			
                <?= $form->field($model, 'order_status')->dropDownList(['1' => 'Current', '2' => 'Past', '3' => 'Returns'], ['prompt' => '--Select Status--']); ?>

                <?= $form->field($model, 'pay_status')->radioList(['0' => 'Unpaid', '1' => 'Paid']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>