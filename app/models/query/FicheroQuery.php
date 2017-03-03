<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Fichero]].
 *
 * @see \app\models\Fichero
 */
class FicheroQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Fichero[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Fichero|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
