<?php
use yii\rest\UrlRule;


$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),    
    //'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            //'basePath' => '@api/modules/v1',
            'class' => api\modules\v1\Module::class
        ]
    ],
    'components' => [     
         'request' => [
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
        ],   
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => UrlRule::class,
                    'controller' => [
                        'v1/home'
                    ],
                    'extraPatterns' => [
                        'OPTIONS index' => 'options',
                        'GET index' => 'index',
                
                    ]
                ],
            ],        
        ]
    ],
    'params' => $params,
];



