<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Anggota]].
 *
 * @see Anggota
 */
class AnggotaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Anggota[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Anggota|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
