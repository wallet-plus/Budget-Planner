<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Reminders]].
 *
 * @see Reminders
 */
class RemindersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Reminders[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Reminders|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
