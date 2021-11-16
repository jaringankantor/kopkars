<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[SettingMarketplaceEtalase]].
 *
 * @see SettingMarketplaceEtalase
 */
class SettingMarketplaceEtalaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SettingMarketplaceEtalase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SettingMarketplaceEtalase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
