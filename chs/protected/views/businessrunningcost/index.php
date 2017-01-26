<div id="sidemenu">
    <?php include('setup_sidemenu.php'); ?>
</div>
<style>
    .running_cost_title{
        font-size: 20px;
        padding: 5px 0px 20px 20px;

    }
    .running_cost{
        font-size: 20px;
        font-weight: 200;
        letter-spacing: 2px;
    }

    .income{

        background-color: #D1FDD2;
        color: #006300;
    }

    .expense{

        background-color: #F1D7D7;
        color: #F15F4A;
    }



</style>


<div class="infotooltip"><h4>Contract Value Calculator &nbsp;&nbsp;<i class="fa fa-info-circle" aria-hidden="true"></i></h4>

    <span class="infotooltiptext">

        The contract value calculator is a clever program designed to calculate value of the contract you are offered.
        The more value is input in the contract, more accurate will be results. The contract takes into considerations all business runnning costs
         and then calculates various KPIs.

    </span>
</div>

<h1>
    <?php echo CHtml::link('Business Running Costs','index.php?r=businessrunningcost/index',array('class'=>''));?>


</h1>

<table>
    <?php $total_running_cost_array=Businessrunningcost::model()->get_total_business_running_cost();?>
    <?php $monthly_no_of_calls=Businessrunningcost::model()->get_total_no_of_servicecalls_in_last_30days();?>
    <?php $monthly_business_cost=$total_running_cost_array['monthly_cost'];?>
    <?php $current_cost_per_call=Businessrunningcost::model()->get_cost_per_call($monthly_business_cost,$monthly_no_of_calls);?>


    <tr>
        <th>Daily</th>
        <th>Weekly</th>
        <th>Monthly</th>
        <th>Yearly</th>
    </tr>
    <tr>

        <td class="running_cost">£ <?php echo number_format ( $total_running_cost_array['daily_cost'], 2, '.', ','); ?></td>
        <td class="running_cost">£ <?php echo number_format ( $total_running_cost_array['weekly_cost'], 2, '.', ','); ?></td>
        <td class="running_cost">£ <?php echo number_format ( $total_running_cost_array['monthly_cost'], 2, '.', ','); ?></td>
        <td class="running_cost">£ <?php echo number_format ( $total_running_cost_array['yearly_cost'], 2, '.', ','); ?></td>
    </tr>
    <tr>
        <td colspan="5">
            <br>
        </td>
    </tr>

    <tr>
        <th>
            No of Calls in Last 30 days
        </th>
        <td class="running_cost">
            <?php echo $monthly_no_of_calls?>
        </td>
    </tr>
    <tr>
        <th>
            <hr>
            Cost Per call
        </th>
        <td class="running_cost">
            <hr>
            £ <?php echo number_format ( $current_cost_per_call, 2, '.', ','); ?>
        </td>
    </tr>

</table>







<?php
/* @var $this BusinessrunningcostController */
/* @var $dataProvider CActiveDataProvider */
$model=new Businessrunningcost('search');

?>



<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'businessrunningcost-grid',

    'selectableRows'=>1,
    'selectionChanged'=>'function(id){ location.href = "'.$this->createUrl('update').'/id/"+$.fn.yiiGridView.getSelection(id);}',


    'dataProvider'=>$model->loadallcosts(),
    'filter'=>$model,
    'columns'=>array(

        /*
         id',
        'cost_of',
        'weekly_cost',
        'monthly_cost',
        'yearly_cost',
        'daily_cost',
        */
        array(
            'name'=>'cost_of',
            'filter'=>false,
        ),
        array(
            'name'=>'daily_cost',
            'filter'=>false,
        ),
        array(
            'name'=>'weekly_cost',
            'filter'=>false,
        ),
        array(
            'name'=>'monthly_cost',
            'filter'=>false,
        ),

        array(
            'name'=>'yearly_cost',
            'filter'=>false,
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}{update}',
        ),
    ),
)); ?>

<div style="float:right;">
    <?php echo CHtml::link('Add more costs','index.php?r=businessrunningcost/create',array('class'=>'btn btn-success'));?>
</div>



<h2>Contract Calculator</h2>
<div id="contract_calculator_div">

