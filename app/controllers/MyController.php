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
        parent::init();//
    }


    // INFO::SUBO LAS FUNCIONES AL PARENT


    /* SUBIR A CONTROLLER

    const YIIJS = 'YIIJS';// console.log(YII)


    public  $_translations = [];

    public function init()
    {
        parent::init();

        // inicializamos estas variables js SIEMPRE!
        $globalJsVar  = "\n var " . self::YIIJS . " = {}; ";

        $globalHead   = [
            'url'=>[
                'current_url' => Url::base(true) . Yii::$app->request->url,
                // add here
            ],
            'usuario'=>[
                'guest' => Yii::$app->user->isGuest,
                // add here
            ],
            'entorno'=>[
                'env' => YII_ENV,
            ],
            // add here
        ];
        $json          = Json::encode($globalHead);
        $globalJsVar  .= "\n " . self::YIIJS . " = " . $json . ";";
        $this->view->registerJs($globalJsVar, View::POS_HEAD, 'js-global');

        #add your logic: read the cookie and then set the language
        $this->setLanguage();
        // registro las traudcciones que necesitamos desde el layout
        $this->registerLayoutTranslations();
    }


    public function registerJsTranslations()
    {
        if(is_array($this->_translations) && !empty($this->_translations)){
            $objeto = [ 't'=>[] ];
            foreach($this->_translations as $message => $translation){
                $objeto['t'][$message] = $translation;
            }
            $json    = Json::encode($objeto);
            // Merge array/object en javascript Object.assign(obj1,obj2,etc);
            $script  = "\nObject.assign(".self::YIIJS.", ".$json.");";
            $this->view->registerJs($script, View::POS_HEAD, 'js-translations');
        }
    }

    private function registerLayoutTranslations(){

        // add as many as you need
        $this->_translations['app.hola-mundo']               = Yii::t('app','hola-mundo');
        $this->_translations['app.adios-mundo']              = Yii::t('app','adios-mundo');
        $this->_translations['app.general.cargando']         = Yii::t('app','general-cargando');
        $this->_translations['app.general.politica-cookies'] = Yii::t('app','general-politica-cookies');
        $this->_translations['app.general.bienvenido']       = Yii::t('app','general-bienvenido');
        $this->_translations['app.general.aceptar']          = Yii::t('app','general-aceptar');

        $this->registerJsTranslations();

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


    public function getLang(){
        return Yii::$app->language;
    }

    public function setLang($lang){
        Yii::$app->language = $lang;
    }

     */

}