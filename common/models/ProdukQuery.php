<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Produk]].
 *
 * @see Produk
 */
class ProdukQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Produk[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Produk|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
