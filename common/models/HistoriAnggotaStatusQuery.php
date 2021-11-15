<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[HistoriAnggotaStatus]].
 *
 * @see HistoriAnggotaStatus
 */
class HistoriAnggotaStatusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return HistoriAnggotaStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return HistoriAnggotaStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
