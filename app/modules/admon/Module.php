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
                    /*
                    [
                        'allow' => false,
                        'roles' => ['?'],// estaba como  'admin'
                    ],
                    /*
                    [
                        'allow' => true,
                        'roles' => ['admin'],// estaba como  'admin'
                    ],
                    */
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return \Yii::$app->user->identity->isAdmin;
                        }
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

        $this->layout = 'main';// admon/views/layouts/main

        // custom initialization code goes here
        $this->modules = [
            'user' => [
                'class' => 'dektrium\user\Module',
                'admins' => ['admin','jesus'],
            ],
            'admin' => [
                'class' => 'mdm\admin\Module',
                'layout' => 'left-menu',
                'mainLayout' => '@app/modules/admon/views/layouts/main.php',// usamos el layout de nuestra app
                'menus' => [
                    'assignment' => [
                        'label' => 'Grant Access' // change label
                    ],
                    'route' => null, // disable menu
                ],
                'controllerMap' => [
                    'assignment' => [
                        'class' => 'mdm\admin\controllers\AssignmentController',
                        'userClassName' => 'app\models\User',
                        'idField' => 'id',
                        'usernameField' => 'username',
                        // 'fullnameField' => 'profile.name',
                        'extraColumns' => [
                            [
                                'attribute' => 'status',
                                'label' => 'Status',
                                'value' => function($model, $key, $index, $column) {
                                    return $model->status;
                                },
                            ],
                        ],
                        // 'searchClass' => 'app\models\UserSearch'
                    ],
                ],
            ]
        ];

    }
}
