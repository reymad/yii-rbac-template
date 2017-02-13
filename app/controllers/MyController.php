<?php
/**
 * Created by PhpStorm.
 * User: jrey
 * Date: 13/02/2017
 * Time: 10:59
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;


class MyController extends Controller
{

    public function init()
    {
        parent::init();
        #add your logic: read the cookie and then set the language
        // de momento español aqui irá la lógica de idiomas
        \Yii::$app->language = 'es-ES';

    }

}