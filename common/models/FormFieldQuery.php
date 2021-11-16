<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[FormField]].
 *
 * @see FormField
 */
class FormFieldQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return FormField[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FormField|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
