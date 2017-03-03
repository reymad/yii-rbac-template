<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->post_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->post_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'post_id',
            'title',
            'description:ntext',
            'lang',
            'created_by',
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return $model->formatDateI18n('created_at',Yii::$app->language);
                },
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    // return $model->formatDate('updated_at',Yii::$app->language);
                    return $model->formatDateI18n('created_at',Yii::$app->language);
                },
            ],
            [
                'attribute' => 'status',
                'format'=>'raw',
                'value' => function($model){

                    $ret = '';
                    if($model->status==$model::STATUS_ACTIVE){
                        $ret = Html::a(Yii::t('app','Borrar'),['delete','id'=>$model->post_id],
                            ['class'=>'btn btn-xs btn-danger btn-block',
                                'data'=>[
                                    'method' => 'post',
                                    'confirm' => 'Are you sure?',
                                    /*'params'=>['id'=>$model->post_id],*/
                                ]
                            ]
                        );
                    }
                    if($model->status==$model::STATUS_DELETED){
                        $ret = Html::a(Yii::t('app','Activar'),['activate','id'=>$model->post_id],
                            ['class'=>'btn btn-xs btn-primary btn-block',
                                'data'=>[
                                    'method' => 'post',
                                    'confirm' => 'Are you sure?',
                                    /*'params'=>['id'=>$model->post_id],*/
                                ]
                            ]
                        );
                    }
                    return $ret;

                }
            ],
        ],
    ]) ?>

</div>
