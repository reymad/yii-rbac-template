<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\FrontAsset;
use app\components\Helpers;
use kartik\icons\Icon;
use mdm\admin\components\MenuHelper;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

FrontAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="site">
<?php $this->beginBody() ?>

<div class="wrap">
    <?php

    // frontend menu

    NavBar::begin([
        'brandLabel' => 'Yii Project :: Backend',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    // si estamos logados por red social pintamos iconito
    $social = Helpers::getSocialConnected();
    Icon::map($this,Icon::FA);
    $socialIcon = (!$social) ? '' : Icon::show($social, ['class'=>''/*'fa-lg'*/,'style'=>'color:#fff;'] );

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
        'items' =>$menu,
    ]);


    NavBar::end();

    ?>

    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= $this->render('_menu') ?>

        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
