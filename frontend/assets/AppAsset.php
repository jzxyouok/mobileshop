<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'statics/css/bootstrap.min.css',
        'statics/css/style.css',
        'statics/font-awesome/css/font-awesome.min.css',
        'statics/fonts/font-slider.css',
        'statics/rating/bootstrap-rating.css',
    ];
    public $js = [
		'statics/js/mail-ajax.js',
		'statics/js/photo-gallery.js',
        'statics/rating/bootstrap-rating.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
