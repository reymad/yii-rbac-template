
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
            'label' => Yii::t('user', 'Users'),
            'url' => ['/user/admin/index'],
        ],
        [
            'label' => Yii::t('user', 'mdm-Rbac Admin'),
            'url' => ['/admin'],
        ],
    ],
]) ?>