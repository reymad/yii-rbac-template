
<?php
use yii\bootstrap\Nav;

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
        ],
        [
            'label' => Yii::t('user', 'Admin extension :: mdm-Rbac'),
            'url' => ['/admon/admin'],
        ],
    ],
]) ?>