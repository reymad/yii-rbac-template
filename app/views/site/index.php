<?php

use app\components\Helpers;

/* @var $this yii\web\View */

echo 'branch module';

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= Helpers::test(); ?></h1>

        <p class="lead">Hola Nen!</p>


        <?php
            echo TwitterPlugin::widget([
                'type' => TwitterPlugin::TIMELINE,
                // 'screenName' => '<picked-from-module-or-can-be-set-here>',
                'settings' => ['widget-id' => '<your-widget-id>'],
                'options' => ['height'=>'350', 'width'=>'500']
            ]);
        ?>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">

            </div>
        </div>

    </div>
</div>
