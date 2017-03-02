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

    public function behaviors()
    {
        return [
            // retornar fecha formateada
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['created_at'],
                ],
                'value' => function ($event) {

                    if(isset(Yii::$app->language)){
                        return date(Helpers::getDateFormat(Yii::$app->language), $this->owner->created_at);
                    }
                    return $this->owner->created_at;

                },
            ],
            // retornar fecha formateada
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['updated_at'],
                ],
                'value' => function ($event) {

                    if(isset(Yii::$app->language)){
                        return date(Helpers::getDateFormat(Yii::$app->language), $this->owner->updated_at);
                    }
                    return $this->owner->updated_at;

                },
            ],
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