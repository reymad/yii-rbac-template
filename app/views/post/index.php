<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'description:ntext',
            'lang',
            'created_by',
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
            [
                'label' => 'photos',
                'format'=>'raw',
                'value' => function($model){

                    if(isset($model->ficheros) && is_array($model->ficheros)){
                        return count($model->ficheros);
                    }else{
                        return 0;
                    }
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
