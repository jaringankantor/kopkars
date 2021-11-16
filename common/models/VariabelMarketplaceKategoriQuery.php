<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[VariabelMarketplaceKategori]].
 *
 * @see VariabelMarketplaceKategori
 */
class VariabelMarketplaceKategoriQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return VariabelMarketplaceKategori[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return VariabelMarketplaceKategori|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
