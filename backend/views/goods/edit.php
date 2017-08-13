<?php 
use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\file\FileInput;

$this->title = 'Goods';
?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

<?php 
echo Nav::widget([
 'items' => [
     [
         'label' => 'Show All',
         'url' => ['goods/list'],
         'linkOptions' => ['class'=>'style'],  //设置链接的样式
     ],
     [
         'label' => 'Add To',
		 'url' => ['goods/create'],
		 'linkOptions' => ['class'=>'style'],
     ],
 ],
 'options' => ['class' =>'nav-pills'], // 设置导航的样式
]);

?>
    <div class="row">
        <div class="col-lg-10">
            <?php $form = ActiveForm::begin(['id' => 'edit-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'goods_name')->textInput(['autofocus' => true]) ?>
				
                <?= $form->field($model, 'goods_number')->textInput() ?>
				
                <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($oGoodscategory,'id', 'category_name'), ['prompt' => '--Select Category--']); ?>
				
                <?= $form->field($model, 'os_id')->dropDownList(ArrayHelper::map($oGoodsos,'id', 'os_name'), ['prompt' => '--Select OS--']); ?>
				
                <?= $form->field($model, 'brand_id')->dropDownList(ArrayHelper::map($oGoodsbrand,'id', 'brand_name'), ['prompt' => '--Select Brand--']); ?>
				
				<?= $form->field($model, 'imageFile')->widget(FileInput::classname(), [
					'pluginOptions' => [
						// 预览的文件
						'initialPreview' => empty($model->goods_image)?'': [\yii\helpers\Url::to($model->goods_image)],
						// 是否展示预览图
						'initialPreviewAsData' => true,
						// 是否显示上传按钮，指input上面的上传按钮，非具体图片上的上传按钮
						'showUpload' => false,
						'browseOnZoneClick' => true,
					],
					// 一些事件行为
					'pluginEvents' => [
						"fileclear" => "function() { $('#goods-image').val('');}",
					],
				]);
				?>
				<?= $form->field($model, 'galleryFile[]')->widget(FileInput::classname(), [
					'options' => ['multiple' => true],
					'pluginOptions' => [
						// 需要预览的文件格式
						'previewFileType' => 'image',
						// 预览的文件
						'initialPreview' => isset($p1) ? $p1 : [],
						// 需要展示的图片设置，比如图片的宽度等
						'initialPreviewConfig' => isset($p2) ? $p2 : [],
						// 是否展示预览图
						'initialPreviewAsData' => true,
						// 是否显示移除按钮，指input上面的移除按钮，非具体图片上的移除按钮
						'showRemove' => true,
						// 是否显示上传按钮，指input上面的上传按钮，非具体图片上的上传按钮
						'showUpload' => false,
						// 展示图片区域是否可点击选择多文件
						'browseOnZoneClick' => true,
					],
					// 一些事件行为
					'pluginEvents' => [
						
					],
				]);
				?>
				
				<?= $form->field($model, 'goods_image',['options'=>['style'=>'display:none']])->hiddenInput(['id'=>'goods-image'])?>
				
                <?= $form->field($model, 'goods_price')->textInput() ?>
				
                <?= $form->field($model, 'market_price')->textInput() ?>
				
				
				<?= $form->field($model, 'goods_description')->widget(\yii\redactor\widgets\Redactor::className(), [ 
					'clientOptions' => [ 
						'imageManagerJson' => ['/redactor/upload/image-json'], 
						'imageUpload' => ['/redactor/upload/image'], 
						'fileUpload' => ['/redactor/upload/file'], 
						'lang' => 'en_US', 
						'plugins' => ['clips', 'fontcolor','imagemanager'],
					] 
				]) ?>

                <?= $form->field($model, 'special')->radioList(['1' => 'YES', '0' => 'NO']) ?>

                <?= $form->field($model, 'featured')->radioList(['1' => 'YES', '0' => 'NO']) ?>

                <?= $form->field($model, 'status')->radioList(['0' => 'Disable', '1' => 'Enable']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>