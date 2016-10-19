<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Dayexpense */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$model->expense_id = $expense_id;
$model->user_id = Yii::$app->user->identity->id;
?>

<div id="dayexpense-form" class="dayexpense-form">

    <h2><span class="fa fa-money"></span> Expenses Details <span class="fa fa-list-ul"></span></h2>

    <?php $form = ActiveForm::begin(); ?>

    <?php
    if ($model->id == NULL || $model->id == '')
        $form->action = 'index.php?r=dayexpense/create&expense_id=' . $expense_id;
    else
        $form->action = 'index.php?r=dayexpense/update&id=' . $model->id . '&expense_id=' . $expense_id;

    ?>



    <?= $form->field($model, 'expense_id')->textInput()->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'user_id')->textInput()->hiddenInput()->label(false); ?>



    <div class=""></div>

    <?= $form->field($model, 'date_of_spend')->widget(DatePicker::className(), ['clientOptions' => ['dateFormat' => 'yy-mm-dd', 'defaultDate' => date('Y-m-d')]])->textInput(['style' => 'width:20%', 'placeholder' => 'Date of Spend']); ?>





    <?= $form->field($model, 'reason')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'spend_for_company')->textInput(['style' => 'width:50%']) ?>

    <?= $form->field($model, 'company_address')->textarea(['rows' => 6]) ?>

    <table style="width: 100%; margin-top:50pxot;">
        <tr>
            <td style="width:33%;">
                <span class="fa fa-motorcycle fa-2x"></span>
                <span class="fa fa-bus fa-2x"></span>
                <span class="fa fa-plane fa-2x"></span>
                <span class="fa fa-taxi fa-2x"></span>
                <span class="fa fa-ship fa-2x"></span>
                <span class="fa fa-subway fa-2x"></span>
                <span class="fa fa-truck fa-2x"></span>
                <span class="fa fa-bicycle fa-2x"></span>
                <span class="fa fa-blind fa-2x"></span>


                <?= $form->field($model, 'travel_mode')->dropDownList(['Bike' => 'Bike', 'Car' => 'Car', 'Taxi/Auto/Cab' => 'Taxi/Auto/Cab', 'Bus' => 'Bus', 'Train' => 'Train', 'Aeroplane' => 'Aeroplane', 'Walk' => 'Walk', 'Bicycle' => 'Bicycle', 'Ferry' => 'Ferry', 'Cruise' => 'Cruise',], ['style' => 'width:80%'])->label(false); ?>
            </td>
            <td style="width:33%;">
                <?= $form->field($model, 'travel_from')->textInput(['style' => 'width:80%']) ?>
            </td>
            <td style="width:33%;">
                <?= $form->field($model, 'travel_to')->textInput(['style' => 'width:80%']) ?>
            </td>

        </tr>
        <tr>
            <td>
                <?= $form->field($model, 'total_travel_expense')->textInput(['style' => 'width:50%']) ?>
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="3">
                <div style="margin-top:50px;">
                    <span class="fa fa-bed fa-2x" aria-hidden="true"></span> <strong>Accomodation Details</strong>
                    <?= $form->field($model, 'accomodation_details')->textarea(['rows' => 6])->label(false); ?>
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <?= $form->field($model, 'accomodation_expense')->textInput(['style' => 'width:50%']) ?>
            </td>
        </tr>

        <tr>
            <td>
                <span class="fa fa-coffee fa-2x aria-hidden=" true""></span> <strong> Breakfast ₹</strong>
                <?= $form->field($model, 'breakfast_expense')->textInput(['style' => 'width:50%'])->label(false); ?>
            </td>
            <td>
                <span class="fa fa-cutlery fa-2x aria-hidden=" true" "></span> <strong> Lunch ₹</strong>
                <?= $form->field($model, 'lunch_expense')->textInput(['style' => 'width:50%'])->label(false); ?>
            </td>
            <td>
                <span class="fa fa-cutlery fa-2x aria-hidden=" true""></span> <strong> Dinner ₹</strong>
                <?= $form->field($model, 'dinner_expense')->textInput(['style' => 'width:50%'])->label(false); ?>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <div style="margin-top:50px;">
                    <span class="fa fa-beer fa-2x" aria-hidden="true"></span>
                    <span class="fa fa-glass fa-2x" aria-hidden="true"></span>
                    <span class="fa fa-trophy fa-2x" aria-hidden="true"></span>

                    <strong>Other Expenses</strong>
                    <?= $form->field($model, 'other_expense_details')->textarea(['rows' => 6])->label(false); ?>
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <?= $form->field($model, 'other_expense_amount')->textInput(['style' => 'width:50%']) ?>
            </td>
        </tr>


    </table>


    <br>
    <hr>

    <?= $form->field($model, 'total_expense')->textInput(['style' => 'width:100%', 'readonly' => 'readonly']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJs("

   $( '#dayexpense-total_travel_expense' ).keyup(function() {
         calculatetotal();
     });
   $( '#dayexpense-accomodation_expense' ).keyup(function() {
         calculatetotal();
     });
   $( '#dayexpense-breakfast_expense' ).keyup(function() {
         calculatetotal();
     });
   $( '#dayexpense-lunch_expense' ).keyup(function() {
         calculatetotal();
     });
   $( '#dayexpense-dinner_expense' ).keyup(function() {
         calculatetotal();
     });
   $( '#dayexpense-other_expense_amount' ).keyup(function() {
         calculatetotal();
     });


");
?>


<script>

    function calculatetotal() {


        console.log('calculatetotal ');

        var travel = document.getElementById("dayexpense-total_travel_expense").value;
        travel = converttoint(travel);
        console.log("Travel : " + travel);

        var accom = document.getElementById("dayexpense-accomodation_expense").value;
        accom = converttoint(accom);
        console.log("accom : " + accom);

        var breakfast = document.getElementById("dayexpense-breakfast_expense").value;
        breakfast = converttoint(breakfast);
        console.log("breakfast : " + breakfast);

        var lunch = document.getElementById("dayexpense-lunch_expense").value;
        lunch = converttoint(lunch);
        console.log("lunch : " + lunch);

        var dinner = document.getElementById("dayexpense-dinner_expense").value;
        dinner = converttoint(dinner);
        console.log("dinner : " + dinner);

        var other = document.getElementById("dayexpense-other_expense_amount").value;
        other = converttoint(other);
        console.log("other : " + other);

        total = travel + accom + breakfast + lunch + dinner + other;
        console.log('calculatetotal ' + total);
        document.getElementById("dayexpense-total_expense").value = total;


    }///end of function calculatetotal(){

    function converttoint(val) {
        if (val != "" || val != null)
            return parseFloat(val) || 0;
        else
            return 0;

    }//end     function converttoint(val)


</script>
