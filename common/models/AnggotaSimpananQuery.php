<?php

namespace common\models;
use yii2tech\ar\softdelete\SoftDeleteQueryBehavior;

/**
 * This is the ActiveQuery class for [[AnggotaSimpanan]].
 *
 * @see AnggotaSimpanan
 */
class AnggotaSimpananQuery extends \yii\db\ActiveQuery
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
     * @return AnggotaSimpanan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AnggotaSimpanan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
