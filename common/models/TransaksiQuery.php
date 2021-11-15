<?php

namespace common\models;
use yii2tech\ar\softdelete\SoftDeleteQueryBehavior;

/**
 * This is the ActiveQuery class for [[Transaksi]].
 *
 * @see Transaksi
 */
class TransaksiQuery extends \yii\db\ActiveQuery
{
    public function behaviors()
    {
        return [
            'softDelete' => [
                'class' => SoftDeleteQueryBehavior::className(),
            ],
        ];
    }

    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Transaksi[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Transaksi|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
