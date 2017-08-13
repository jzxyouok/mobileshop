<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
/* @var $this yii\web\View */

$this->title = 'Mobile Shop';

$LastestItems = '';
foreach($oLastest as $key => $value){
$LastestItems .= '
							<div class="product">
								<a href="'.Url::toRoute(['goods/show', 'id' => $value->id]).'"><img src="'.$value->goods_image.'" /></a>
								<div class="wrapper">
									<h5><a href="'.Url::toRoute(['goods/show', 'id' => $value->id]).'">'.$value->goods_name.'</a></h5>
									<div class="price">$'.$value->goods_price.'</div>
									<div class="rating">' . Html::hiddenInput('rating', $value->rating, ['class' => 'rating', 'data-readonly' => 'data-readonly']) . '</div>
								</div>
							</div>';
}

$GalleryItems = '';
foreach($oGoodsgallery as $key => $value){
$GalleryItems .= '
				<li class="col-lg-3 col-sm-3 col-xs-4">
					<a href="#">
						<img class="img-responsive" src="'.$value->img_url.'">
					</a>
				</li>';
}
?>
	<div id="page-content" class="single-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul class="breadcrumb">
						<li><a href="index.html">Home</a></li>
						<li><a href="<?= Url::toRoute(['/goods/list'])?>">Category</a></li>
						<li><a href="javascript:;"><?= $model->goods_name?></a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div id="main-content" class="col-md-8">
					<div class="product">
						<div class="col-md-6">
							<div class="image">
								<img src="<?= $model->goods_image?>" />
								<div class="image-more">
									 <ul class="row">
										<?= $GalleryItems?>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="caption">
								<div class="name"><h3><?= $model->goods_name?></h3></div>
								<div class="info">
									<ul>
										<li>Brand: <?= $brand->brand_name?></li>
										<li>ID: <?= $model->goods_number?></li>
									</ul>
								</div>
								<div class="price">$<?= $model->goods_price?><span>$<?= $model->market_price?></span></div>
								<div class="options">
									AVAILABLE OPTIONS
									<select>
										<option value="" selected>----Please Select----</option>
										<option value="red">RED</option>
										<option value="black">BLACK</option>
									</select>
								</div>
								<div class="rating"><?= Html::hiddenInput('rating', $model->rating, ['class' => 'rating', 'data-readonly' => 'data-readonly'])?></div>
								<div class="well"><label>Qty: </label><?= Html::beginForm(['cart/add', 'goods_id' => $model->id], 'post').Html::textInput('quantity', '1', ['class' => 'form-inline quantity']).Html::submitButton('ADD', ['class' => 'btn btn-2']).Html::endForm()?></div>
								<div class="share well">
									<strong style="margin-right: 13px;">Share :</strong>
									<a href="https://twitter.com/share" class="share-btn" target="_blank" data-url="<?= \Yii::getAlias('@webUrl') . Url::toRoute(['goods/show', 'id' => $model->id])?>">
										<i class="fa fa-twitter"></i>
									</a>
									<a href="https://www.facebook.com/sharer.php?u=<?= \Yii::getAlias('@webUrl') . Url::toRoute(['goods/show', 'id' => $model->id])?>" class="share-btn" target="_blank">
										<i class="fa fa-facebook"></i>
									</a>
									<a href="#" class="share-btn" target="_blank">
										<i class="fa fa-linkedin"></i>
									</a>
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</div>	
					<div class="product-desc">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#description">Description</a></li>
							<li><a href="#review">Review</a></li>
						</ul>
						<div class="tab-content">
							<div id="description" class="tab-pane fade in active">
								<?= $model->goods_description?>
							</div>
							<div id="review" class="tab-pane fade">
							  <div class="review-text">
									<?= ListView::widget([
										'dataProvider' => $oReviews,
										'itemView' => 'reviews_view',
										'summary' => false,
										'pager' => false,
									]);
									?>
							  </div>
							</div>
						</div>
					</div>
					<div class="product-related">
						<div class="heading"><h2>RELATED PRODUCTS</h2></div>
						<div class="products">
							<div class="col-lg-4 col-md-4 col-xs-12">
								<div class="product">
									<div class="image"><a href="product.html"><img src="<?php echo Yii::getAlias('@statics');  ?>/images/iphone.png" /></a></div>
									<div class="buttons">
										<a class="btn cart" href="#"><span class="glyphicon glyphicon-shopping-cart"></span></a>
										<a class="btn wishlist" href="<?= Url::toRoute(['collect/add', 'id' => $value->id])?>"><span class="glyphicon glyphicon-heart"></span></a>
										<a class="btn compare" href="#"><span class="glyphicon glyphicon-transfer"></span></a>
									</div>
									<div class="caption">
										<div class="name"><h3><a href="product.html">Aliquam erat volutpat</a></h3></div>
										<div class="price">$122<span>$98</span></div>
										<div class="rating"><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span></div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-xs-12">
								<div class="product">
									<div class="image"><a href="product.html"><img src="<?php echo Yii::getAlias('@statics');  ?>/images/galaxy-s4.jpg" /></a></div>
									<div class="buttons">
										<a class="btn cart" href="#"><span class="glyphicon glyphicon-shopping-cart"></span></a>
										<a class="btn wishlist" href="<?= Url::toRoute(['collect/add', 'id' => $value->id])?>"><span class="glyphicon glyphicon-heart"></span></a>
										<a class="btn compare" href="#"><span class="glyphicon glyphicon-transfer"></span></a>
									</div>
									<div class="caption">
										<div class="name"><h3><a href="product.html">Aliquam erat volutpat</a></h3></div>
										<div class="price">$122<span>$98</span></div>
										<div class="rating"><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span></div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-xs-12">
								<div class="product">
									<div class="image"><a href="product.html"><img src="<?php echo Yii::getAlias('@statics');  ?>/images/galaxy-note.jpg" /></a></div>
									<div class="buttons">
										<a class="btn cart" href="#"><span class="glyphicon glyphicon-shopping-cart"></span></a>
										<a class="btn wishlist" href="<?= Url::toRoute(['collect/add', 'id' => $value->id])?>"><span class="glyphicon glyphicon-heart"></span></a>
										<a class="btn compare" href="#"><span class="glyphicon glyphicon-transfer"></span></a>
									</div>
									<div class="caption">
										<div class="name"><h3><a href="product.html">Aliquam erat volutpat</a></div>
										<div class="price">$122<span>$98</span></div>
										<div class="rating"><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span><span class="glyphicon glyphicon-star-empty"></span></div>
									</div>
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div id="sidebar" class="col-md-4">
					<div class="widget wid-product">
						<div class="heading"><h4>LATEST</h4></div>
						<div class="content">
							<?= $LastestItems?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<!-- IMG-thumb -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">         
          <div class="modal-body">                
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?= $this->registerJs(" $(document).ready(function(){
		$('.nav-tabs a').click(function(){
			$(this).tab('show');
		});
		$('.nav-tabs a').on('shown.bs.tab', function(event){
			var x = $(event.target).text();         // active tab
			var y = $(event.relatedTarget).text();  // previous tab
			$('.act span').text(x);
			$('.prev span').text(y);
		});
	});")?>