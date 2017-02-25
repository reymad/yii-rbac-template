<?php

namespace app\models;

use app\rbac\RbacConf;
use mdm\admin\components\DbManager;
use Yii;

use \dektrium\user\models\User as BaseUser;// extendemos de la api

class User extends BaseUser {

    /*
     * to add
     * */
    public $status;
    public $password_reset_token;

    public $random = 'KJADSFASF7WAELA';


    // \Yii::$app->user->can('createPost')

    /*
     * Devuelve nombre del role del user
     * */
    public function getRoleName()
    {
        $roles = Yii::$app->authManager->getRolesByUser($this->id);
        if (!$roles) {
            return null;
        }

        reset($roles);
        /* @var $role \yii\rbac\Role */
        $role = current($roles);

        return $role->name;
    }

    /** @inheritdoc */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        // INSERTAMOS ROL USUARIO POR DEFECTO CUANDO UN USUARIO SE REGISTRA
        $auth = new DbManager;
        $auth->init();
        $role = $auth->getRole(RbacConf::ROLE_USUARIO);
        $auth->assign($role, $this->id);

    }

    /*
     * Relations
     * */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['created_by' => 'id']);
    }


}
