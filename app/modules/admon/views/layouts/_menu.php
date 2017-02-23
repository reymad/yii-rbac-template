
<?php
use yii\bootstrap\Nav;

$urlCurrent = \yii\helpers\Url::current();

?>

<?= Nav::widget([
    'options' => [
        'class' => 'nav-tabs',
        'style' => 'margin-bottom: 15px',
    ],
    'items' => [
        [
            'label' => Yii::t('user', 'User extension :: yii-user'),
            'url' => ['/admon/user/admin/index'],
            'active' => (strpos($urlCurrent,'user/admin')!==false),
        ],
        [
            'label' => Yii::t('user', 'Admin extension :: mdm-Rbac'),
            'url' => ['/admon/admin'],
            'active' => (strpos($urlCurrent,'admon/admin')!==false),
        ],
    ],
]) ?>