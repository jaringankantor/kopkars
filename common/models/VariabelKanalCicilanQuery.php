<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[VariabelKanalCicilan]].
 *
 * @see VariabelKanalCicilan
 */
class VariabelKanalCicilanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return VariabelKanalCicilan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return VariabelKanalCicilan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
