<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\jui\DatePicker;



/* @var $this yii\web\View */
/* @var $model frontend\models\Engineer */
/* @var $form yii\widgets\ActiveForm */
?>







<div class="engineer-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'published')->dropDownList(['0'=>'No','1'=>'Yes']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wta_member')->dropDownList(['0'=>'No', '1'=>'Yes']) ?>

    <?= $form->field($model, 'wta_membership_number')->textarea(['rows' => 6]) ?>



    <?= $form->field($model,'wta_membership_expiry_date')->widget(DatePicker::className(),['clientOptions' => [ 'dateFormat'=>'yy-mm-dd','defaultDate' => date('Y-m-d')]])->textInput(['placeholder' => 'Wta membership Expiry Date']) ?>

    <?= Html::textInput('postcode-lookup','',['id'=>'postcode-lookup', 'style'=>'width:300px;height:40px;', 'placeholder'=>'Please type your full postcode']) ?>
    <div style="color:darkred;" id="engineer-postcode-error"> </div>

    <?= $form->field($model, 'line_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'line_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'line_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'town')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'county')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'postcode_s')->textInput(['maxlength' => true, 'readonly' => 'readonly' ]) ?>

    <?= $form->field($model, 'postcode_e')->textInput(['maxlength' => true, 'readonly' => 'readonly' ]) ?>

    <?= $form->field($model, 'latitude')->textInput(['readonly' => 'readonly']) ?>

    <?= $form->field($model, 'longitude')->textInput(['readonly' => 'readonly']) ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cell')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'on_holiday')->textInput()->dropDownList(['0'=>'No','1'=>'Yes']) ?>

    <?= $form->field($model, 'blurb')->textInput(['maxlength' => true]) ?>


     <?= $form->field($model, 'web_site')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unverified_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'business_principle')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'staffted_office')->textInput() ?>

    <?= $form->field($model, 'total_employees')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_engineers')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'average_response_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'average_turnover')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_reg_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vat_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'working_premises')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accept_contracts')->textInput() ?>

    <?= $form->field($model, 'accept_spot_contracts')->textInput() ?>

    <?= $form->field($model, 'accounts_contact_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accounts_contact_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'accounts_telephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accounts_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rapport_chs_url')->textInput() ?>

    <?= $form->field($model, 'rapport_api_key')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>





<?php
$this->registerJs('

    $( "#postcode-lookup" ).keyup(function() {
        pc=$("#postcode-lookup" ).val();
        $("#postcode-lookup" ).val(pc.toUpperCase());

        check_postcode_on_google_for_engineer(pc);

    });


    function check_postcode_on_google_for_engineer(postcode)
    {
        postcode=postcode.replace(/ /g,"")

        postcodelookup_url="https://maps.googleapis.com/maps/api/geocode/json?address="+postcode+"&key='.Yii::$app->params['google_maps_api_key'].'";

        console.log(postcodelookup_url);

        $.get( postcodelookup_url, function( data ) {
            update_address_for_engineer(data);
        }, "json" )
        .fail(function(data) {
                show_error(data);
         });

    }///end of function verifypostcode(postcode)

    function update_address_for_engineer(google_data)
    {
        if (google_data.status=="OK")
        {
            console.log(google_data.results[0].address_components[0].long_name);
            console.log(google_data.results[0].address_components[3].long_name);

            town=google_data.results[0].address_components[3].long_name;
            line2=google_data.results[0].address_components[1].long_name;
            console.log("Line 2"+line2);

            lat=google_data.results[0].geometry.location.lat;
            lng=google_data.results[0].geometry.location.lng;

            google_postcode_format=google_data.results[0].address_components[0].long_name;

            postcode_array=google_postcode_format.split(" ");
            $("#engineer-postcode_s" ).val(postcode_array[0]);
            $("#engineer-postcode_e" ).val(postcode_array[1]);
            $("#engineer-line_2" ).val(line2);
            $("#engineer-town" ).val(town);
            $("#engineer-latitude" ).val(lat);
            $("#engineer-longitude" ).val(lng);




            clear_error();
        }else
        {

            show_error(google_data);
        }

    }///end of function verify_postcode(google_data)


    function show_error(google_data)
    {
        console.log("ERROR");
        html_error_output="Please Enter a Valid Postcode<br>Error:"+google_data.status;
        $("#engineer-postcode-error" ).html(html_error_output);
         $("#engineer-postcode_s" ).val("");
         $("#engineer-postcode_e" ).val("");
         $("#engineer-town" ).val("");

    }

    function clear_error()
    {
        $("#engineer-postcode-error" ).html("");

    }





');

?>

