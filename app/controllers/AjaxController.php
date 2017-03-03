<?php
/**
 * Created by PhpStorm.
 * User: jrey
 * Date: 03/03/2017
 * Time: 12:32
 */

namespace app\controllers;


use app\components\Helpers;
use app\models\Fichero;
use Faker\Provider\File;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class AjaxController extends MyController
{

    private $uploadPath = 'uploads/user/';

    public function init()
    {
        parent::init();
    }

    public function behaviors()
    {
        return [
            /*
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            */
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['file-upload','file-delete'],
                        'roles' => ['updatePost','createPost'],
                    ],
                ]
            ]
        ];
    }

    public function actionIndex(){

    }

    public function actionFileUpload(){

        $error = false;
        $model = new Fichero();
        if($model->load(Yii::$app->request->post())) {

            /* gestionamos el fichero primero */
            $ficheros = UploadedFile::getInstances($model, 'ficheros');

            $dir = $this->uploadPath.Yii::$app->user->id.'/'.$model->tabla_padre.'/'.$model->tabla_padre_id.'/';

            foreach($ficheros as $fichero){
                $ret = Helpers::adjuntoGuardar($fichero,$model,$dir,false,'','',false);
                if($ret===false){
                    $error=true;
                }
            }
        }
        echo json_encode($error);

    }

    public function actionFileDelete(){

        $error = false;

        $id = Yii::$app->request->post('key');

        $model = Fichero::findOne(['fichero_id'=>$id]);
        $model->status = $model::STATUS_DELETED;
        if(!$model->save()){
            $error=true;
        }

        echo json_encode($error);

    }

}