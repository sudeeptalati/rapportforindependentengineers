/**
 * Created by sudeeptalati on 19/10/2016.
 */


function togglecustomereditbox() {
    $('#customer_view_block').toggle("slow");
    $('#customer_edit_block').toggle("slow");
}

function toggleproducteditbox() {
    $('#product_view_block').toggle("slow");
    $('#product_edit_block').toggle("slow");
}


function toggledocumentsmanualseditbox() {
    $('#documentsmanuals_view_block').toggle("slow");
    $('#documentsmanuals_edit_block').toggle("slow");


}

function togglesignatureeditbox() {
    $('#signature_view_block').toggle("slow");
    $('#signature_edit_block').toggle("slow");
}





function customerdetailsverified() {
    if (confirm('Are the customer details correct')) {
        // Save it!
        document.getElementById('customer_details_check_btn').style.color = "green";
        $('#customerbox').hide("slow");
        $('#productbox').show("slow");

    } else {
        togglecustomereditbox();

    }
}


function productdetailsverified() {
    if (confirm('Are the product details correct')) {
        // Save it!
        document.getElementById('product_details_check_btn').style.color = "green";
        $('#customerbox').hide("slow");
        $('#productbox').hide("slow");
        $('#documentsmanualsbox').show("slow");


    } else {
        toggleproducteditbox();

    }

}


function needtotakephotos() {

    if (confirm("Do you need to take photos of machine ?")) {
        // Save it!
        document.getElementById('photos_check_btn').style.color = "green";
        $('#documentsmanuals-uploadfile').click();
        toggledocumentsmanualseditbox();

    } else {

        $('#documentsmanualsbox').hide("slow");
        $('#servicecallbox').show("slow");
    }

}/////end of function needtotakephotos() {


function workcarriedoutadded() {


    if (confirm("Have you added the work carried out details?")) {
        // Save it!
        document.getElementById('service_check_btn').style.color = "green";

        $('#servicecallbox').hide("slow");
        $('#sparesbox').show("slow");

    } else {
        toggleservicecalleditbox();

    }
}///end of function workcarriedoutadded() {


function toggleservicecalleditbox() {
    $('#servicecall_view_block').hide("slow");
    $('#servicecall_edit_block').show("slow");
}


function sparesrequested() {

    if (confirm("Do you need to request any spares or have you marked spares as used ?")) {

        document.getElementById('spares_check_btn').style.color = "green";
        $('#sparesbox').hide("slow");
        $('#signaturebox').show("slow");


    } else {
        // Save it!
        togglespareseditbox();

    }

}///end of function sparesrequested() {

function togglespareseditbox() {
    $('#spares_view_block').show("slow");
    $('#spares_edit_block').show("slow");
}







//////////Spare parts

function formatitemvalue(val) {

    if (val == null || val === false)
        return '';
    else
        return val;
}


function formatoutputdata(response) {
    console.log("formatoutputdata" + response.length);

    for (i = 0; i < response.length; i++) {
        sparepart = response[i];
        console.log(sparepart.name);
    }


    $("#masteritems_table").empty();

    $("#masteritems_table").append("<tr><th>Name</th><th>Part Number</th><th>Last used Price</th></tr>");

    $(function () {
        $.each(response, function (i, item) {
            console.log(item);
            $('#masteritems_table').append('<tr id="rowno' + i + '" class="mytr" onclick="selectrow(     \' ' + item.id + '  \'    ,    \' ' + item.name + ' \'  , \' ' + item.part_number + ' \'      ) ">' +
                '<td><span style="color:#0088cc">' + formatitemvalue(item.name) + '</span></td>' +
                '<td> ' + formatitemvalue(item.part_number) + ' </td>' +
                '<td> ' + item.sale_price + ' </td>' +
                '</tr>');


        });
    });


}////end of function formatoutputdata(result_data)


function selectrow(master_item_id, item_nm, part_nm) {
    console.log("selected row" + item_nm);
    console.log("selected row" + part_nm);

    $(".mytr").css("background-color", "#FFFFFF");

    //$("#itemsearchdiv").hide();
    $("#request-sparepart-form").show();


    $("#sparesused-master_item_id").val(master_item_id);
    $("#sparesused-item_name").val(item_nm);
    $("#sparesused-part_number").val(part_nm);

    $("#searchitemwithkeyword").val("");


    $("#masteritems_table").empty();
    /*
     $("#result").hide();
     $("#sparesform").show();
     $("#rowno" + index).css("background-color", "#e6e6e6");


     $("#SparesUsed_master_item_id").val(response[index].master_id);
     $("#SparesUsed_item_name").val(response[index].name);
     $("#SparesUsed_part_number").val(response[index].part_number);
     $("#SparesUsed_unit_price").val(response[index].sale_price);
     calculatetotal();
     $("#SparesUsed_quantity").focus();
     */
}///endo of function selectrow(index)





