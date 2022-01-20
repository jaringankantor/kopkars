<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[HistoriCicilan]].
 *
 * @see HistoriCicilan
 */
class HistoriCicilanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return HistoriCicilan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return HistoriCicilan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
