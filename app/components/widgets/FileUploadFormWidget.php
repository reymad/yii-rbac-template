<?php

/**
 * Created by PhpStorm.
 * User: jrey
 * Date: 03/03/2017
 * Time: 11:27
 */
namespace app\components\widgets;

use app\models\Fichero;
use yii\base\Widget;

class FileUploadFormWidget extends Widget
{

    public $uploadController = 'fichero';
    public $model;// modelo fichero
    public $modelPadre;// modelo fichero

    public function init()
    {
        parent::init();
        $this->model = new Fichero();
    }

    public function run()
    {
        return $this->render('fileUploadForm',[
            'model' => $this->model,
            'modelPadre' => $this->modelPadre,
        ]);
    }
}