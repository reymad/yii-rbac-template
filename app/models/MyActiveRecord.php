<?php
/**
 * Created by PhpStorm.
 * User: jrey
 * Date: 02/03/2017
 * Time: 16:04
 */

namespace app\models;


use app\behaviors\UserBehavior;
use app\components\Helpers;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class MyActiveRecord extends ActiveRecord
{

    const STATUS_ACTIVE  = 10;
    const STATUS_DELETED =  0;

    public function formatDate($attr, $lang){

        if(isset($this->$attr)){
            return date(Helpers::getDateFormat($lang), $this->$attr);
        }else{
            return "El atributo $attr no existe";
        }

    }
    public function formatDateI18n($attr){

        if (!$this->$attr || $this->$attr == 0) {
            return Yii::t('user', 'Never');
        } else if (extension_loaded('intl')) {
            return Yii::t('user', '{0, date, MMMM dd, YYYY HH:mm}', [$this->$attr]);
        } else {
            return date('Y-m-d G:i:s', $this->$attr);
        }

    }

    public function behaviors()
    {
        return [
            /*
            // retornar fecha formateada
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_VALIDATE => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE   => ['created_at']
                ],
                'value' => function ($event) {

                    switch($event->name){
                        case ActiveRecord::EVENT_AFTER_FIND:

                            if(isset(Yii::$app->language)){
                                return date(Helpers::getDateFormat(Yii::$app->language), $this->owner->created_at);
                            }
                            return $this->owner->created_at;

                            break;
                        case ActiveRecord::EVENT_BEFORE_VALIDATE:
                        case ActiveRecord::EVENT_BEFORE_UPDATE:

                            return strtotime ($this->owner->created_at);

                            break;
                    }


                },
            ],
            // retornar fecha formateada
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND   => ['updated_at'],
                    ActiveRecord::EVENT_BEFORE_VALIDATE => ['updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE   => ['updated_at']
                ],
                'value' => function ($event) {

                    switch($event->name){
                        case ActiveRecord::EVENT_AFTER_FIND:

                            if(isset(Yii::$app->language)){
                                return date(Helpers::getDateFormat(Yii::$app->language), $this->owner->updated_at);
                            }
                            return $this->owner->updated_at;

                            break;
                        case ActiveRecord::EVENT_BEFORE_VALIDATE:
                        case ActiveRecord::EVENT_BEFORE_UPDATE:

                            return strtotime ($this->owner->updated_at);

                            break;
                    }



                },
            ],
            */
            // retornar user from relacion
            /*
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['created_by'],
                ],
                'value' => function ($event) {
                    if(isset($this->owner->createdBy)){
                        $ret = $this->owner->createdBy->username . ' (#'.$this->owner->created_by.')';
                    }else{
                        $ret = $this->owner->created_by;
                    }
                    return $ret;

                },
            ],
            */
            TimestampBehavior::className(),// guardar fecha automaticamente
            UserBehavior::className(),// mine, guardar created_by
        ];
    }


}