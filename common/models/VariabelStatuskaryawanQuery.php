<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[VariabelStatuskaryawan]].
 *
 * @see VariabelStatuskaryawan
 */
class VariabelStatuskaryawanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return VariabelStatuskaryawan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return VariabelStatuskaryawan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
