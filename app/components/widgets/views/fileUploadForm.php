<?php
/**
 * Created by PhpStorm.
 * User: jrey
 * Date: 03/03/2017
 * Time: 11:28
 */
use app\models\Fichero;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\Url;

?>
<?php $form = ActiveForm::begin();

    // kartik doc: http://demos.krajee.com/widget-details/fileinput

    $pluginOptions = [
                            'uploadUrl' => Url::to(['/ajax/file-upload']),
                            'uploadExtraData' => [
                                'Fichero[tabla_padre]'    => $modelPadre->tableName(),
                                'Fichero[tabla_padre_id]' => $modelPadre->getId(),
                                '_csrf'                   => Yii::$app->request->getCsrfToken(),
                            ],
                            'maxFileCount' => 20
                      ];

    // si no e snuevo miramos a aver que haya fotos ya subidas y si es así damos opcion a borrarlas
    $fotos = Fichero::find()->where([
        'tabla_padre'    => $modelPadre->tableName(),
        'tabla_padre_id' => $modelPadre->getId(),
        'status'         => Fichero::STATUS_ACTIVE,
    ])->all();
    // tiene fotos??
    if($fotos){
        $fotosOptions = [
            'initialPreview' => [],
            'initialPreviewConfig'=>[],
            'initialPreviewFileType' => 'image',
            'initialPreviewAsData'=>true,
            'initialCaption'=>"",
            'overwriteInitial'=>false,
            'maxFileSize'=>2800,
            'showPreview' => true,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => true,
            'fileActionSettings' => [
                'showZoom' => true,
                'showUpload' => false,
            ],
        ];
        foreach($fotos as $foto){
            $fotosOptions['initialPreview'][] = $foto->ruta_completa;
            $fotosOptions['initialPreviewConfig'][] = [
                'caption' => $foto->nombre_original,
                'size' => $foto->size,
                'url' => '/ajax/file-delete',
                'id' => $foto->fichero_id,
            ];
        }
        $pluginOptions = \yii\helpers\ArrayHelper::merge($pluginOptions, $fotosOptions);
    }

    // var_dump($pluginOptions);exit;

    echo $form->field($model, 'ficheros[]')->widget(FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
            'multiple' => true,
        ],
        'pluginOptions' => $pluginOptions,

    ]);

 ActiveForm::end(); ?>



