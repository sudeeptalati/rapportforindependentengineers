<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 27/07/2016
 * Time: 15:52
 */

$searchurl = $this->createUrl('masterItems/findspares');
$keyword = "eyword";
$service_id=$_GET['id'];///this is when called from servicecall page
?>

<?php //echo $service_id; ?>



<div class="result" id="result">

    <div id="sparesform" style="display:none">

        <?php $sparesmodel = new SparesUsed; ?>


        <?php $sparesform = $this->beginWidget('CActiveForm', array(
            'id' => 'spares-used-form',
            'enableAjaxValidation' => false,
            'action' => Yii::app()->createUrl('sparesUsed/create&servicecall_id='.$service_id),
        )); ?>

        <?php //echo $sparesform->labelEx($sparesmodel, 'master_item_id'); ?>
        <?php echo $sparesform->hiddenField($sparesmodel, 'master_item_id'); ?>
        <?php echo $sparesform->error($sparesmodel, 'master_item_id'); ?>


        <?php $sparesmodel->servicecall_id = $service_id; ?>
        <?php //echo $sparesform->labelEx($sparesmodel, 'servicecall_id'); ?>
        <?php echo $sparesform->hiddenField($sparesmodel, 'servicecall_id'); ?>
        <?php echo $sparesform->error($sparesmodel, 'servicecall_id'); ?>


        <div class="success contentbox">
            <table>
                <tr>
                    <th style="width:33%;"></th>
                    <th style="width:33%;"></th>
                    <th style="width:33%;"></th>
                </tr>
                <tr>
                    <td colspan="3">
                        <?php echo $sparesform->labelEx($sparesmodel, 'item_name'); ?>
                        <?php echo $sparesform->textField($sparesmodel, 'item_name', array('style'=>'width:100%')); ?>
                        <?php echo $sparesform->error($sparesmodel, 'item_name'); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo $sparesform->labelEx($sparesmodel, 'part_number'); ?>
                        <?php echo $sparesform->textField($sparesmodel, 'part_number', array('style'=>'width:70%;')); ?>
                        <?php echo $sparesform->error($sparesmodel, 'part_number'); ?>


                        <table style="margin-bottom:0px; ">
                            <tr>
                                <th style="width:33%;height: 1px;"></th>
                                <th style="width:33%;height: 1px;"></th>
                                <th style="width:33%;height: 1px;"></th>
                            </tr>

                            <tr>
                                <td>
                                    <?php echo $sparesform->labelEx($sparesmodel, 'quantity'); ?>
                                    <?php echo $sparesform->textField($sparesmodel, 'quantity', array('style'=>'width:80%;')); ?>
                                    <?php echo $sparesform->error($sparesmodel, 'quantity'); ?>
                                </td>
                                <td>
                                    <?php echo $sparesform->labelEx($sparesmodel, 'unit_price'); ?>
                                    <?php echo $sparesform->textField($sparesmodel, 'unit_price',array('style'=>'width:80%;', 'placeholder'=>'Please put quantity ')); ?>
                                    <?php echo $sparesform->error($sparesmodel, 'unit_price'); ?>
                                </td>

                                <td>
                                    <?php echo $sparesform->labelEx($sparesmodel, 'total_price'); ?>
                                    <?php echo $sparesform->textField($sparesmodel, 'total_price',array('style'=>'width:80%;','readonly'=>'readonly')); ?>
                                    <?php echo $sparesform->error($sparesmodel, 'total_price'); ?>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="3">
                                    <table style="width: 100px;margin-bottom:0px; ">
                                        <tr>
                                            <td>
                                                <?php echo $sparesform->labelEx($sparesmodel, 'used'); ?>
                                            </td>
                                            <td>
                                                <?php echo $sparesform->checkBox($sparesmodel,'used'); ?>
                                                <?php echo $sparesform->error($sparesmodel, 'used'); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                    </td>
                    <td>
                        <?php echo $sparesform->labelEx($sparesmodel, 'notes'); ?>
                        <?php echo $sparesform->textArea($sparesmodel, 'notes', array('style'=>'width:100%; height:100px;')); ?>
                        <?php echo $sparesform->error($sparesmodel, 'notes'); ?>
                    </td>
                </tr>
                <tr>

                </tr>

                <tr>
                    <td colspan="3">

                        <div id="submiterror" class="error" style="display: none;"></div>
                        <div id="submitsparesformbtn" style="display: none;">
                            <?php echo CHtml::submitButton($sparesmodel->isNewRecord ? 'Add' : 'Save', array(' onsubmit="return false"', 'class'=>'btn btn-info', 'style'=>'width:100%;')); ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>


        <?php $this->endWidget(); ?>


    </div>

    <div class="contentbox">
        <input id="searchterm" placeholder="Enter item name or part number" class="note" style="width:80%;height: 25px; border-radius: 10px;" />

    </div>
    <table id='scores' border="2">

    </table>
    <div>
        <h4>Item not in list?</h4>
        <h3 title="New Item" style="margin:20px;color:#0088cc;cursor: pointer;" onclick="additemnotinlist()"> Add <i class="fa fa-plus-square" aria-hidden="true"></i></h3>
    </div>

