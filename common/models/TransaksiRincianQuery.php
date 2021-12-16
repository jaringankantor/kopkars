<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TransaksiRincian]].
 *
 * @see TransaksiRincian
 */
class TransaksiRincianQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TransaksiRincian[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TransaksiRincian|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
