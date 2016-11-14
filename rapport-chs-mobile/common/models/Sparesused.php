<?php

namespace common\models;

use Yii;

use common\models\Masteritems;

/**
 * This is the model class for table "spares_used".
 *
 * @property integer $id
 * @property integer $master_item_id
 * @property integer $servicecall_id
 * @property string $item_name
 * @property string $part_number
 * @property double $unit_price
 * @property integer $quantity
 * @property double $total_price
 * @property string $date_ordered
 * @property string $created
 * @property string $modified
 * @property integer $created_by_user
 * @property integer $used
 * @property string $notes
 */
class Sparesused extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spares_used';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['master_item_id', 'servicecall_id', 'quantity', 'item_name'], 'required'],

            [['master_item_id', 'servicecall_id', 'quantity', 'created_by_user', 'used'], 'integer'],
            [['item_name', 'part_number', 'notes'], 'string'],
            [['unit_price', 'total_price'], 'number'],
            [['date_ordered', 'created', 'modified'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'master_item_id' => Yii::t('app', 'Master Item ID'),
            'servicecall_id' => Yii::t('app', 'Servicecall ID'),
            'item_name' => Yii::t('app', 'Item Name'),
            'part_number' => Yii::t('app', 'Part Number'),
            'unit_price' => Yii::t('app', 'Unit Price'),
            'quantity' => Yii::t('app', 'Quantity'),
            'total_price' => Yii::t('app', 'Total Price'),
            'date_ordered' => Yii::t('app', 'Date Ordered'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
            'created_by_user' => Yii::t('app', 'Created By User'),
            'used' => Yii::t('app', 'Used'),
            'notes' => Yii::t('app', 'Notes'),
        ];
    }


    public static function loadallsparesbyservicecallid($service_id)
    {
        return self::findAll(['servicecall_id'=>$service_id]);
    }///end of public function loadalldocumentsbyservicecallid($service_id)


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicecall()
    {
        return $this->hasOne(Servicecall::className(), ['id' => 'servicecall_id']);
    }




    public function beforeSave($insert)
    {



      if ($this->master_item_id==0)
      {
        $master_db_item=new Masteritems();
        ////Insert record in master Item dataabse
        $master_db_item->part_number=$this->part_number;
        $master_db_item->name=$this->item_name;
        $master_db_item->active='1';
        $master_db_item->created=time();
      }
      else {
          ///Just update price in master item database
          $master_db_item=Masteritems::findOne($this->master_item_id);
      }

      $master_db_item->sale_price=$this->unit_price;

      if ($master_db_item->save())
      {
        $this->master_item_id=$master_db_item->id;
        return true;
      }
      else {
        echo "Problem in saving master item";
        return false;
      }

    }////end of   public function beforeSave($insert,$changedAttributes)


}////end of class
