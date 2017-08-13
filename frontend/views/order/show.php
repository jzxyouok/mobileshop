<?php 

use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = 'Order';
?>
				<div class="col-lg-9">
					<div class="widget wid-categories">
						<div class="heading"><h4>Order</h4></div>
						<div class="content">
							<div class="row">
								<div class="product well">
									<div class="col-md-12">
										<div class="caption">
											<div class="name"><h3><a href="<?= Url::toRoute(['order/show', 'id' => $model->id])?>">NO. <?= $model->order_number?></a></h3></div>
											<div class="info">	
												<ul>
													<li>Date : <?= $model->created_at?></li>
												</ul>
											</div>
											<div class="price">$<?= $model->total?></div>
											<hr>
											<div class="name"><h3><a href="<?= Url::toRoute(['order/show', 'id' => $model->id])?>">1. Delivery</a></h3></div>
											<div class="info">	
												<ul>
													<li>Receiver : <?= $oAddress->receiver?></li>
													<li>Address : <?= $oAddress->address?></li>
													<li>Phone : <?= $oAddress->mobile?></li>
													<li>Email : <?= $oAddress->email?></li>
												</ul>
											</div>
											<hr>
											<div class="name"><h3><a href="<?= Url::toRoute(['order/show', 'id' => $model->id])?>">2. Your Order</a></h3></div>
											<div class="info">	
							<?= ListView::widget([
								'dataProvider' => $dataProvider,
								'itemView' => 'goods_view',
								'summary' => false,
							]);?>
											</div>
											<hr>
											<div class="row">
												<div class="pricedetails">
													<div class="col-md-4 col-md-offset-8">
														<table>
															<h6>Price Details</h6>
															<tr>
																<td>Total</td>
																<td>$<?= $model->subtotal?></td>
															</tr>
															<tr>
																<td>Discount</td>
																<td>-----</td>
															</tr>
															<tr>
																<td>Delivery Charges</td>
																<td>$<?= $model->shipping?></td>
															</tr>
															<tr style="border-top: 1px solid #333">
																<td><h5>TOTAL</h5></td>
																<td>$<?= $model->total?></td>
															</tr>
														</table>
													</div>
												</div>
											</div>
											<hr>
										</div>
									</div>
									<div class="clear"></div>
								</div>	
							</div>
						</div>
					</div>
				</div>
