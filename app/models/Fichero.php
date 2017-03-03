<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%fichero}}".
 *
 * @property int $fichero_id
 * @property string $tabla_padre
 * @property int $tabla_padre_id
 * @property string $ruta
 * @property string $nombre
 * @property string $extension
 * @property string $ruta_completa
 * @property int $size
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 */
class Fichero extends MyActiveRecord
{

    public $ficheros;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fichero}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tabla_padre_id', 'size', 'created_by', 'created_at', 'updated_at'], 'integer'],
            [['tabla_padre', 'nombre'], 'string', 'max' => 60],
            [['ruta'], 'string', 'max' => 120],
            [['extension'], 'string', 'max' => 5],
            [['ruta_completa'], 'string', 'max' => 180],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fichero_id' => Yii::t('app', 'Fichero ID'),
            'tabla_padre' => Yii::t('app', 'Tabla Padre'),
            'tabla_padre_id' => Yii::t('app', 'Tabla Padre ID'),
            'ruta' => Yii::t('app', 'Ruta'),
            'nombre' => Yii::t('app', 'Nombre'),
            'extension' => Yii::t('app', 'Extension'),
            'ruta_completa' => Yii::t('app', 'Ruta Completa'),
            'size' => Yii::t('app', 'Size'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\query\FicheroQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\FicheroQuery(get_called_class());
    }
}
