<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Engineers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="engineer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Engineer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'user_id',
            'wta_member',
            'wta_associate_member',
            // 'wta_membership_number:ntext',
            // 'wta_membership_expiry_date',
            // 'line_1',
            // 'line_2',
            // 'line_3',
            // 'town',
            // 'county',
            // 'postcode_s',
            // 'postcode_e',
            // 'latitude',
            // 'longitude',
            // 'weight',
            // 'email:email',
            // 'phone',
            // 'cell',
            // 'fax',
            // 'on_holiday',
            // 'blurb',
            // 'published',
            // 'ordering',
            // 'web_site',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
