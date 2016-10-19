<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Engineerpostcodes]].
 *
 * @see Engineerpostcodes
 */
class EngineerpostcodesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Engineerpostcodes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Engineerpostcodes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
