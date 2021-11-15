<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[DbpegawaiPubPegawai]].
 *
 * @see DbpegawaiPubPegawai
 */
class DbpegawaiPubPegawaiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return DbpegawaiPubPegawai[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DbpegawaiPubPegawai|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
