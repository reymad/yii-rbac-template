<?php
/**
 * Created by PhpStorm.
 * User: jrey
 * Date: 13/02/2017
 * Time: 10:49
 */

return [
    /*
    'data/bijoux.json' => 'site/get-json',
    'orgasmo/<id>' => 'site/index',
    'admin/<action:login|logout>' => 'admin/default/<action>',
    'admin/<controller>/<action>/<id:\d+>'=>'admin/<controller>/<action>',
    'admin' => 'admin/default',
    */
    //'<controller:[\w\-]+>/<action:[\w\-]+>' => '<controller>/<action>',
    // '<action:[\w\-]+>' => 'site/<action>',

    // '/user/register' => 'site/register',

    '<controller:\w+>/<id:\d+>' => '<controller>/view',
    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',

    // 'user/<controller:\w+>/<id:\d+>' => 'admon/user/<controller>/view',
    // 'user/<controller:\w+>/<action:\w+(-\w+)*>/<id:\d+>' => 'admon/user/<controller>/<action>',
    // 'user/<controller:\w+>/<action:\w+(-\w+)*>' => 'admon/user/<controller>/<action>',

    // 'user/admin/update-profile/<id:\d+>' => 'admon/user/<controller>/<action>',

    // estos funcionan // lo comenté para el twitter login
    'user/admin/create'=>'admon/user/admin/create',
    'user/admin/index'=>'admon/user/admin/index',



/*
    '<language:\w+>/'=>'/site/index',
    '<language:\w+>/<controller>' => '<controller>',
    '<language:\w+>/<controller>/<action>' => '<controller>/<action>',
    '<language:\w+>/<controller>/<action>/<id:\d+>' => '<controller>/<action>',
    '<language:\w+>/<controller>/<action>/<id:\d+>/<title>' => '<controller>/<action>',
    '<language:\w+>/<controller>/<id:\d+>/<title>' => '<controller>/index',
*/


];