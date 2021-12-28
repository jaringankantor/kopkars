<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[HistoriAnggota]].
 *
 * @see HistoriAnggota
 */
class HistoriAnggotaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return HistoriAnggota[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return HistoriAnggota|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
