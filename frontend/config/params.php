<?php
return [
    'adminEmail' => '15816241645@139.com',
	'webName' => 'Mobile Shop',
	'nav' => '{
		"options": {
			"class": "nav navbar-nav"
		},
		"items": [
			{
				"label": "Home",
				"url": [
					"/site/index"
				]
			},
			{
				"label": "PC COMPUTER",
				"url": {
					"0":"/goods/list", "category_id":"1"
				}
			},
			{
				"label": "TAPTOPS & NOTEBOOK",
				"url": {
					"0":"/goods/list", "category_id":"5"
				}
			},
			{
				"label": "MOBILES & TABLET",
				"url": {
					"0":"/goods/list", "category_id":"4"
				}
			}
		]
	}',
	'shipping' => 100.0,
	'pageSize' => 16,
];