<table>



    <tr>
        <th colspan="2">
            <button class="btn btn-primary" onclick="calculate_contract_value();">
                Calculate or Hit the return Key ⏎
            </button>
        </th>
    </tr>



    <tr>
        <th>Items</th>
        <th>Rate</th>
    </tr>


    <tr>
        <th colspan="2">
            <h3>Cost per Call</h3>
        </th>
    </tr>

    <tr>
        <td class="running_cost">Current Cost Per Call</td>

        <td> <?php echo CHtml::numberField('current_cost_per_call', $current_cost_per_call, array('id' => 'current_cost_per_call', 'style' => 'width: 80%;')); ?></td>
    </tr>

    <tr>
        <th colspan="2"><h3>Labour Rates</h3></th>
    </tr>

    <tr>
        <td class="running_cost"> Labour Rate (Primary)</td>
        <td> <?php echo CHtml::numberField('primary_labour_rate_per_call', '0', array('id' => 'primary_labour_rate_per_call', 'style' => 'width: 80%;')); ?></td>
    </tr>

    <tr>
        <td class="running_cost"> Labour Rate (Secondary) - Insurance</td>
        <td> <?php echo CHtml::numberField('secondary_labour_rate_per_call', '0', array('id' => 'secondary_labour_rate_per_call', 'style' => 'width: 80%;')); ?></td>
    </tr>

    <tr>
        <td class="running_cost"> Labour Rate (Tertiary) - Charge</td>
        <td> <?php echo CHtml::numberField('tertiary_labour_rate_per_call', '0', array('id' => 'tertiary_labour_rate_per_call', 'style' => 'width: 80%;')); ?></td>
    </tr>


    <tr>
        <th colspan="2"><h3>No of Calls </h3></th>
    </tr>

    <tr>
        <th></th>
        <th>Weekly</th>
        <th>Monthly</th>
        <th>Annually</th>
    </tr>
    <tr>
        <td class="running_cost">Projected number of calls (Primary)</td>
        <td> <?php echo CHtml::numberField('primary_no_of_calls_weekly', '0', array('id' => 'primary_no_of_calls_weekly', 'style' => 'width: 80%;')); ?></td>
        <td> <?php echo CHtml::numberField('primary_no_of_calls_monthly', '0', array('id' => 'primary_no_of_calls_monthly', 'style' => 'width: 80%;')); ?></td>
        <td> <?php echo CHtml::numberField('primary_no_of_calls_yearly', '0', array('id' => 'primary_no_of_calls_yearly', 'style' => 'width: 80%;')); ?></td>
        <script>

            $( "#primary_no_of_calls_weekly" ).keyup(function() {
                primary_no_of_calls_weekly=this.value;

                primary_no_of_calls_monthly=primary_no_of_calls_weekly*4.33;
                $( "#primary_no_of_calls_monthly" ).val(primary_no_of_calls_monthly);

                primary_no_of_calls_yearly=primary_no_of_calls_weekly*52;
                $( "#primary_no_of_calls_yearly" ).val(primary_no_of_calls_yearly);
            });


            $( "#primary_no_of_calls_monthly" ).keyup(function() {
                primary_no_of_calls_monthly=this.value;

                primary_no_of_calls_weekly=primary_no_of_calls_monthly/4;
                $( "#primary_no_of_calls_weekly" ).val(primary_no_of_calls_weekly);

                primary_no_of_calls_yearly=primary_no_of_calls_monthly*12;
                $( "#primary_no_of_calls_yearly" ).val(primary_no_of_calls_yearly);
            });



            $( "#primary_no_of_calls_yearly" ).keyup(function() {
                primary_no_of_calls_yearly=this.value;

                primary_no_of_calls_weekly=primary_no_of_calls_yearly/52;
                $( "#primary_no_of_calls_weekly" ).val(primary_no_of_calls_weekly);

                primary_no_of_calls_monthly=primary_no_of_calls_yearly/12;
                $( "#primary_no_of_calls_monthly" ).val(primary_no_of_calls_monthly);
            });

        </script>


    </tr>
    <tr>
        <td class="running_cost">Projected number of calls (Secondary)</td>
        <td> <?php echo CHtml::numberField('secondary_no_of_calls_weekly', '0', array('id' => 'secondary_no_of_calls_weekly', 'style' => 'width: 80%;')); ?></td>
        <td> <?php echo CHtml::numberField('secondary_no_of_calls_monthly', '0', array('id' => 'secondary_no_of_calls_monthly', 'style' => 'width: 80%;')); ?></td>
        <td> <?php echo CHtml::numberField('secondary_no_of_calls_yearly', '0', array('id' => 'secondary_no_of_calls_yearly', 'style' => 'width: 80%;')); ?></td>
        <script>

            $( "#secondary_no_of_calls_weekly" ).keyup(function() {
                secondary_no_of_calls_weekly=this.value;

                secondary_no_of_calls_monthly=secondary_no_of_calls_weekly*4.33;
                $( "#secondary_no_of_calls_monthly" ).val(secondary_no_of_calls_monthly);

                secondary_no_of_calls_yearly=secondary_no_of_calls_weekly*52;
                $( "#secondary_no_of_calls_yearly" ).val(secondary_no_of_calls_yearly);
            });


            $( "#secondary_no_of_calls_monthly" ).keyup(function() {
                secondary_no_of_calls_monthly=this.value;

                secondary_no_of_calls_weekly=secondary_no_of_calls_monthly/4;
                $( "#secondary_no_of_calls_weekly" ).val(secondary_no_of_calls_weekly);

                secondary_no_of_calls_yearly=secondary_no_of_calls_monthly*12;
                $( "#secondary_no_of_calls_yearly" ).val(secondary_no_of_calls_yearly);
            });



            $( "#secondary_no_of_calls_yearly" ).keyup(function() {
                secondary_no_of_calls_yearly=this.value;

                secondary_no_of_calls_weekly=secondary_no_of_calls_yearly/52;
                $( "#secondary_no_of_calls_weekly" ).val(secondary_no_of_calls_weekly);

                secondary_no_of_calls_monthly=secondary_no_of_calls_yearly/12;
                $( "#secondary_no_of_calls_monthly" ).val(secondary_no_of_calls_monthly);
            });

        </script>


    </tr>
    <tr>
        <td class="running_cost">Projected number of calls (Tertiary)</td>
        <td> <?php echo CHtml::numberField('tertiary_no_of_calls_weekly', '0', array('id' => 'tertiary_no_of_calls_weekly', 'style' => 'width: 80%;')); ?></td>
        <td> <?php echo CHtml::numberField('tertiary_no_of_calls_monthly', '0', array('id' => 'tertiary_no_of_calls_monthly', 'style' => 'width: 80%;')); ?></td>
        <td> <?php echo CHtml::numberField('tertiary_no_of_calls_yearly', '0', array('id' => 'tertiary_no_of_calls_yearly', 'style' => 'width: 80%;')); ?></td>

        <script>

            $( "#tertiary_no_of_calls_weekly" ).keyup(function() {
                tertiary_no_of_calls_weekly=this.value;

                tertiary_no_of_calls_monthly=tertiary_no_of_calls_weekly*4.33;
                $( "#tertiary_no_of_calls_monthly" ).val(tertiary_no_of_calls_monthly);

                tertiary_no_of_calls_yearly=tertiary_no_of_calls_weekly*52;
                $( "#tertiary_no_of_calls_yearly" ).val(tertiary_no_of_calls_yearly);
            });


            $( "#tertiary_no_of_calls_monthly" ).keyup(function() {
                tertiary_no_of_calls_monthly=this.value;

                tertiary_no_of_calls_weekly=tertiary_no_of_calls_monthly/4;
                $( "#tertiary_no_of_calls_weekly" ).val(tertiary_no_of_calls_weekly);

                tertiary_no_of_calls_yearly=tertiary_no_of_calls_monthly*12;
                $( "#tertiary_no_of_calls_yearly" ).val(tertiary_no_of_calls_yearly);
            });



            $( "#tertiary_no_of_calls_yearly" ).keyup(function() {
                tertiary_no_of_calls_yearly=this.value;

                tertiary_no_of_calls_weekly=tertiary_no_of_calls_yearly/52;
                $( "#tertiary_no_of_calls_weekly" ).val(tertiary_no_of_calls_weekly);

                tertiary_no_of_calls_monthly=tertiary_no_of_calls_yearly/12;
                $( "#tertiary_no_of_calls_monthly" ).val(tertiary_no_of_calls_monthly);
            });

        </script>



    </tr>


    <tr>
        <td colspan="4"><br></td>
    </tr>

    <tr>
        <td class="running_cost">Projected calls not completed first time (%)</td>
        <td> <?php echo CHtml::numberField('first_time_fix_failure_percentage', '40', array('id' => 'first_time_fix_failure_percentage', 'style' => 'width: 80%;')); ?></td>
    </tr>
    <tr class="expense">
        <td class="running_cost_title"><span>Total cost of calls</span></td>
        <td class="running_cost"><div id="weekly_cost_of_calls"></div></td>
        <td class="running_cost"><div id="monthly_cost_of_calls"></div></td>
        <td class="running_cost"><div id="yearly_cost_of_calls"></div></td>
    </tr>


    <tr class="income">
        <td class="running_cost_title"><span>Total income from calls</span></td>
        <td class="running_cost"><div id="weekly_income_from_calls"></div></td>
        <td class="running_cost"><div id="monthly_income_from_calls"></div></td>
        <td class="running_cost"><div id="yearly_income_from_calls"></div></td>
    </tr>


    <tr class="expense">
        <td class="running_cost_title"><span> Loss on non-first fixes</span></td>
        <td class="running_cost"><div id="weekly_loss_from_non_first_fixes"></div></td>
        <td class="running_cost"><div id="monthly_loss_from_non_first_fixes"></div></td>
        <td class="running_cost"><div id="yearly_loss_from_non_first_fixes"></div></td>
    </tr>




    <tr>
        <th colspan="2"><h3>Spares</h3></th>
    </tr>


    <tr>
        <td class="running_cost">Initial van/base stock cost (total)</td>
        <td colspan="2"> <?php echo CHtml::textField('initial_van_stock', '0', array('id' => 'initial_van_stock', 'style' => 'width: 80%;')); ?></td>
    </tr>

    <tr>
        <td class="running_cost">Spares Margin (%) </td>
        <td> <?php echo CHtml::textField('profit_margin_percentage_for_spares', '0', array('id' => 'profit_margin_percentage_for_spares', 'style' => 'width: 80%;')); ?></td>
    </tr>



    <tr>
        <td class="running_cost">Spares Cost/Use (Average)</td>
        <td> <?php echo CHtml::numberField('cost_of_spares_used_weekly', '0', array('id' => 'cost_of_spares_used_weekly', 'style' => 'width: 80%;')); ?></td>
        <td> <?php echo CHtml::numberField('cost_of_spares_used_monthly', '0', array('id' => 'cost_of_spares_used_monthly', 'style' => 'width: 80%;')); ?></td>
        <td> <?php echo CHtml::numberField('cost_of_spares_used_yearly', '0', array('id' => 'cost_of_spares_used_yearly', 'style' => 'width: 80%;')); ?></td>

        <script>

            $( "#cost_of_spares_used_weekly" ).keyup(function() {
                cost_of_spares_used_weekly=this.value;

                cost_of_spares_used_monthly=cost_of_spares_used_weekly*4.33;
                $( "#cost_of_spares_used_monthly" ).val(cost_of_spares_used_monthly);

                cost_of_spares_used_yearly=cost_of_spares_used_weekly*52;
                $( "#cost_of_spares_used_yearly" ).val(cost_of_spares_used_yearly);
            });


            $( "#cost_of_spares_used_monthly" ).keyup(function() {
                cost_of_spares_used_monthly=this.value;

                cost_of_spares_used_weekly=cost_of_spares_used_monthly/4;
                $( "#cost_of_spares_used_weekly" ).val(cost_of_spares_used_weekly);

                cost_of_spares_used_yearly=cost_of_spares_used_monthly*12;
                $( "#cost_of_spares_used_yearly" ).val(cost_of_spares_used_yearly);
            });



            $( "#cost_of_spares_used_yearly" ).keyup(function() {
                cost_of_spares_used_yearly=this.value;

                cost_of_spares_used_weekly=cost_of_spares_used_yearly/52;
                $( "#cost_of_spares_used_weekly" ).val(cost_of_spares_used_weekly);

                cost_of_spares_used_monthly=cost_of_spares_used_yearly/12;
                $( "#cost_of_spares_used_monthly" ).val(cost_of_spares_used_monthly);
            });

        </script>


    </tr>







    <tr>
        <td class="running_cost">Days Credit </td>
        <td> <?php echo CHtml::numberField('no_of_days_credit_for_spares', '0', array('id' => 'no_of_days_credit_for_spares', 'style' => 'width: 80%;')); ?></td>
    </tr>



    <tr>
        <td class="running_cost">Stock Write Down (%)</td>
        <td> <?php echo CHtml::numberField('stock_write_down_percentage', '10', array('id' => 'stock_write_down_percentage', 'style' => 'width: 80%;')); ?></td>
    </tr>

    <tr class="income">
        <td class="running_cost_title"><span>Spares Profit</span></td>
        <td class="running_cost"><div id="weekly_profit_from_spares"></div></td>
        <td class="running_cost"><div id="monthly_profit_from_spares"></div></td>
        <td class="running_cost"><div id="yearly_profit_from_spares"></div></td>
    </tr>

    <tr class="expense">
        <td class="running_cost_title"><span>Total Rolling Spares Liability</span></td>
        <td class="running_cost"><div id="weekly_rolling_spares_liability"></div></td>
        <td class="running_cost"><div id="monthly_rolling_spares_liability"></div></td>
        <td class="running_cost"><div id="yearly_rolling_spares_liability"></div></td>
    </tr>


    <tr class="expense">
        <td class="running_cost_title"><span>Total Stock Write Down</span></td>
        <td class="running_cost"><div id="weekly_stock_write_down"></div></td>
        <td class="running_cost"><div id="monthly_stock_write_down"></div></td>
        <td class="running_cost"><div id="yearly_stock_write_down"></div></td>
    </tr>




    <tr>
        <th colspan="4"><h3><hr></h3></th>
    </tr>



    <tr class="income">
        <td class="running_cost_title"><span> Profit Per Service Call</span></td>
        <td class="running_cost"><div id="weekly_profit_per_servicecall"></div></td>
        <td class="running_cost"><div id="monthly_profit_per_servicecall"></div></td>
        <td class="running_cost"><div id="yearly_profit_per_servicecall"></div></td>
    </tr>


    <tr class="income">
        <td class="running_cost_title"><span> Profit Margin (Percentage)</span></td>
        <td class="running_cost" ><div id="weekly_profit_percentage_from_servicecalls"></div></td>
        <td class="running_cost" ><div id="monthly_profit_percentage_from_servicecalls"></div></td>
        <td class="running_cost" ><div id="yearly_profit_percentage_from_servicecalls"></div></td>
    </tr>

    <tr class="income">
        <td class="running_cost_title"><span> Total Profit From Service Calls</span></td>
        <td class="running_cost"><div id="weekly_profit_from_servicecalls"></div></td>
        <td class="running_cost"><div id="monthly_profit_from_servicecalls"></div></td>
        <td class="running_cost"><div id="yearly_profit_from_servicecalls"></div></td>
    </tr>




    <tr>
        <th colspan="2"><h3>Appliance Sales</h3></th>
    </tr>




    <tr>
        <td class="running_cost_title">Profit From Appliance Sales</td>
        <td> <?php echo CHtml::textField('profit_from_appliance_sales_weekly', '0', array('id' => 'profit_from_appliance_sales_weekly', 'style' => 'width: 80%;')); ?></td>
        <td> <?php echo CHtml::textField('profit_from_appliance_sales_monthly', '0', array('id' => 'profit_from_appliance_sales_monthly', 'style' => 'width: 80%;')); ?></td>
        <td> <?php echo CHtml::textField('profit_from_appliance_sales_yearly', '0', array('id' => 'profit_from_appliance_sales_yearly', 'style' => 'width: 80%;')); ?></td>

        <script>

            $( "#profit_from_appliance_sales_weekly" ).keyup(function() {
                profit_from_appliance_sales_weekly=this.value;

                profit_from_appliance_sales_monthly=profit_from_appliance_sales_weekly*4.33;
                $( "#profit_from_appliance_sales_monthly" ).val(profit_from_appliance_sales_monthly);

                profit_from_appliance_sales_yearly=profit_from_appliance_sales_weekly*52;
                $( "#profit_from_appliance_sales_yearly" ).val(profit_from_appliance_sales_yearly);
            });


            $( "#profit_from_appliance_sales_monthly" ).keyup(function() {
                profit_from_appliance_sales_monthly=this.value;

                profit_from_appliance_sales_weekly=profit_from_appliance_sales_monthly/4;
                $( "#profit_from_appliance_sales_weekly" ).val(profit_from_appliance_sales_weekly);

                profit_from_appliance_sales_yearly=profit_from_appliance_sales_monthly*12;
                $( "#profit_from_appliance_sales_yearly" ).val(profit_from_appliance_sales_yearly);
            });



            $( "#profit_from_appliance_sales_yearly" ).keyup(function() {
                profit_from_appliance_sales_yearly=this.value;

                profit_from_appliance_sales_weekly=profit_from_appliance_sales_yearly/52;
                $( "#profit_from_appliance_sales_weekly" ).val(profit_from_appliance_sales_weekly);

                profit_from_appliance_sales_monthly=profit_from_appliance_sales_yearly/12;
                $( "#profit_from_appliance_sales_monthly" ).val(profit_from_appliance_sales_monthly);
            });

        </script>

    </tr>




    <tr>
        <td class="running_cost_title">Cost of Appliances</td>
        <td> <?php echo CHtml::textField('cost_of_appliance_sales_weekly', '0', array('id' => 'cost_of_appliance_sales_weekly', 'style' => 'width: 80%;')); ?></td>
        <td> <?php echo CHtml::textField('cost_of_appliance_sales_monthly', '0', array('id' => 'cost_of_appliance_sales_monthly', 'style' => 'width: 80%;')); ?></td>
        <td> <?php echo CHtml::textField('cost_of_appliance_sales_yearly', '0', array('id' => 'cost_of_appliance_sales_yearly', 'style' => 'width: 80%;')); ?></td>

        <script>

            $( "#cost_of_appliance_sales_weekly" ).keyup(function() {
                cost_of_appliance_sales_weekly=this.value;

                cost_of_appliance_sales_monthly=cost_of_appliance_sales_weekly*4.33;
                $( "#cost_of_appliance_sales_monthly" ).val(cost_of_appliance_sales_monthly);

                cost_of_appliance_sales_yearly=cost_of_appliance_sales_weekly*52;
                $( "#cost_of_appliance_sales_yearly" ).val(cost_of_appliance_sales_yearly);
            });


            $( "#cost_of_appliance_sales_monthly" ).keyup(function() {
                cost_of_appliance_sales_monthly=this.value;

                cost_of_appliance_sales_weekly=cost_of_appliance_sales_monthly/4;
                $( "#cost_of_appliance_sales_weekly" ).val(cost_of_appliance_sales_weekly);

                cost_of_appliance_sales_yearly=cost_of_appliance_sales_monthly*12;
                $( "#cost_of_appliance_sales_yearly" ).val(cost_of_appliance_sales_yearly);
            });



            $( "#cost_of_appliance_sales_yearly" ).keyup(function() {
                cost_of_appliance_sales_yearly=this.value;

                cost_of_appliance_sales_weekly=cost_of_appliance_sales_yearly/52;
                $( "#cost_of_appliance_sales_weekly" ).val(cost_of_appliance_sales_weekly);

                cost_of_appliance_sales_monthly=cost_of_appliance_sales_yearly/12;
                $( "#cost_of_appliance_sales_monthly" ).val(cost_of_appliance_sales_monthly);
            });

        </script>


    </tr>



    <tr>
        <th colspan="4"><h3><hr></h3></th>
    </tr>


    <tr>
        <th colspan="2"><h3>Total</h3></th>
    </tr>



    <tr class="notice">
        <td class="running_cost_title"><span> Total Turnover</span></td>
        <td class="running_cost"><div id="weekly_turnover"></div></td>
        <td class="running_cost"><div id="monthly_turnover"></div></td>
        <td class="running_cost"><div id="yearly_turnover"></div></td>
    </tr>








    <tr class="expense">
        <td class="running_cost_title"><span> Total Rolling Liabilities</span></td>
        <td class="running_cost"><div id="weekly_total_rolling_liabilities"></div></td>
        <td class="running_cost"><div id="monthly_total_rolling_liabilities"></div></td>
        <td class="running_cost"><div id="yearly_total_rolling_liabilities"></div></td>
    </tr>


    <tr class="expense">
        <td class="running_cost_title"><span> Total Liabilities (Plus Call Costs & Stock Write Down)</span></td>
        <td class="running_cost"><div id="weekly_net_total_liabilities"></div></td>
        <td class="running_cost"><div id="monthly_net_total_liabilities"></div></td>
        <td class="running_cost"><div id="yearly_net_total_liabilities"></div></td>
    </tr>


    <tr class="income">
        <td class="running_cost_title"><span> Total Income</span></td>
        <td class="running_cost"><div id="weekly_net_total_income"></div></td>
        <td class="running_cost"><div id="monthly_net_total_income"></div></td>
        <td class="running_cost"><div id="yearly_net_total_income"></div></td>
    </tr>

    <tr class="cart">
        <td class="running_cost_title"><span> Total Profit From Contract</span></td>
        <td class="running_cost"><div id="weekly_total_profit_from_contract"></div></td>
        <td class="running_cost"><div id="monthly_total_profit_from_contract"></div></td>
        <td class="running_cost"><div id="yearly_total_profit_from_contract"></div></td>
    </tr>

    <tr class="evenrow">
        <td class="running_cost_title"><span> Time till stock value re-couped</span></td>
        <td class="running_cost"><div id="weeks_till_stock_value_recouped"></div></td>
        <td class="running_cost"><div id="months_till_stock_value_recouped"></div></td>
        <td class="running_cost"><div id="years_till_stock_value_recouped"></div></td>
    </tr>





