<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[VariabelAgama]].
 *
 * @see VariabelAgama
 */
class VariabelAgamaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return VariabelAgama[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return VariabelAgama|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
