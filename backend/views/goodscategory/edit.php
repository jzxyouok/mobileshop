<?php 
use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Goods Category';
?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

<?php 
echo Nav::widget([
 'items' => [
     [
         'label' => 'Show All',
         'url' => ['goodscategory/list'],
         'linkOptions' => ['class'=>'style'],  //设置链接的样式
     ],
     [
         'label' => 'Add To',
		 'url' => ['goodscategory/create'],
		 'linkOptions' => ['class'=>'style'],
     ],
 ],
 'options' => ['class' =>'nav-pills'], // 设置导航的样式
]);

?>
    <div class="row">
        <div class="col-lg-10">
            <?php $form = ActiveForm::begin(['id' => 'edit-form']); ?>

                <?= $form->field($model, 'category_name')->textInput(['autofocus' => true]) ?>
				
                <?= $form->field($model, 'os_group')->checkBoxList(ArrayHelper::map($oGoodsos,'id', 'os_name')) ?>
				
                <?= $form->field($model, 'brand_group')->checkBoxList(ArrayHelper::map($oGoodsbrand,'id', 'brand_name')) ?>

                <?= $form->field($model, 'status')->radioList(['0' => 'Disable', '1' => 'Enable']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>