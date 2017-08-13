<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'statics/css/bootstrap.css',
		'statics/css/font-awesome.css',
		'statics/css/custom.css',
    ];
    public $js = [
		'statics/js/custom.js',
    ];
	
	public $cssOptions = [
		'http://fonts.googleapis.com/css?family=Open+Sans',
	];
	
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
