<?php
/**
 * Created by PhpStorm.
 * User: jrey
 * Date: 13/02/2017
 * Time: 10:59
 */

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;


class MyController extends Controller
{

    public function init()
    {
        parent::init();
        #add your logic: read the cookie and then set the language
        $this->setLanguage();

    }

    private function setLanguage(){

        if( ($lang = Yii::$app->request->get('lang')) && (ArrayHelper::isIn(Yii::$app->request->get('lang'), Yii::$app->params['idiomas']) ) )
        {
            $this->setCookie([
                'name' => 'lang',
                'value' => $lang,
                'expire' => time() + 86400 * 365,
            ]);
            $this->setLang($lang);
        }
        else if($lang = $this->getCookie('lang'))
        {
            $this->setLang($lang);
        }
        else
        {
            $this->setLang(Yii::$app->params['idioma_default']);
        }

    }

    /*
     * Cookie management to all children classes
     * */
    public function getCookie($cookieName){
        $cookies = Yii::$app->request->cookies;
        if ($cookies->has($cookieName))
            return $cookies->getValue($cookieName);
        return false;
    }

    public function setCookie($params=[]){
        $cookies = Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie($params));
    }

    /*
     * Lang setters
     * */
    public function getLang(){
        return Yii::$app->language;
    }

    public function setLang($lang){
        Yii::$app->language = $lang;
    }


}