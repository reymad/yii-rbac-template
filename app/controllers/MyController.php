<?php
/**
 * Created by PhpStorm.
 * User: jrey
 * Date: 13/02/2017
 * Time: 10:59
 */

namespace app\controllers;

use Yii;
use yii\web\View;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;


class MyController extends Controller
{

    // usage yii.t['message'] => 'translation';
    private $jsTranslationObject = [ 't' => [] ];

    public function init()
    {
        parent::init();
        #add your logic: read the cookie and then set the language
        $this->setLanguage();

    }

    /*
    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);
        // custom code here
        return $result;
    }
    */

    /*
     * registra dentro de <head> variable traducción js
     * Se define cada traduccion en la corresponidente accion
     * $this->setFrontTranslation('nombre.cadena','traducción!');
     * Se accede asi en js p.e:
     *  Yii.t['nombre.cadena'] => 'traducción!'
     * */
    public function setFrontTranslation($message, $tranlation)
    {
        $this->jsTranslationObject['t'][$message] = $tranlation;
        $this->registerFrontTranslation();
    }
    private function registerFrontTranslation()
    {
        $translations = Json::encode($this->jsTranslationObject);
        $script       = " Yii = " . $translations . ";\n";
        $this->view->registerJs($script, View::POS_HEAD, 'mapJs');
    }
    /*
     * Fin traduccion front
     * */

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