</table>

</div>

<button class="btn btn-primary" onclick="calculate_contract_value();">
    Calculate or Hit the return Key ⏎
</button>

<script>

    ///JUST FOR TESTING PLEASE ReMOVE ////////////////////////////////////////////////
    ///JUST FOR TESTING PLEASE ReMOVE ////////////////////////////////////////////////
    ///JUST FOR TESTING PLEASE ReMOVE ////////////////////////////////////////////////
//    $("#current_cost_per_call").val('25.00');
//    $("#primary_labour_rate_per_call").val('50.00');
//    $("#initial_van_stock").val('3000.00');
//    $("#primary_no_of_calls_weekly").val('50');
//    $("#no_of_days_credit_for_spares").val('30');
//    $("#cost_of_spares_used_weekly").val('200.00');
    ///JUST FOR TESTING PLEASE ReMOVE ////////////////////////////////////////////////
    ///JUST FOR TESTING PLEASE ReMOVE ////////////////////////////////////////////////
    ///JUST FOR TESTING PLEASE ReMOVE ////////////////////////////////////////////////





    $('#contract_calculator_div').bind('keydown', function(event) {

        if (event.keyCode=='13')
            calculate_contract_value();
    });





    function calculate_contract_value() {

        calculate_cost_per_call();
        calculate_income_per_call();
        calculate_loss_from_non_first_fixes();

        calculate_profit_from_spares();
        calculate_rolling_spares_liability();
        calculate_stock_write_down();
        createprofitfromservicecalls();

        calculate_turnover();

        calculate_total_profit_from_contract();

        calculate_total_rolling_liablities();

        calculate_net_total_liabilities();
        calculate_net_total_income();

        calculate_stock_recouped_value();

    }///end of function updatedailyweeklymonthlyyearlycost()


    function calculate_stock_recouped_value(){

        initial_van_stock=convertStringToFloatNumber($("#initial_van_stock").val());

        weekly_profit_from_servicecalls=convertStringToFloatNumber($("#weekly_profit_from_servicecalls").html());
        weeks_till_stock_value_recouped=initial_van_stock/weekly_profit_from_servicecalls;
        weeks_till_stock_value_recouped =  numberWithCommasAnd2Decimal(weeks_till_stock_value_recouped);
        $("#weeks_till_stock_value_recouped").html(weeks_till_stock_value_recouped);

        monthly_profit_from_servicecalls=convertStringToFloatNumber($("#monthly_profit_from_servicecalls").html());
        months_till_stock_value_recouped=initial_van_stock/monthly_profit_from_servicecalls;
        console.log('initial_van_stock '+initial_van_stock);
        console.log('monthly_profit_from_servicecalls '+monthly_profit_from_servicecalls);

        console.log('months_till_stock_value_recouped '+months_till_stock_value_recouped);

        months_till_stock_value_recouped =  numberWithCommasAnd2Decimal(months_till_stock_value_recouped);
        $("#months_till_stock_value_recouped").html(months_till_stock_value_recouped);

        yearly_profit_from_servicecalls=convertStringToFloatNumber($("#yearly_profit_from_servicecalls").html());
        years_till_stock_value_recouped=initial_van_stock/yearly_profit_from_servicecalls;
        years_till_stock_value_recouped =  numberWithCommasAnd2Decimal(years_till_stock_value_recouped);
        $("#years_till_stock_value_recouped").html(years_till_stock_value_recouped);



    }///end of function calculate_stock_recouped_value(){






    function calculate_net_total_income()
    {

        weekly_income_from_calls=convertStringToFloatNumber($("#weekly_income_from_calls").html());
        weekly_profit_from_spares=convertStringToFloatNumber($("#weekly_profit_from_spares").html());
        weekly_rolling_spares_liability=convertStringToFloatNumber($("#weekly_rolling_spares_liability").html());
        cost_of_appliance_sales_weekly=convertStringToFloatNumber($("#cost_of_appliance_sales_weekly").val());
        profit_from_appliance_sales_weekly=convertStringToFloatNumber($("#profit_from_appliance_sales_weekly").val());
        weekly_net_total_income=weekly_income_from_calls+weekly_profit_from_spares+weekly_rolling_spares_liability+cost_of_appliance_sales_weekly+profit_from_appliance_sales_weekly;
        weekly_net_total_income =  numberWithCommasAnd2Decimal(weekly_net_total_income);
        $("#weekly_net_total_income").html(weekly_net_total_income);


        monthly_income_from_calls=convertStringToFloatNumber($("#monthly_income_from_calls").html());
        monthly_profit_from_spares=convertStringToFloatNumber($("#monthly_profit_from_spares").html());
        monthly_rolling_spares_liability=convertStringToFloatNumber($("#monthly_rolling_spares_liability").html());
        cost_of_appliance_sales_monthly=convertStringToFloatNumber($("#cost_of_appliance_sales_monthly").val());
        profit_from_appliance_sales_monthly=convertStringToFloatNumber($("#profit_from_appliance_sales_monthly").val());
        monthly_net_total_income=monthly_income_from_calls+monthly_profit_from_spares+monthly_rolling_spares_liability+cost_of_appliance_sales_monthly+profit_from_appliance_sales_monthly;
        monthly_net_total_income =  numberWithCommasAnd2Decimal(monthly_net_total_income);
        $("#monthly_net_total_income").html(monthly_net_total_income);



        yearly_income_from_calls=convertStringToFloatNumber($("#yearly_income_from_calls").html());
        yearly_profit_from_spares=convertStringToFloatNumber($("#yearly_profit_from_spares").html());
        yearly_rolling_spares_liability=convertStringToFloatNumber($("#yearly_rolling_spares_liability").html());
        cost_of_appliance_sales_yearly=convertStringToFloatNumber($("#cost_of_appliance_sales_yearly").val());
        profit_from_appliance_sales_yearly=convertStringToFloatNumber($("#profit_from_appliance_sales_yearly").val());
        yearly_net_total_income=yearly_income_from_calls+yearly_profit_from_spares+yearly_rolling_spares_liability+cost_of_appliance_sales_yearly+profit_from_appliance_sales_yearly;
        yearly_net_total_income =  numberWithCommasAnd2Decimal(yearly_net_total_income);
        $("#yearly_net_total_income").html(yearly_net_total_income);




    }///end of function calculate_net_total_income()




    function calculate_net_total_liabilities() {

        weekly_total_rolling_liabilities=convertStringToFloatNumber($("#weekly_total_rolling_liabilities").html());
        weekly_loss_from_non_first_fixes=convertStringToFloatNumber($("#weekly_loss_from_non_first_fixes").html());
        weekly_cost_of_calls=convertStringToFloatNumber($("#weekly_cost_of_calls").html());
        weekly_stock_write_down=convertStringToFloatNumber($("#weekly_stock_write_down").html());

        weekly_net_total_liabilities=weekly_total_rolling_liabilities+weekly_loss_from_non_first_fixes+weekly_cost_of_calls+weekly_stock_write_down;
        weekly_net_total_liabilities =  numberWithCommasAnd2Decimal(weekly_net_total_liabilities);
        $("#weekly_net_total_liabilities").html(weekly_net_total_liabilities);




        monthly_total_rolling_liabilities=convertStringToFloatNumber($("#monthly_total_rolling_liabilities").html());
        monthly_loss_from_non_first_fixes=convertStringToFloatNumber($("#monthly_loss_from_non_first_fixes").html());
        monthly_cost_of_calls=convertStringToFloatNumber($("#monthly_cost_of_calls").html());
        monthly_stock_write_down=convertStringToFloatNumber($("#monthly_stock_write_down").html());

        monthly_net_total_liabilities=monthly_total_rolling_liabilities+monthly_loss_from_non_first_fixes+monthly_cost_of_calls+monthly_stock_write_down;
        monthly_net_total_liabilities =  numberWithCommasAnd2Decimal(monthly_net_total_liabilities);
        $("#monthly_net_total_liabilities").html(monthly_net_total_liabilities);





        yearly_total_rolling_liabilities=convertStringToFloatNumber($("#yearly_total_rolling_liabilities").html());
        yearly_loss_from_non_first_fixes=convertStringToFloatNumber($("#yearly_loss_from_non_first_fixes").html());
        yearly_cost_of_calls=convertStringToFloatNumber($("#yearly_cost_of_calls").html());
        yearly_stock_write_down=convertStringToFloatNumber($("#yearly_stock_write_down").html());

        yearly_net_total_liabilities=yearly_total_rolling_liabilities+yearly_loss_from_non_first_fixes+yearly_cost_of_calls+yearly_stock_write_down;
        yearly_net_total_liabilities =  numberWithCommasAnd2Decimal(yearly_net_total_liabilities);
        $("#yearly_net_total_liabilities").html(yearly_net_total_liabilities);


    }
    
    
    function calculate_total_rolling_liablities() {

        cost_of_appliance_sales_weekly=convertStringToFloatNumber($("#cost_of_appliance_sales_weekly").val());
        weekly_rolling_spares_liability=convertStringToFloatNumber($("#weekly_rolling_spares_liability").html());
        weekly_total_rolling_liabilities=cost_of_appliance_sales_weekly+weekly_rolling_spares_liability;
        weekly_total_rolling_liabilities =  numberWithCommasAnd2Decimal(weekly_total_rolling_liabilities);
        $("#weekly_total_rolling_liabilities").html(weekly_total_rolling_liabilities);


        cost_of_appliance_sales_monthly=convertStringToFloatNumber($("#cost_of_appliance_sales_monthly").val());
        monthly_rolling_spares_liability=convertStringToFloatNumber($("#monthly_rolling_spares_liability").html());
        monthly_total_rolling_liabilities=cost_of_appliance_sales_monthly+monthly_rolling_spares_liability;
        monthly_total_rolling_liabilities =  numberWithCommasAnd2Decimal(monthly_total_rolling_liabilities);
        $("#monthly_total_rolling_liabilities").html(monthly_total_rolling_liabilities);


        cost_of_appliance_sales_yearly=convertStringToFloatNumber($("#cost_of_appliance_sales_yearly").val());
        yearly_rolling_spares_liability=convertStringToFloatNumber($("#yearly_rolling_spares_liability").html());
        yearly_total_rolling_liabilities=cost_of_appliance_sales_yearly+yearly_rolling_spares_liability;
        yearly_total_rolling_liabilities =  numberWithCommasAnd2Decimal(yearly_total_rolling_liabilities);
        $("#yearly_total_rolling_liabilities").html(yearly_total_rolling_liabilities);



    }////end of function calculate_total_rolling_liablities()

    function calculate_total_profit_from_contract()
    {
        profit_from_appliance_sales_weekly=convertStringToFloatNumber($("#profit_from_appliance_sales_weekly").val());
        weekly_profit_from_servicecalls=convertStringToFloatNumber($("#weekly_profit_from_servicecalls").html());
        weekly_total_profit_from_contract=profit_from_appliance_sales_weekly+weekly_profit_from_servicecalls;
        weekly_total_profit_from_contract =  numberWithCommasAnd2Decimal(weekly_total_profit_from_contract);
        $("#weekly_total_profit_from_contract").html(weekly_total_profit_from_contract);


        profit_from_appliance_sales_monthly=convertStringToFloatNumber($("#profit_from_appliance_sales_monthly").val());
        monthly_profit_from_servicecalls=convertStringToFloatNumber($("#monthly_profit_from_servicecalls").html());
        monthly_total_profit_from_contract=profit_from_appliance_sales_monthly+monthly_profit_from_servicecalls;
        monthly_total_profit_from_contract =  numberWithCommasAnd2Decimal(monthly_total_profit_from_contract);
        $("#monthly_total_profit_from_contract").html(monthly_total_profit_from_contract);


        profit_from_appliance_sales_yearly=convertStringToFloatNumber($("#profit_from_appliance_sales_yearly").val());
        yearly_profit_from_servicecalls=convertStringToFloatNumber($("#yearly_profit_from_servicecalls").html());
        yearly_total_profit_from_contract=profit_from_appliance_sales_yearly+yearly_profit_from_servicecalls;
        yearly_total_profit_from_contract =  numberWithCommasAnd2Decimal(yearly_total_profit_from_contract);
        $("#yearly_total_profit_from_contract").html(yearly_total_profit_from_contract);

    }////end of function calculate_total_profit_from_contract()




    function calculate_turnover() {

        //Income from Calls + Spares Used

        weekly_income_from_calls=convertStringToFloatNumber($("#weekly_income_from_calls").html());
        cost_of_spares_used_weekly=convertStringToFloatNumber($("#cost_of_spares_used_weekly").val());
        weekly_turnover=weekly_income_from_calls+cost_of_spares_used_weekly;
        weekly_turnover =  numberWithCommasAnd2Decimal(weekly_turnover);
        $("#weekly_turnover").html(weekly_turnover);

        monthly_income_from_calls=convertStringToFloatNumber($("#monthly_income_from_calls").html());
        cost_of_spares_used_monthly=convertStringToFloatNumber($("#cost_of_spares_used_monthly").val());
        monthly_turnover=monthly_income_from_calls+cost_of_spares_used_monthly;
        monthly_turnover =  numberWithCommasAnd2Decimal(monthly_turnover);
        $("#monthly_turnover").html(monthly_turnover);

        yearly_income_from_calls=convertStringToFloatNumber($("#yearly_income_from_calls").html());
        cost_of_spares_used_yearly=convertStringToFloatNumber($("#cost_of_spares_used_yearly").val());
        yearly_turnover=yearly_income_from_calls+cost_of_spares_used_yearly;
        yearly_turnover =  numberWithCommasAnd2Decimal(yearly_turnover);
        $("#yearly_turnover").html(yearly_turnover);








    }///end of function calculate_turnover(


    function calculate_stock_write_down() {

        stock_write_down_percentage=convertStringToFloatNumber($("#stock_write_down_percentage").val());
        initial_van_stock=convertStringToFloatNumber($("#initial_van_stock").val());

        cost_of_spares_used_weekly=convertStringToFloatNumber($("#cost_of_spares_used_weekly").val());
        weekly_stock_write_down=((cost_of_spares_used_weekly*stock_write_down_percentage)/100)+((initial_van_stock*stock_write_down_percentage)/100);
        weekly_stock_write_down =  numberWithCommasAnd2Decimal(weekly_stock_write_down);
        $("#weekly_stock_write_down").html(weekly_stock_write_down);


        cost_of_spares_used_monthly=convertStringToFloatNumber($("#cost_of_spares_used_monthly").val());
        monthly_stock_write_down=((cost_of_spares_used_monthly*stock_write_down_percentage)/100)+((initial_van_stock*stock_write_down_percentage)/100);
        monthly_stock_write_down =  numberWithCommasAnd2Decimal(monthly_stock_write_down);
        $("#monthly_stock_write_down").html(monthly_stock_write_down);

        cost_of_spares_used_yearly=convertStringToFloatNumber($("#cost_of_spares_used_yearly").val());
        yearly_stock_write_down=((cost_of_spares_used_yearly*stock_write_down_percentage)/100)+((initial_van_stock*stock_write_down_percentage)/100);
        yearly_stock_write_down =  numberWithCommasAnd2Decimal(yearly_stock_write_down);
        $("#yearly_stock_write_down").html(yearly_stock_write_down);




    }////end of function calculate_stock_write_down






    function calculate_rolling_spares_liability()
    {
        no_of_days_credit_for_spares=convertStringToFloatNumber($("#no_of_days_credit_for_spares").val());

        cost_of_spares_used_weekly=convertStringToFloatNumber($("#cost_of_spares_used_weekly").val());
        weekly_rolling_spares_liability=(no_of_days_credit_for_spares/7)*cost_of_spares_used_weekly;
        weekly_rolling_spares_liability =  numberWithCommasAnd2Decimal(weekly_rolling_spares_liability);
        $("#weekly_rolling_spares_liability").html(weekly_rolling_spares_liability);


        cost_of_spares_used_monthly=convertStringToFloatNumber($("#cost_of_spares_used_monthly").val());
        monthly_rolling_spares_liability=(no_of_days_credit_for_spares/30)*cost_of_spares_used_monthly;
        monthly_rolling_spares_liability =  numberWithCommasAnd2Decimal(monthly_rolling_spares_liability);
        $("#monthly_rolling_spares_liability").html(monthly_rolling_spares_liability);


        cost_of_spares_used_yearly=convertStringToFloatNumber($("#cost_of_spares_used_yearly").val());
        yearly_rolling_spares_liability=(no_of_days_credit_for_spares/30)*(cost_of_spares_used_yearly/12);
        yearly_rolling_spares_liability =  numberWithCommasAnd2Decimal(yearly_rolling_spares_liability);
        $("#yearly_rolling_spares_liability").html(yearly_rolling_spares_liability);




    }///end of function calculate_rolling_spares_liability()


    function calculate_profit_from_spares () {

        profit_margin_percentage_for_spares=convertStringToFloatNumber($("#profit_margin_percentage_for_spares").val());


        cost_of_spares_used_weekly=convertStringToFloatNumber($("#cost_of_spares_used_weekly").val());
        weekly_profit_from_spares=(cost_of_spares_used_weekly*profit_margin_percentage_for_spares)/100;
        weekly_profit_from_spares =  numberWithCommasAnd2Decimal(weekly_profit_from_spares);
        $("#weekly_profit_from_spares").html(weekly_profit_from_spares);


        cost_of_spares_used_monthly=convertStringToFloatNumber($("#cost_of_spares_used_monthly").val());
        monthly_profit_from_spares=(cost_of_spares_used_monthly*profit_margin_percentage_for_spares)/100;
        monthly_profit_from_spares =  numberWithCommasAnd2Decimal(monthly_profit_from_spares);
        $("#monthly_profit_from_spares").html(monthly_profit_from_spares);



        cost_of_spares_used_yearly=convertStringToFloatNumber($("#cost_of_spares_used_yearly").val());
        yearly_profit_from_spares=(cost_of_spares_used_yearly*profit_margin_percentage_for_spares)/100;
        yearly_profit_from_spares =  numberWithCommasAnd2Decimal(yearly_profit_from_spares);
        $("#yearly_profit_from_spares").html(yearly_profit_from_spares);





    }////end of function calculate_profit_from_spares () {




    function createprofitfromservicecalls()
    {

        var weekly_income_from_calls=convertStringToFloatNumber($("#weekly_income_from_calls").html());
        var weekly_cost_of_calls=convertStringToFloatNumber($("#weekly_cost_of_calls").html());
        var weekly_loss_from_non_first_fixes=convertStringToFloatNumber($("#weekly_loss_from_non_first_fixes").html());
        var weekly_profit_from_spares=convertStringToFloatNumber($("#weekly_profit_from_spares").html());


        weekly_profit_from_servicecalls=weekly_income_from_calls-weekly_cost_of_calls-weekly_loss_from_non_first_fixes+weekly_profit_from_spares;

        var total_visits_weekly=getTotalProjectedCallsWeekly();
        weekly_profit_per_servicecall=weekly_profit_from_servicecalls/total_visits_weekly;
        weekly_profit_per_servicecall=numberWithCommasAnd2Decimal(weekly_profit_per_servicecall);
        $("#weekly_profit_per_servicecall").html(weekly_profit_per_servicecall);

        weekly_profit_percentage_from_servicecalls=getPercentage(weekly_profit_from_servicecalls,weekly_income_from_calls);
        $("#weekly_profit_percentage_from_servicecalls").html(weekly_profit_percentage_from_servicecalls);

        weekly_profit_from_servicecalls=numberWithCommasAnd2Decimal(weekly_profit_from_servicecalls);
        $("#weekly_profit_from_servicecalls").html(weekly_profit_from_servicecalls);





        var monthly_income_from_calls=convertStringToFloatNumber($("#monthly_income_from_calls").html());
        var monthly_cost_of_calls=convertStringToFloatNumber($("#monthly_cost_of_calls").html());
        var monthly_loss_from_non_first_fixes=convertStringToFloatNumber($("#monthly_loss_from_non_first_fixes").html());
        var monthly_profit_from_spares=convertStringToFloatNumber($("#monthly_profit_from_spares").html());


        monthly_profit_from_servicecalls=monthly_income_from_calls-monthly_cost_of_calls-monthly_loss_from_non_first_fixes+monthly_profit_from_spares;

        var total_visits_monthly=getTotalProjectedCallsMonthly();
        monthly_profit_per_servicecall=monthly_profit_from_servicecalls/total_visits_monthly;

        monthly_profit_per_servicecall=numberWithCommasAnd2Decimal(monthly_profit_per_servicecall);

        $("#monthly_profit_per_servicecall").html(monthly_profit_per_servicecall);


        monthly_profit_percentage_from_servicecalls=getPercentage(monthly_profit_from_servicecalls,monthly_income_from_calls);
        $("#monthly_profit_percentage_from_servicecalls").html(monthly_profit_percentage_from_servicecalls);

        monthly_profit_from_servicecalls=numberWithCommasAnd2Decimal(monthly_profit_from_servicecalls);
        $("#monthly_profit_from_servicecalls").html(monthly_profit_from_servicecalls);






        var yearly_income_from_calls=convertStringToFloatNumber($("#yearly_income_from_calls").html());
        var yearly_cost_of_calls=convertStringToFloatNumber($("#yearly_cost_of_calls").html());
        var yearly_loss_from_non_first_fixes=convertStringToFloatNumber($("#yearly_loss_from_non_first_fixes").html());
        var yearly_profit_from_spares=convertStringToFloatNumber($("#yearly_profit_from_spares").html());



        yearly_profit_from_servicecalls=yearly_income_from_calls-yearly_cost_of_calls-yearly_loss_from_non_first_fixes+yearly_profit_from_spares;

        var total_visits_yearly=getTotalProjectedCallsYearly();
        yearly_profit_per_servicecall=yearly_profit_from_servicecalls/total_visits_yearly;
        yearly_profit_per_servicecall=numberWithCommasAnd2Decimal(yearly_profit_per_servicecall);
        $("#yearly_profit_per_servicecall").html(yearly_profit_per_servicecall);

        yearly_profit_percentage_from_servicecalls=getPercentage(yearly_profit_from_servicecalls,yearly_income_from_calls);
        $("#yearly_profit_percentage_from_servicecalls").html(yearly_profit_percentage_from_servicecalls);

        yearly_profit_from_servicecalls=numberWithCommasAnd2Decimal(yearly_profit_from_servicecalls);
        $("#yearly_profit_from_servicecalls").html(yearly_profit_from_servicecalls);





    }///end of function createprofitfromservicecalls


    function calculate_loss_from_non_first_fixes() {

        var current_cost_per_call = $("#current_cost_per_call").val();
        var failure_pecentage = $("#first_time_fix_failure_percentage").val();


        var total_visits_weekly=getTotalProjectedCallsWeekly();
        weekly_loss_from_non_first_fixes=(total_visits_weekly*(failure_pecentage/100))*current_cost_per_call;
        weekly_loss_from_non_first_fixes=numberWithCommasAnd2Decimal(weekly_loss_from_non_first_fixes);
        $("#weekly_loss_from_non_first_fixes").html(weekly_loss_from_non_first_fixes);




        var total_visits_monthly=getTotalProjectedCallsMonthly();
        monthly_loss_from_non_first_fixes=(total_visits_monthly*(failure_pecentage/100))*current_cost_per_call;
        monthly_loss_from_non_first_fixes=numberWithCommasAnd2Decimal(monthly_loss_from_non_first_fixes);
        $("#monthly_loss_from_non_first_fixes").html(monthly_loss_from_non_first_fixes);


        var total_visits_yearly=getTotalProjectedCallsYearly()

        yearly_loss_from_non_first_fixes=(total_visits_yearly*(failure_pecentage/100))*current_cost_per_call;

        yearly_loss_from_non_first_fixes=numberWithCommasAnd2Decimal(yearly_loss_from_non_first_fixes);

        $("#yearly_loss_from_non_first_fixes").html(yearly_loss_from_non_first_fixes);







    }///end of  function calculate_loss_from_non_first_fixes() {








    function calculate_cost_per_call() {

        var current_cost_per_call = $("#current_cost_per_call").val();

        var primary_weekly_cost_of_calls     =current_cost_per_call*$("#primary_no_of_calls_weekly").val();
        var secondary_weekly_cost_of_calls   =current_cost_per_call*$("#secondary_no_of_calls_weekly").val();
        var tertiary_weekly_cost_of_calls    =current_cost_per_call*$("#tertiary_no_of_calls_weekly").val();

        weekly_cost_of_calls=primary_weekly_cost_of_calls+secondary_weekly_cost_of_calls+tertiary_weekly_cost_of_calls;
        weekly_cost_of_calls=numberWithCommasAnd2Decimal(weekly_cost_of_calls);
        $("#weekly_cost_of_calls").html(weekly_cost_of_calls);



        var primary_monthly_cost_of_calls     =current_cost_per_call*$("#primary_no_of_calls_monthly").val();
        var secondary_monthly_cost_of_calls   =current_cost_per_call* $("#secondary_no_of_calls_monthly").val();
        var tertiary_monthly_cost_of_calls    =current_cost_per_call*$("#tertiary_no_of_calls_monthly").val();
        monthly_cost_of_calls=primary_monthly_cost_of_calls+secondary_monthly_cost_of_calls+tertiary_monthly_cost_of_calls;
        monthly_cost_of_calls=numberWithCommasAnd2Decimal(monthly_cost_of_calls);
        $("#monthly_cost_of_calls").html(monthly_cost_of_calls);


        var primary_yearly_cost_of_calls     =current_cost_per_call*$("#primary_no_of_calls_yearly").val();
        var secondary_yearly_cost_of_calls   =current_cost_per_call*$("#secondary_no_of_calls_yearly").val();
        var tertiary_yearly_cost_of_calls    =current_cost_per_call* $("#tertiary_no_of_calls_yearly").val();
        yearly_cost_of_calls=primary_yearly_cost_of_calls+secondary_yearly_cost_of_calls+tertiary_yearly_cost_of_calls;
        yearly_cost_of_calls=numberWithCommasAnd2Decimal(yearly_cost_of_calls);
        $("#yearly_cost_of_calls").html(yearly_cost_of_calls);

    }//end of function calculate_cost_per_call() {


    function calculate_income_per_call() {

        income_from_primary_calls_weekly= $("#primary_no_of_calls_weekly").val()*$("#primary_labour_rate_per_call").val()
        income_from_secondary_calls_weekly= $("#secondary_no_of_calls_weekly").val()*$("#secondary_labour_rate_per_call").val()
        income_from_tertiary_calls_weekly= $("#tertiary_no_of_calls_weekly").val()*$("#tertiary_labour_rate_per_call").val()
        weekly_income_from_calls=income_from_primary_calls_weekly+income_from_secondary_calls_weekly+income_from_tertiary_calls_weekly;
        weekly_income_from_calls=numberWithCommasAnd2Decimal(weekly_income_from_calls);
        $("#weekly_income_from_calls").html(weekly_income_from_calls);

        income_from_primary_calls_monthly= $("#primary_no_of_calls_monthly").val()*$("#primary_labour_rate_per_call").val()
        income_from_secondary_calls_monthly= $("#secondary_no_of_calls_monthly").val()*$("#secondary_labour_rate_per_call").val()
        income_from_tertiary_calls_monthly= $("#tertiary_no_of_calls_monthly").val()*$("#tertiary_labour_rate_per_call").val()
        monthly_income_from_calls=income_from_primary_calls_monthly+income_from_secondary_calls_monthly+income_from_tertiary_calls_monthly;
        monthly_income_from_calls=numberWithCommasAnd2Decimal(monthly_income_from_calls);
        $("#monthly_income_from_calls").html(monthly_income_from_calls);


        income_from_primary_calls_yearly= $("#primary_no_of_calls_yearly").val()*$("#primary_labour_rate_per_call").val()
        income_from_secondary_calls_yearly= $("#secondary_no_of_calls_yearly").val()*$("#secondary_labour_rate_per_call").val()
        income_from_tertiary_calls_yearly= $("#tertiary_no_of_calls_yearly").val()*$("#tertiary_labour_rate_per_call").val()
        yearly_income_from_calls=income_from_primary_calls_yearly+income_from_secondary_calls_yearly+income_from_tertiary_calls_yearly;
        yearly_income_from_calls=numberWithCommasAnd2Decimal(yearly_income_from_calls);
        $("#yearly_income_from_calls").html(yearly_income_from_calls);


    }////end of function calculate_income_per_call(






    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////***///////////////***/////////***///////////////***/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////******/////////******////////////***/////////***///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////***///***///***///***///////////////***///***//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////***//////***//////***//////////////////***///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////***///////////////***//////////////////***////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////***///////////////***//////////////////***////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////***///////////////***//////////////////***///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////***///////////////***//////////////////***////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////***///////////////***//////////////////***/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////***///////////////***//////////////////***///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function numberWithCommasAnd2Decimal(x) {

        if (isNaN(x))
            return "";

        if (!isFinite(x))
            return "";

        x=(x.toFixed(2));
        return  x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
   }

    function convertStringToFloatNumber(stringWithNumbers)
    {
        stringWithNumbers = stringWithNumbers.replace(/(\d+),(?=\d{3}(\D|$))/g, "$1");
        return parseFloat(stringWithNumbers);
    }///end of  function convertStringToFloatNumber(stringWithNumbers)


    function getPercentage(profit,fromtotal)
    {

        var percentage=(profit/fromtotal)*100;

        percentage=numberWithCommasAnd2Decimal(percentage);
        percentage=percentage.toString();

        return percentage+'%';


    }

    function getTotalProjectedCallsWeekly()
    {
        var primary_no_of_calls_weekly=parseInt($("#primary_no_of_calls_weekly").val());
        var secondary_no_of_calls_weekly=parseInt($("#secondary_no_of_calls_weekly").val());
        var tertiary_no_of_calls_weekly=parseInt($("#tertiary_no_of_calls_weekly").val());

        var projected_no_of_calls_weekly=primary_no_of_calls_weekly+secondary_no_of_calls_weekly+tertiary_no_of_calls_weekly;

        return projected_no_of_calls_weekly;

    }///end of function getTotalProjectedCallsWeekly()


    function getTotalProjectedCallsMonthly()
    {
        var primary_no_of_calls_monthly=parseInt($("#primary_no_of_calls_monthly").val());
        var secondary_no_of_calls_monthly=parseInt($("#secondary_no_of_calls_monthly").val());
        var tertiary_no_of_calls_monthly=parseInt($("#tertiary_no_of_calls_monthly").val());

        var projected_no_of_calls_monthly=primary_no_of_calls_monthly+secondary_no_of_calls_monthly+tertiary_no_of_calls_monthly;

        return projected_no_of_calls_monthly;

    }///end of function getTotalProjectedCallsWeekly()



    function getTotalProjectedCallsYearly()
    {
        var primary_no_of_calls_yearly=parseInt($("#primary_no_of_calls_yearly").val());
        var secondary_no_of_calls_yearly=parseInt($("#secondary_no_of_calls_yearly").val());
        var tertiary_no_of_calls_yearly=parseInt($("#tertiary_no_of_calls_yearly").val());
        var projected_no_of_calls_yearly=primary_no_of_calls_yearly+secondary_no_of_calls_yearly+tertiary_no_of_calls_yearly;

        return projected_no_of_calls_yearly;

    }///end of function getTotalProjectedCallsWeekly()





</script>