<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$aliases = require(__DIR__ . '/aliases.php');

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\Customer',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:[\w-]+>/<id:\d+>'=>'<controller>/item',
                '<controller:[\w-]+>/list/<category_id:\d+>'=>'<controller>/list',
            ],
        ],
		'paypal'=> [
			'class'        => 'cinghie\paypal\components\Paypal',
			'clientId'     => 'AajgF2ZEo4AjzM7kItR1io4nREL6uRS98uWZhQQJGfILXG_bee39NrKUEP6EwISAF8_gRsSYwFfKtw_m',
			'clientSecret' => 'EPTUvuE57bDg34QjV6jtqyV5PPIqoZpVL-N3t3kpv3UBGnTsD4Ax6q2YHpDjZkmsAO_8q7mLDZSXcMgm',
			//'isProduction' => false,
			// This is config file for the PayPal system
			'config'       => [
				'mode' => 'sandbox', // development (sandbox) or production (live) mode
			]
		],
       
    ],
    'params' => $params,
	'aliases' => $aliases,
];
