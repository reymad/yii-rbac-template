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

    public $imagesUrl = '/assets/dist/images/';

    /*
    public function afterAction($action, $result)
    {
       $result = parent::afterAction($action, $result);
       // custom code here
       return $result;
    }
    */

    public function init()
    {
        parent::init();
    }


    // INFO::SUBO LAS FUNCIONES AL PARENT

}