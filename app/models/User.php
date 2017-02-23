<?php

namespace app\models;

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

}
