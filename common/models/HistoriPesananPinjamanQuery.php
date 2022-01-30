<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[HistoriPesananPinjaman]].
 *
 * @see HistoriPesananPinjaman
 */
class HistoriPesananPinjamanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return HistoriPesananPinjaman[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return HistoriPesananPinjaman|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
