<?php 
use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;

$this->title = 'Banner';
?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

<?php 
echo Nav::widget([
 'items' => [
     [
         'label' => 'Show All',
         'url' => ['banner/list'],
         'linkOptions' => ['class'=>'style'],  //设置链接的样式
     ],
     [
         'label' => 'Add To',
		 'url' => ['banner/create'],
		 'linkOptions' => ['class'=>'style'],
     ],
 ],
 'options' => ['class' =>'nav-pills'], // 设置导航的样式
]);

?>
    <div class="row">
        <div class="col-lg-10">
            <?php $form = ActiveForm::begin(['id' => 'edit-form']); ?>

                <?= $form->field($model, 'banner_type')->dropDownList(['1' => 'Big', '2' => 'Mid', '3' => 'Small'], ['prompt' => '--Select Type--']); ?>
				
                <?= $form->field($model, 'banner_title')->textInput() ?>
				
				<?= $form->field($model, 'imageFile')->widget(FileInput::classname(), [
					'pluginOptions' => [
						// 预览的文件
						'initialPreview' => empty($model->banner_img)?'': [\yii\helpers\Url::to($model->banner_img)],
						// 是否展示预览图
						'initialPreviewAsData' => true,
						// 是否显示上传按钮，指input上面的上传按钮，非具体图片上的上传按钮
						'showUpload' => false,
						'browseOnZoneClick' => true,
					],
					// 一些事件行为
					'pluginEvents' => [
						"fileclear" => "function() { $('#banner-image').val('');}",
					],
				]);
				?>
				
				<?= $form->field($model, 'banner_img',['options'=>['style'=>'display:none']])->hiddenInput(['id'=>'banner-image'])?>
				
                <?= $form->field($model, 'banner_url')->textInput() ?>

                <?= $form->field($model, 'status')->radioList(['0' => 'Disable', '1' => 'Enable']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>