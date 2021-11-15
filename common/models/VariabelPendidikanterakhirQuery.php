<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[VariabelPendidikanterakhir]].
 *
 * @see VariabelPendidikanterakhir
 */
class VariabelPendidikanterakhirQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return VariabelPendidikanterakhir[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return VariabelPendidikanterakhir|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
