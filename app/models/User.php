<?php

namespace app\models;

use app\components\RbacConf;
use mdm\admin\components\DbManager;
use Yii;

class User extends \dektrium\user\models\User {

    /*
     * to add
     * */
    public $status;
    public $password_reset_token;


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

}
