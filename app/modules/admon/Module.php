<?php

namespace app\modules\admon;

use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\filters\VerbFilter;

/**
 * admon module definition class
 */
class Module extends \yii\base\Module
{

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete'          => ['post'],
                    'confirm'         => ['post'],
                    'resend-password' => ['post'],
                    'block'           => ['post'],
                    'switch'          => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],//estaba como  'admin'
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admon\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
