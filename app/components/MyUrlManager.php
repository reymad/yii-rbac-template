<?php
/**
 * Created by PhpStorm.
 * User: jrey
 * Date: 13/02/2017
 * Time: 12:25
 */

namespace app\components;
use yii\web\UrlManager;
use Yii;

class MyUrlManager extends UrlManager
{
    public function createUrl($params)
    {
        if (!isset($params['lang'])) {
            if (Yii::$app->session->has('lang'))
                Yii::$app->language = Yii::$app->session->get('lang');
            else if(isset(Yii::$app->request->cookies['lang']))
                Yii::$app->language = Yii::$app->request->cookies['lang']->value;
            $params['lang']=Yii::$app->language;
        }
        return parent::createUrl($params);
    }
}