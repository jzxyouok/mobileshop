<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <div id="wrapper">
         <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo Url::to(['site/index']);?>">
                        <img src="<?php echo Yii::getAlias('@statics');  ?>/img/logo.png" />

                    </a>
                    
                </div>
              
                <span class="logout-spn" >
		<?php echo Html::beginForm(['/site/logout'], 'post').Html::submitButton('Logout (' . Yii::$app->user->identity->name . ')', ['class' => 'fa fa-sign-out btn btn-link logout']).Html::endForm(); ?>
                </span>
            </div>
        </div>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">


                    <li>
                        <a href="<?php echo Url::to(['/goodscategory/list']);?>"><i class="fa fa-filter "></i>Goods Category</a>
                    </li>
                    <li>
                        <a href="<?php echo Url::to(['/goodsos/list'])?>"><i class="fa fa-bar-chart-o"></i>Goods OS</a>
                    </li>
                    <li>
                        <a href="<?php echo Url::to(['/goodsbrand/list'])?>"><i class="fa fa-bar-chart-o"></i>Goods Brand</a>
                    </li>

                    <li>
                        <a href="<?php echo Url::to(['/goods/list']);?>"><i class="fa fa-edit "></i>Goods</a>
                    </li>
                    <li>
                        <a href="<?php echo Url::to(['/banner/list']);?>"><i class="fa fa-image "></i>Banner</a>
                    </li>
                    <li>
                        <a href="<?php echo Url::to(['/customer/list']);?>"><i class="fa fa-users"></i>Customer</a>
                    </li>
                    <li>
                        <a href="<?php echo Url::to(['/cart/list']);?>"><i class="fa fa-shopping-cart"></i>Cart</a>
                    </li>
                     <li>
                        <a href="<?php echo Url::to(['/order/list']);?>"><i class="fa fa-edit "></i>Order</a>
                    </li>
                     <li>
                        <a href="<?php echo Url::to(['/content/list']);?>"><i class="fa fa-clipboard "></i>Content</a>
                    </li>
                     <li>
                        <a href="<?php echo Url::to(['/guestbook/list']);?>"><i class="fa fa-envelope "></i>Guestbook</a>
                    </li>
                    
                </ul>
            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div class="copyrights">Collect from <a href="http://www.cssmoban.com/"  title="网站模板">网站模板</a></div>
        <div id="page-wrapper" >
            <div id="page-inner">
                <?= $content ?>
			</div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
        </div>
    <div class="footer">
      
    
            <div class="row">
                <div class="col-lg-12" >
                    &copy;  2017 www.mobileshop.com 
                </div>
            </div>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
