<?php 
use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Cart';
?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

<?php 
echo Nav::widget([
 'items' => [
     [
         'label' => 'Show All',
         'url' => ['cart/list'],
         'linkOptions' => ['class'=>'style'],  //设置链接的样式
     ],
     [
         'label' => 'Add To',
		 'url' => ['cart/create'],
		 'linkOptions' => ['class'=>'style'],
     ],
 ],
 'options' => ['class' =>'nav-pills'], // 设置导航的样式
]);

?>
    <div class="row">
        <div class="col-lg-10">
            <?php $form = ActiveForm::begin(['id' => 'edit-form']); ?>

                <?= $form->field($model, 'customer_id')->dropDownList(ArrayHelper::map($oCustomer,'id', 'email'), ['prompt' => '--Select Customer--']); ?>

                <?= $form->field($model, 'goods_id')->dropDownList(ArrayHelper::map($oGoods,'id', 'goods_name'), ['prompt' => '--Select Goods--']); ?>
				
				<?= $form->field($model, 'goods_count')->textInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>