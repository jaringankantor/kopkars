<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[SettingMarketplace]].
 *
 * @see SettingMarketplace
 */
class SettingMarketplaceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SettingMarketplace[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SettingMarketplace|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
