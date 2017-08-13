<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\grid\GridView;
use yii\bootstrap\Nav;

$this->title = 'Order';
?>
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
<?php 
echo GridView::widget([
    'dataProvider' => $dataProvider,
	'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
		'order_number',
		'subtotal',
		'shipping',
		'total',
		[
			'class' => 'yii\grid\DataColumn',
			'label' => 'Status',
			'value' => function($data){
				switch($data->order_status){
					case '1' :
						return 'current';
						break;
					case '2' :
						return 'past';
						break;
					case '3' :
						return 'returns';
						break;
				}
			}
		],
		[
			'class' => 'yii\grid\DataColumn',
			'label' => 'Pay',
			'value' => function($data){
				if($data->pay_status){
					return 'Paid';
				}else{
					return 'Unpaid';
				}
			}
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