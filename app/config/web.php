<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'es-ES',
    'bootstrap' => ['log'],
    'modules' => [
        'admon' => [
            'class' => 'app\modules\admon\Module',
            // 'defaultController' => 'AdmonController',
            'defaultRoute' => 'admon/index',
        ],
        /* estos son sub-modules de admon */
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['admin','jesus'],
            // rest of config inside Admon module
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            // rest of config inside Admon module
        ]
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'oY1yy9HRy0o3a7umOB6xX1f5nkcKmjb6',
        ],
        /*
        'formatter'   => [
            'class'    => 'yii\i18n\Formatter',
            'timezone' => 'Europe/Madrid',
        ],
        */
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
        //
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
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
        /*
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
        */
    ],
    // yii2-admin ext
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'admin/*',
            'user/*',
            'debug/*',
            'gii/*',
            'admon/*',
            'some-controller/some-action',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
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
        'allowedIPs' => ['*'],// quitar en prod
        /*
        'allowedIPs' => [
            '127.0.0.1', '::1',
            // '192.xxx.xx.x',// casa
            ],
        */
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],// quitar en prod
        /*
        'allowedIPs' => [
            '127.0.0.1', '::1', 
            '192.168.10.1', // curro
            // '192.xxx.xx.x',// casa
        ],
        */
    ];
}

return $config;
