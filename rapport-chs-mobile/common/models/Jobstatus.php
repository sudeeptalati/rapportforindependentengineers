<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "job_status".
 *
 * @property integer $id
 * @property string $name
 * @property string $information
 * @property integer $published
 * @property integer $dropdown_display
 * @property integer $view_order
 * @property integer $dashboard_display
 * @property integer $dashboard_prority_order
 * @property string $html_name
 * @property integer $updated_by_user_id
 * @property string $updated
 * @property string $backgroundcolor
 *
 * @property NotificationRules[] $notificationRules
 */
class Jobstatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'information', 'html_name', 'backgroundcolor'], 'string'],
            [['published', 'dropdown_display', 'view_order', 'dashboard_display', 'dashboard_prority_order', 'updated_by_user_id'], 'integer'],
            [['updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'information' => Yii::t('app', 'Information'),
            'published' => Yii::t('app', 'Published'),
            'dropdown_display' => Yii::t('app', 'Dropdown Display'),
            'view_order' => Yii::t('app', 'View Order'),
            'dashboard_display' => Yii::t('app', 'Dashboard Display'),
            'dashboard_prority_order' => Yii::t('app', 'Dashboard Prority Order'),
            'html_name' => Yii::t('app', 'Html Name'),
            'updated_by_user_id' => Yii::t('app', 'Updated By User ID'),
            'updated' => Yii::t('app', 'Updated'),
            'backgroundcolor' => Yii::t('app', 'Backgroundcolor'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificationRules()
    {
        return $this->hasMany(NotificationRules::className(), ['job_status_id' => 'id']);
    }
}
