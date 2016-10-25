<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Emailservicecall form
 */
class Emailservicecall extends Model
{
    public $email;
    public $servicecall_id;
    public $subject;
    public $jobsheet= true;
    public $invoice= false;





    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'servicecall_id'], 'required'],
            [['email'], 'email'],
            [['servicecall_id'], 'integer'],
            ['jobsheet', 'boolean'],
            ['invoice', 'boolean'],

        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'Email'),
            'subject' => Yii::t('app', 'Subject'),
            'invoice' => Yii::t('app', 'Invoice'),
            'jobsheet' => Yii::t('app', 'Job Sheet'),

        ];
    }


}
