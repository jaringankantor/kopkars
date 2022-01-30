<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PesananPinjaman]].
 *
 * @see PesananPinjaman
 */
class PesananPinjamanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PesananPinjaman[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PesananPinjaman|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
