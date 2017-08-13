<?php 

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ListView;
use yii\bootstrap\ActiveForm;

$this->title = 'Cart';
?>
	<div id="page-content" class="single-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul class="breadcrumb">
						<li><a href="<?= Url::toRoute(['/site/index'])?>">Home</a></li>
						<li><a href="<?= Url::toRoute(['/cart/list'])?>">Cart</a></li>
					</ul>
				</div>
			</div>

			<?= ListView::widget([
				'dataProvider' => $dataProvider,
				'itemView' => 'list_view',
				'summary' => false,
			]);?>
			
			<div class="row">
				<div class="col-md-4 col-md-offset-8 ">
					<center><a href="<?= Url::toRoute(['site/index'])?>" class="btn btn-1">Continue To Shopping</a></center>
				</div>
			</div>
            <?php $form = ActiveForm::begin(['action' => Url::toRoute(['order/add']), 'id' => 'add-order-form']); ?>
			<div class="row">
				<div class="pricedetails">
					<div class="col-md-4 col-md-offset-8">
						<table>
							<h6>Price Details</h6>
							<tr>
								<td>Total</td>
								<td>$<?= $subtotal?></td>
							</tr>
							<tr>
								<td>Discount</td>
								<td>-----</td>
							</tr>
							<tr>
								<td>Address</td>
								<td><?= Html::dropDownList('address', null, ArrayHelper::map($oAddress,'id', 'address'), ['prompt' => '--Select Address--']) ?></td>
							</tr>
							<tr>
								<td>Delivery Charges</td>
								<td>$<?= \Yii::$app->params['shipping']?></td>
							</tr>
							<tr style="border-top: 1px solid #333">
								<td><h5>TOTAL</h5></td>
								<td>$<?= $total?></td>
							</tr>
						</table>
						<center><?= Html::submitButton('Checkout', ['class' => 'btn btn-1', 'name' => 'submit-button']) ?></center>
					</div>
				</div>
			</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>	