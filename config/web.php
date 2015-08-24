<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'blog' => [
            'class' => 'app\modules\blog\BlogModule',
        ],
        'admin' => [
            'class' => 'app\modules\admin\AdminModule',
        ],
        'blog2' => [
            'class' => 'app\modules\blog2\Module',
        ],
    ],
    
    'components' => [
        'formatter' => [
            'timeFormat' => 'H:i',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'rqNGEPidiFeyu7lEXSOwdeHSI4u4Xefx',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
           // 'class' => 'yii\rbac\DbManager', // Delete this if not use blogS
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
                '' => 'site/index',
                'login' => 'site/login',
                'articles' => 'site/articles',
                'contact' => 'site/contact',
                //'blog2' => 'blog2/default/index',
                //'blog2/<id:\d+>' => 'blog2/default/view',
                '<_m:blog2>/<id:\w+>' => '<_m>/default/view',
                '<_m:blog2>/page-<page:\d+>' => '<_m>/default/index',
                '<_m:blog2>' => '<_m>/default/index',

                
                
            ],
        ],
        'assetManager' => [
            'basePath' => '@webroot/assets',
            'baseUrl' => '@web/assets'
        ],
    ],
    'params' => $params,

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
