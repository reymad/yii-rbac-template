<?php
/**
 * Created by PhpStorm.
 * User: Jesus
 * Date: 24/02/2017
 * Time: 16:53
 */
use app\components\Helpers;
use kartik\icons\Icon;
use mdm\admin\components\MenuHelper;
use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

// frontend menu

NavBar::begin([
    'brandLabel' => 'Yii Project :: Frontend',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
        'id' => 'main-header',
    ],
]);

if(Yii::$app->user->isGuest){

    /* menu guest */

    echo Helpers::getGuestMenu();// pasamos el context para Icons api

}else{

    /* menu logado */

    /*
     // ejemplo
    Icon::map($this);
    echo Icon::showStack('square-o', 'twitter', ['class'=>'fa-lg']);
    */

    // si estamos logados por red social pintamos iconito
    $social = Helpers::getSocialConnected();
    Icon::map($this,Icon::FA);
    $socialIcon = (!$social) ? '' : Icon::show($social, ['class'=>'social-icon'/*'fa-lg'*/] );

    // var_dump($socialIcon); exit;

    // logout va por form, lo excluimos de rbac
    $menu = MenuHelper::getAssignedMenu(Yii::$app->user->id);
    $logoutItem[] = '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Logout (' . trim($socialIcon) . trim(Yii::$app->user->identity->username) . ')',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>';
    $menu = \yii\helpers\ArrayHelper::merge($menu, $logoutItem);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menu,
        'encodeLabels' => false,
    ]);
}

NavBar::end();

?>
