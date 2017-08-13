<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\grid\GridView;
use yii\bootstrap\Nav;

$this->title = 'Content';
?>
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
<?php 
echo GridView::widget([
    'dataProvider' => $dataProvider,
	'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
		'name',
		[
			'class' => 'yii\grid\DataColumn',
			'label' => 'Status',
			'value' => function($data){
				if($data->status){
					return 'Enable';
				}else{
					return 'Disable';
				}
			} ,
		],
		[
            'class' => 'yii\grid\ActionColumn',
			'header' => 'Options',
			'template' => '{update} {delete}',
            // you may configure additional properties here
        ],
	],
]);

$this->registerJs("var keys = $('#grid').yiiGridView('getSelectedRows')");
?>