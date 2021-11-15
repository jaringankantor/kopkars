<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[VariabelUnit]].
 *
 * @see VariabelUnit
 */
class VariabelUnitQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return VariabelUnit[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return VariabelUnit|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
