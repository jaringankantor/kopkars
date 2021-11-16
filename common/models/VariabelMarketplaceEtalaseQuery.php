<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[VariabelMarketplaceEtalase]].
 *
 * @see VariabelMarketplaceEtalase
 */
class VariabelMarketplaceEtalaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return VariabelMarketplaceEtalase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return VariabelMarketplaceEtalase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
