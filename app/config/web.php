<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'es-ES',
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'oY1yy9HRy0o3a7umOB6xX1f5nkcKmjb6',
        ],
        'formatter'   => [
            'class'    => 'yii\i18n\Formatter',
            'timezone' => 'Europe/Madrid',
        ],
        'assetManager' => [
            'forceCopy' => (YII_ENV=='dev'),
            //'appendTimestamp' => true,
        ],
        'mobiledetect' => [
            'class' => 'dkeeper\mobiledetect\Detect',
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
            'useFileTransport' => (YII_ENV=='dev'),//true,
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
        'urlManager'   => [
            'class' => 'yii\web\UrlManager',
            // 'class' => \app\components\MyUrlManager::className(),
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            // 'suffix'          => false,
            'rules'           => require(__DIR__ . '/rules.php'),
            /*
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
            */
        ],
        'i18n'         => [
            'translations' => [
                '*' => [
                    'class'              => 'yii\i18n\DbMessageSource',
                    'sourceMessageTable' => 'Traduccion',
                    'messageTable'       => 'TraduccionMensaje',
                    'enableCaching'      => true,
                    'cachingDuration'    => 600,
                    //'forceTranslation'   => true,
                ],
            ],
        ],
    ],
    'params' => $params,
];


// var_dump($_SERVER['REMOTE_ADDR']); exit;

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.10.1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.10.1'],
    ];
}

return $config;
