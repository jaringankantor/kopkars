<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[VariabelStatus]].
 *
 * @see VariabelStatus
 */
class VariabelStatusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return VariabelStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return VariabelStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
