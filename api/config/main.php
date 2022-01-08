<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'name'=>'API KOPKARS PNJ',
    'basePath' => dirname(__DIR__),
    //'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'components' => [
        // 'assetManager' => [
        //     'bundles' => [
        //         'yii\web\JqueryAsset' => [
        //             'jsOptions' => [ 'position' => \yii\web\View::POS_HEAD ],
        //         ],
        //     ],
        // ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'i18n' => [
            'translations' => [
                '*' => [ // This config applies to all translations
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages'
                ],
            ],
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
        'request' => [
            'csrfParam' => '_csrf-api',
            //setting jika menggunakan Cloud Server
            'class' => 'common\components\Request',
            'web'=> '/api/web',
            'baseUrl' => '/api',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->data !== null && Yii::$app->request->get('suppress_response_code')) {
                    $response->data = [
                        'success' => $response->isSuccessful,
                        'data' => $response->data,
                    ];
                    $response->statusCode = 200;
                }
            },
        ],
        // 'session' => [
        //     // this is the name of the session cookie used for login on the api
        //     'name' => 'advanced-api',
        // ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            //'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'anggota','extraPatterns' =>
                    [
                        'GET index' => 'index'
                    ]
                ],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'produk','extraPatterns' =>
                    [
                        'GET index' => 'index'
                    ]
                ],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user','extraPatterns'=>
                    [
                        'GET test'=>'test',
                        'POST login'=>'login'
                    ]
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\Anggota',
            'enableAutoLogin' => true,
            'enableSession'=>false,
            //'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
    ],
    'params' => $params,
];
