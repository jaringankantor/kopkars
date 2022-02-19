<?php
return [
    'aliases' => [
        '@kopkars-assets'   => '@vendor/kopkars-assets',
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
    ],
    'components' => [
        'kopkarstext' => [
            'class' => 'common\components\Kopkarstext'
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'jsOptions' => [ 'position' => \yii\web\View::POS_HEAD ],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest', 'user'],
        ],
        'cache' => [
            'class' => 'yii\redis\Cache',
            // 'redis' => 'redis' // id of the connection application component
        ],
        'formatter' => [
            'thousandSeparator' => '.',
            'currencyCode' => 'IDR',
       ],
    ],
];
