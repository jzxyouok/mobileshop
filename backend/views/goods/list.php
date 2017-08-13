<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\grid\GridView;
use yii\bootstrap\Nav;

$this->title = 'Goods';
?>
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
<?php 
echo GridView::widget([
    'dataProvider' => $dataProvider,
	'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
		'goods_name',
		'goods_number',
		[
			'class' => 'yii\grid\DataColumn',
			'label' => 'goods_image',
			'format' => 'html',
			'value' => function($data){
				return Html::img($data->goods_image, ['alt' => $data->goods_name, 'height' => '120']);
			} ,
		],
		'market_price',
		'goods_price',
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
			'template' => '{view} {update} {delete}',
            // you may configure additional properties here
        ],
	],
]);

?>