<?php

namespace app\controllers;

use app\components\Helpers;
use app\models\MyActiveRecord;
use Yii;
use app\models\Post;
use app\models\search\PostSearch;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends MyController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','view','update','delete','activate','create'],
                        'roles' => ['updatePost','createPost'],
                    ],
                ]
            ]
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // solo admins pueden ver todos los post. esto es una ñapa, tengo que ver como hacerlo con el user can
        if(!Yii::$app->user->identity->getIsAdmin()){
            $dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->getId()]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Helpers::setFlash('success');
            return $this->redirect(['update', 'id' => $model->post_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // vemos si podemos updatear nuestro propio post
        if(Yii::$app->user->identity->getIsAdmin() || Yii::$app->user->can('updateOwnPost',['post'=>$model]) ){

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Helpers::setFlash('success');
                return $this->redirect(['update', 'id' => $model->post_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }

        }else{
            throw new \yii\web\HttpException(403, 'Forbidden!!');
        }


    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->status = MyActiveRecord::STATUS_DELETED;
        if($model->save()){
            Helpers::setFlash('success');
        }else{
            Helpers::setFlash('danger');
        }

        return $this->redirect(['index']);
    }

    public function actionActivate($id)
    {
        // $this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->status = MyActiveRecord::STATUS_ACTIVE;
        if($model->save()){
            Helpers::setFlash('success');
        }else{
            Helpers::setFlash('danger');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
