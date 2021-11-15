<?php
return [
    'aliases' => [
        '@kopkars-assets'   => '@vendor/kopkars-assets',
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'rbac' => [
            'class' => 'yii2mod\rbac\Module',
        ],
        'rbacconsole' => [
            'class' => 'yii2mod\rbac\ConsoleModule'
        ]
    ],
    'components' => [
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
            'class' => 'yii\caching\FileCache',
        ],
        
    ],
];