</div>


<style>
    tr.mytr:hover {
        background-color: yellow;
    }

    tr.mytr:visited {
        background-color: yellow;
    }

    .mytr {
        cursor: pointer;
        /*border-bottom: 1px solid red;*/
        border-radius: 5px;
    }

</style>


<script>
    $("#searchterm").focus();

    $("#searchterm").keyup(function () {
        searchwithkeyword();
    });


    function searchwithkeyword() {
        searchterm = $("#searchterm").attr('value');
        url = "<?php echo $searchurl; ?>";
        url = url + "&keyword=" + searchterm;

        console.log(url);
        $.get(url, function (data) {
            //$( ".result" ).html( data );
            displayoutput(data)
        });
    }///end of function searchwithkeyword()


    function displayoutput(stringdata) {
        $('#scores').empty();

        $('#scores').append('<tr><th>Name</th><th>Part Number</th><th>Last used Price</th></tr>');


        response = $.parseJSON(stringdata);

        $(function () {
            $.each(response, function (i, item) {
                console.log(item);
                $('#scores').append('<tr id="rowno' + i + '" class="mytr" onclick="selectrow(' + i + ')" >' +
                    '<td><span style="color:#0088cc">' + formatvalue(item.name)+ '</span></td>' +
                    '<td> ' + formatvalue(item.part_number )+ ' </td>' +
                    '<td> ' + item.sale_price + ' </td>' +
                    '</tr>');


            });
        });


    }///end of  function displayoutput(stringdata)


    function selectrow(index) {
        console.log("selected row" + index);
        console.log("selected row" + response[index].name);
        $(".mytr").css("background-color", "#FFFFFF");

        //$("#result").hide();
        $("#sparesform").show();
        $("#rowno" + index).css("background-color", "#e6e6e6");


        $("#SparesUsed_master_item_id").val(response[index].master_id);
        $("#SparesUsed_item_name").val(response[index].name);
        $("#SparesUsed_part_number").val(response[index].part_number);
        $("#SparesUsed_unit_price").val(response[index].sale_price);
        calculatetotal();
        $("#SparesUsed_quantity").focus();

    }///endo of function selectrow(index)


    $("#SparesUsed_quantity").keyup(function () {
        calculatetotal();
        showsubmitbutton();
    });

    $("#SparesUsed_item_name").keyup(function () {
        calculatetotal();
        showsubmitbutton();
    });


    $("#SparesUsed_unit_price").keyup(function () {
        calculatetotal();
    });





    function calculatetotal() {


        console.log('calculatetotal ');

        var qty = document.getElementById("SparesUsed_quantity").value;
        qty = converttoint(qty);
        console.log("qty : " + qty);

        var unit_price = document.getElementById("SparesUsed_unit_price").value;
        unit_price = converttoint(unit_price);
        console.log("unit_price : " + unit_price);


        total = qty*unit_price;
        console.log('calculatetotal ' + total);
        document.getElementById("SparesUsed_total_price").value = total;


    }///end of function calculatetotal(){

    function converttoint(val) {
        if (val != "" || val != null)
            return parseFloat(val) || 0;
        else
            return 0;

    }//end     function converttoint(val)


    function formatvalue(val){

        if (val==null || val===false)
            return '';
        else
            return val;
    }






    function showsubmitbutton()
    {

        var qty = document.getElementById("SparesUsed_quantity").value;
        qty = converttoint(qty);

        var item_nm = document.getElementById("SparesUsed_item_name").value;
        item_nm=item_nm.trim();


        if (qty==0)
        {
            $("#submitsparesformbtn").hide();
            $("#submiterror").show();
            $("#submiterror").text("Invalid value in Quantity");
            $("label[for = SparesUsed_quantity]").css("color", '#b94a48');
        }else
        {
            $("#submiterror").hide();
            $("#submitsparesformbtn").show();

        }

    }////end of  function showsubmitbutton()


    function additemnotinlist()
    {
        console.log("mNew Item");

        $("#sparesform").show();
        $("#SparesUsed_master_item_id").val(0);
        $("#SparesUsed_item_name").val("");
        $("#SparesUsed_part_number").val("");
        $("#SparesUsed_unit_price").val("");

    }////end of function additemnotinlist()



</script>







