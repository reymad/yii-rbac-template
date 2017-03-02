<?php

$params = require(__DIR__ . '/params.php');

// plase this code somewhere in your config files (bootstrap.php in case of using advanced app template, web.php in case
// of using basic app template

use dektrium\user\controllers\SecurityController;
use dektrium\user\events\AuthEvent;
use yii\base\Event;


// var_dump($params['social']['twitter']['appId']); exit;

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
            'admins' => ['admin','jesus','rey_mad'],
            // 'admins' => ['*'],
            // usamos my modelo usuario que extiende de la api yii2-user
            'modelMap' => [
                'User' => 'app\models\User',
            ],
            // tambien podemos hacer esto
            /*
            'modelMap' => [
                'User' => [
                    'class' => 'app\models\User',
                    'on user_create_init' => function () {
                        // do you magic
                    },
                    'as foo' => [
                        'class' => 'Foo',
                    ],
                ],
            ],
            */
            // rest of config inside Admon module
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            // rest of config inside Admon module
        ],
        // kartik social
        'social' => [
            // the module class
            'class' => 'kartik\social\Module',

            // the global settings for the Disqus widget
            'disqus' => [
                'settings' => ['shortname' => 'DISQUS_SHORTNAME'] // default settings
            ],
            // the global settings for the Twitter plugin widget
            'twitter' => [
                'screenName' => 'TWITTER_SCREEN_NAME'
            ],
            // the global settings for the Facebook plugins widget
            'facebook' => [
                'appId' => $params['social']['facebook']['appId'],
                'secret' => $params['social']['facebook']['secret'],
            ],
            /*
            // the global settings for the Google+ Plugins widget
            'google' => [
                'clientId' => 'GOOGLE_API_CLIENT_ID',
                'pageId' => 'GOOGLE_PLUS_PAGE_ID',
                'profileId' => 'GOOGLE_PLUS_PROFILE_ID',
            ],
            // the global settings for the Google Analytics plugin widget
            'googleAnalytics' => [
                'id' => 'TRACKING_ID',
                'domain' => 'TRACKING_DOMAIN',
            ],
            // the global settings for the GitHub plugin widget
            'github' => [
                'settings' => ['user' => 'GITHUB_USER', 'repo' => 'GITHUB_REPO']
            ],
            */
        ]
        // your other modules

    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'oY1yy9HRy0o3a7umOB6xX1f5nkcKmjb6',
        ],
        'authClientCollection' => [
            'class'   => 'yii\authclient\Collection',//\yii\authclient\Collection::className(),
            'clients' => [
                // here is the list of clients you want to use
                // you can read more in the "Available clients" section
                'twitter' => [
                    'class'          => 'dektrium\user\clients\Twitter',
                    'consumerKey'    => $params['social']['twitter']['appId'],
                    'consumerSecret' => $params['social']['twitter']['secret'],
                ],
                /*
                'google' => [
                    'class' => 'yii\authclient\clients\Google'
                ],
                */
                'facebook' => [
                    'class'        => 'dektrium\user\clients\Facebook',
                    'clientId'     =>  $params['social']['facebook']['appId'],
                    'clientSecret' =>  $params['social']['facebook']['secret'],
                ],

            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user'
                ],
            ],
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
            // 'defaultRoles' => ['invitado'],
            // por lo que he descubierto hasta el momento:
            /*
             * rbac outh
             * por defecto va a buscar en la tabla de items el rol por defecto que tenemos aquí. si no estamos logados.
             * si estamos logado buscará el rol/permisos del nombre de rol con el que estemos logados.
             * p.e:
             *  si nuestro rol es admin > cogeremos los accesos de admin
             *  si nadie esta logado, cogeremos los permisos de invitado
             * */
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
            // estas acciones e

            'site/*',
            // 'admin/*',
            'user/*',
            'debug/*',
            'gii/*',

            // ouath connect
            'user/registration/connect/*',
            'admon/user/registration/connect/*',

            // 'admon/*',
            // 'some-controller/some-action',
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

Event::on(SecurityController::class, SecurityController::EVENT_AFTER_AUTHENTICATE, function (AuthEvent $e) {
    // if user account was not created we should not continue
    if ($e->account->user === null) {
        return;
    }

    // var_dump($e); exit;

    // we are using switch here, because all networks provide different sets of data
    switch ($e->client->getName()) {
        case 'twitter':
            // ($e->client->api()) Yii::$app->user->(identity)->clients['twitter']->api($apiSubUrl, $method = 'GET', $data = [], $headers = [])
            break;
        case 'facebook':
            $e->account->user->profile->updateAttributes([
                'name' => $e->client->getUserAttributes()['name'],
            ]);
            break;
        case 'vkontakte':
            // some different logic
    }

    // after saving all user attributes will be stored under account model
    // Yii::$app->user->accounts['facebook']->decodedData;
});

return $config;
