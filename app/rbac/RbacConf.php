<?php
/**
 * Created by PhpStorm.
 * User: jrey
 * Date: 24/02/2017
 * Time: 13:18
 */

namespace app\rbac;


class RbacConf
{

    // ROLES
    const ROLE_ADMIN    = 'admin';
    const ROLE_USUARIO  = 'usuario';
    const ROLE_INVITADO = 'invitado';
    const ROLE_PREMIUM  = 'usuario_premium';

    // REGLAS
    const RULE_ISAUTHOR = 'isAuthor';

    // PERMISOS
    const PERMISSION_CREATE_POST     = 'createPost';
    const PERMISSION_UPDATE_POST     = 'updatePost';
    const PERMISSION_UPDATE_OWN_POST = 'updateOwnPost';

}