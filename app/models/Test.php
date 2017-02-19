<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property int $test_id
 * @property string $test_desc
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_desc'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'test_id' => Yii::t('app', 'Test ID'),
            'test_desc' => Yii::t('app', 'Test Desc'),
        ];
    }
}
