<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Companytype;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\EngineerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Engineers';
$this->params['breadcrumbs'][] = $this->title;



?>
<div class="engineer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Engineer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['style' => "cursor: pointer; ", 'id' => $model['id'], 'onclick' => 'location.href = "index.php?r=engineer/view&id=" + id;'];
        },

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            //'company_type_id',
            [
                'attribute' =>'company_type_id',
                'filter' =>ArrayHelper::map(Companytype::find()->all(), 'id', 'company_type'),
                'value' => function ($data) {
                    return $data->companytype->company_type;
                },
            ],
            'user.username',

            [
                'attribute' =>'wta_member',
                'filter' =>array('0'=>'No','1'=>'Yes'),
                'value' => function ($data) {
                    if ($data->wta_member==0)
                        return "No";
                    else
                        return "Yes";
                },
            ],


            //'wta_member',
            // 'wta_associate_member',
            // 'wta_membership_number:ntext',
            // 'wta_membership_expiry_date',
            // 'line_1',
            // 'line_2',
            // 'line_3',
            'town',
            // 'county',
            // 'postcode_s',
            // 'postcode_e',
            // 'latitude',
            // 'longitude',
            // 'weight',
            'email:email',
            'phone',
            // 'cell',
            // 'fax',
            // 'on_holiday',
            // 'blurb',
            // 'published',
            // 'ordering',
            'web_site',
            // 'unverified_email:email',
            // 'comments:ntext',
            // 'business_principle:ntext',
            // 'staffted_office',
            // 'total_employees',
            // 'total_engineers',
            // 'average_response_time',
            // 'average_turnover',
            // 'company_reg_number',
            // 'vat_number',
            // 'working_premises',
            // 'accept_contracts',
            // 'accept_spot_contracts',
            // 'accounts_contact_person',
            // 'accounts_contact_address:ntext',
            // 'accounts_telephone',
            // 'accounts_email:email',
            // 'created',
            // 'modified',
            // 'phoneclicks',
            // 'enquiryclick',
            // 'impressions',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
