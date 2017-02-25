<?php
/**
 * Created by PhpStorm.
 * User: Jesus
 * Date: 25/02/2017
 * Time: 9:10
 */
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // add "author" role and give this role the "createPost" permission
        $author = $auth->getRole('usuario');
        // $auth->add($author);
        $auth->addChild($author, $createPost);

        // add "author" role and give this role the "createPost" permission
        $author = $auth->getRole('usuario_premium');
        // $auth->add($author);
        $auth->addChild($author, $createPost);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->getRole('admin');
        // $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        // $auth->assign($author, 2);
        //  $auth->assign($admin, 1);
    }

    // creamos regla y permiso especial para atualizar solo los propios post
    public function actionOwnPost(){

        $auth = Yii::$app->authManager;

        // add the rule
        $rule = new \app\rbac\AuthorRule;
        $auth->add($rule);

        // add the "updateOwnPost" permission and associate the rule with it.
        $updateOwnPost = $auth->createPermission('updateOwnPost');
        $updateOwnPost->description = 'Update own post';
        $updateOwnPost->ruleName = $rule->name;
        $auth->add($updateOwnPost);

        // "updateOwnPost" will be used from "updatePost"
        $updatePost = $auth->getPermission('updatePost');
        $auth->addChild($updateOwnPost, $updatePost);

        // allow "author" to update their own posts
        $author = $auth->getRole('usuario');
        $auth->addChild($author, $updateOwnPost);

        $author = $auth->getRole('usuario_premium');
        $auth->addChild($author, $updateOwnPost);

    }
}