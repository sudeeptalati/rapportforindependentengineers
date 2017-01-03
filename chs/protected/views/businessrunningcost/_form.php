<?php
/* @var $this BusinessrunningcostController */
/* @var $model Businessrunningcost */
/* @var $form CActiveForm */
?>

    <div class="form">

        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'businessrunningcost-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
        )); ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

        <table style="width: 100%">
            <tr>
                <td style="width: 45%">  <?php echo $form->labelEx($model, 'cost_of'); ?></td>
                <td style="width: 15%">  <?php echo $form->labelEx($model, 'monthly_cost'); ?></td>
                <td style="width: 10%">  <?php echo $form->labelEx($model, 'daily_cost'); ?></td>
                <td style="width: 15%">  <?php echo $form->labelEx($model, 'weekly_cost'); ?> </td>
                <td style="width: 15%">  <?php echo $form->labelEx($model, 'yearly_cost'); ?></td>
            </tr>
            <tr>
                <td>
                    <div class="row">

                        <?php echo CHtml::textField('cost_of', $model->cost_of, array('id' => 'cost_of', 'style' => 'width: 80%;')); ?>
                        <?php echo $form->textField($model, 'cost_of', array('style' => 'width: 80%;', 'readonly' => 'readonly')); ?>
                        <?php echo $form->error($model, 'cost_of'); ?>
                    </div>
                </td>

                <td>

                    <div class="row">

                        <?php echo CHtml::textField('monthly_cost', '', array('id' => 'monthly_cost', 'style' => 'width: 80%;')); ?>
                        <?php echo $form->textField($model, 'monthly_cost', array('style' => 'width: 80%;', 'readonly' => 'readonly')); ?>
                        <?php echo $form->error($model, 'monthly_cost'); ?>
                    </div>
                </td>


                <td>
                    <div class="row">

                        <?php echo CHtml::textField('daily_cost', '', array('id' => 'daily_cost', 'style' => 'width: 80%;')); ?>
                        <?php echo $form->textField($model, 'daily_cost', array('style' => 'width: 80%;', 'readonly' => 'readonly')); ?>
                        <?php echo $form->error($model, 'daily_cost'); ?>
                    </div>

                </td>
                <td>

                    <div class="row">

                        <?php echo CHtml::textField('weekly_cost', '', array('id' => 'weekly_cost', 'style' => 'width: 80%;')); ?>
                        <?php echo $form->textField($model, 'weekly_cost', array('style' => 'width: 80%;', 'readonly' => 'readonly')); ?>
                        <?php echo $form->error($model, 'weekly_cost'); ?>
                    </div>
                </td>





                <td>


                    <div class="row">

                        <?php echo CHtml::textField('yearly_cost', '', array('id' => 'yearly_cost', 'style' => 'width: 80%;')); ?>
                        <?php echo $form->textField($model, 'yearly_cost', array('style' => 'width: 80%;', 'readonly' => 'readonly')); ?>
                        <?php echo $form->error($model, 'yearly_cost'); ?>
                    </div>
                </td>


            </tr>
        </table>


        <div class="row buttons right">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Add Below' : 'Update', array('class' => 'btn btn-info')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->


    <ul class="note">
        Based on Parameters

        <li>1 Year  =  12 months = 52 Weeks = 365 Days</li>
    </ul>


    <script>


        $("#cost_of").keyup(function () {
            var cost_of = $("#cost_of").val();

            console.log('cost_of' + cost_of);

            $("#Businessrunningcost_cost_of").val(cost_of);
        });


        $("#daily_cost").keyup(function () {
            var daily_cost = $("#daily_cost").val();

            var weekly_cost = daily_cost * 7;
            var monthly_cost = daily_cost * 31;
            var yearly_cost = daily_cost * 365;

            updatedailyweeklymonthlyyearlycost(daily_cost, weekly_cost, monthly_cost, yearly_cost);
        });


        $("#weekly_cost").keyup(function () {
            var weekly_cost = $("#weekly_cost").val();

            var daily_cost = weekly_cost / 7;
            var monthly_cost = weekly_cost * 4.42;
            var yearly_cost = weekly_cost * 52.14;


            updatedailyweeklymonthlyyearlycost(daily_cost, weekly_cost, monthly_cost, yearly_cost);
        });


        $("#monthly_cost").keyup(function () {
            var monthly_cost = $("#monthly_cost").val();

            var daily_cost = monthly_cost / 31;
            var weekly_cost = monthly_cost / 4.34;
            var yearly_cost = monthly_cost * 12;
            updatedailyweeklymonthlyyearlycost(daily_cost, weekly_cost, monthly_cost, yearly_cost);
        });


        $("#yearly_cost").keyup(function () {
            var yearly_cost = $("#yearly_cost").val();

            var daily_cost = yearly_cost / 365;
            var weekly_cost = yearly_cost / 52;
            var monthly_cost = yearly_cost / 12;
            updatedailyweeklymonthlyyearlycost(daily_cost, weekly_cost, monthly_cost, yearly_cost);
        });


        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        function updatedailyweeklymonthlyyearlycost(daily_cost, weekly_cost, monthly_cost, yearly_cost) {

            console.log('daily_cost' + daily_cost);
            console.log('weekly_cost' + weekly_cost);
            console.log('monthly_cost' + monthly_cost);
            console.log('yearly_cost' + yearly_cost);


            daily_cost = parseFloat(Math.round(daily_cost * 100) / 100).toFixed(2);
            weekly_cost = parseFloat(Math.round(weekly_cost * 100) / 100).toFixed(2);
            monthly_cost = parseFloat(Math.round(monthly_cost * 100) / 100).toFixed(2);
            yearly_cost = parseFloat(Math.round(yearly_cost * 100) / 100).toFixed(2);

            $("#Businessrunningcost_daily_cost").val(daily_cost);
            $("#Businessrunningcost_weekly_cost").val(weekly_cost);
            $("#Businessrunningcost_monthly_cost").val(monthly_cost);
            $("#Businessrunningcost_yearly_cost").val(yearly_cost);


        }///end of function updatedailyweeklymonthlyyearlycost()


    </script>


<?php $this->renderPartial('index'); ?>