<?php

use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fichero_id')->textInput() ?>

    <?php
        // echo $form->field($model, 'lang')->listBox(['es-ES'=>'Español','en-US'=>'English'])
        // echo Html::activeDropDownList($model, 'lang',['es-ES'=>'Español','en-US'=>'English']);
        $model->lang = Yii::$app->language;
        echo $form->field($model, 'lang')->widget(Select2::classname(), [
            'data' => ['es-ES'=>'Español','en-US'=>'English'],
            'language' => Yii::$app->language,
            'options' => ['placeholder' => $model->getAttributeLabel('lang')],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
