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


function toggleservicecalleditbox() {
    $('#servicecall_view_block').hide("slow");
    $('#servicecall_edit_block').show("slow");
}

function toggledocumentsmanualseditbox() {
    $('#documentsmanuals_view_block').toggle("slow");
    $('#documentsmanuals_edit_block').toggle("slow");
}

function togglespareseditbox() {
    $('#spares_view_block').toggle("slow");
    $('#spares_edit_block').toggle("slow");
}


function togglesignatureeditbox() {
    $('#signature_view_block').toggle("slow");
    $('#signature_edit_block').toggle("slow");
}


function togglejobstatusdropdownblock()
{
    $('#job_status_dropdown_block').toggle("slow");

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
        toggledocumentsmanualseditbox();
        $('#documentsmanuals-uploadfile').click();


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









//////////Spare parts

function formatitemvalue(val) {

    if (val == null || val === false)
        return '';
    else
        return val;
}


function formatoutputdata(response) {
    //console.log("formatoutputdata" + response);

	var json_obj = jQuery.parseJSON(response);
 	$("#masteritems_table").empty();

    $("#masteritems_table").append("<tr><th>Name</th><th>Part Number</th><th>Last used Price</th></tr>");

    for (i = 0; i < json_obj.length; i++) {
        item = json_obj[i];
        console.log("SPARENAME: "+item.name);
        
         $('#masteritems_table').append('<tr id="rowno' + i + '" class="mytr" onclick="selectrow(     \' ' + item.id + '  \'    ,    \' ' + item.name + ' \' ,    \' ' + item.part_number + ' \'   , \' ' + item.sale_price + ' \'      ) ">' +
                '<td><span style="color:#0088cc">' + formatitemvalue(item.name) + '</span></td>' +
                '<td> ' + formatitemvalue(item.part_number) + ' </td>' +
                '<td> ' + item.sale_price + ' </td>' +
                '</tr>');
                
                
    }
	
	/*
    $(function () {
        $.each(response, function (i, item) {
            console.log("ITEM IS "+item);
            
            $('#masteritems_table').append('<tr id="rowno' + i + '" class="mytr" onclick="selectrow(     \' ' + item.id + '  \'    ,    \' ' + item.name + ' \'  , \' ' + item.part_number + ' \'      ) ">' +
                '<td><span style="color:#0088cc">' + formatitemvalue(item.name) + '</span></td>' +
                '<td> ' + formatitemvalue(item.part_number) + ' </td>' +
                '<td> ' + item.sale_price + ' </td>' +
                '</tr>');

		 
        });
    });
	*/

}////end of function formatoutputdata(result_data)


function selectrow(master_item_id, item_nm, part_nm, sale_price) {
    console.log("selected row" + item_nm);
    console.log("selected row" + part_nm);

    $(".mytr").css("background-color", "#FFFFFF");

    //$("#itemsearchdiv").hide();
    $("#request-sparepart-form").show();


    $("#sparesused-master_item_id").val(master_item_id);
    $("#sparesused-item_name").val(item_nm);
    $("#sparesused-part_number").val(part_nm);
  	$("#sparesused-unit_price").val(sale_price);

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




//////////Duration of Appointment

if ( $( "#admintimer" ).length ) {
    var seconds = 0, minutes = 0, hours = 0, countingseconds=0,
        t;


    total_seconds=$( "#duration_of_call_already_captured" ).val();
    seconds= total_seconds % 60;
    minutes = Math.floor(total_seconds / 60);
    hours = Math.floor(total_seconds / 3600);

    timer();

}


function add() {
    seconds++;

    if (seconds >= 60) {
        seconds = 0;
        minutes++;
        if (minutes >= 60) {
            minutes = 0;
            hours++;
        }
    }

    document.getElementById('admintimer').innerHTML = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);

    timer();
}

function countseconds()
{
    countingseconds++;
    //document.getElementById('Servicecall_time_spent_on_call_now').value=countingseconds;
    //timer();

    updateafterseconds=10;
    remainder=countingseconds%updateafterseconds;
    //console.log('remainder'+remainder);

    if (remainder===0)
    {
    	/*
        end = new Date().getTime();
        dur= end - start;
        console.log(end-start);
        */
        
        //dur=10000;
        //updatedurationofappointment(duration_url, dur );
        //var start = new Date().getTime();
    }
}



function timer() {

    t = setTimeout(add, 1000);
    t = setTimeout(countseconds,1000);

    /*
    if (countingseconds==900)
    {
        if (confirm("This job has been open for more than 15 minutes!. Were you looking some stuff for this job?"))
        {
            countingseconds=countingseconds;
        }else
        {
            countingseconds=0;
        }
        alert("Thank you. This helps to calculate the admin time on a job! ");
    }
    */

}



function updatedurationofappointment(dur_url, duration )
{

    diary_id =$("#enggdiary_id").val();

    data={'duration_in_seconds': duration, enggdiary_id:diary_id};

    console.log("data Posted"+duration);
	console.log("data dur_url"+dur_url);
	
	
	get_url=dur_url+"&duration_in_seconds="+duration+"&enggdiary_id="+diary_id;
	window.open(get_url);
	 /*
  
    $.ajax({
        type: "GET",
        url: dur_url,
        data: data,
        success:function(result){
            console.log("Successfully Posted"+result);

            $("#timespentoncall").html(result);

        }
    });
     */
}

var start = new Date().getTime();
var duration_url =$("#update_dur_url").val();


 
var isOnIOS = navigator.userAgent.match(/iPad/i)|| navigator.userAgent.match(/iPhone/i);
var eventName = isOnIOS ? "pagehide" : "beforeunload";


function calculateduration()
{
    end = new Date().getTime();
    dur= end - start;
    console.log('Unliading pgage');
    return dur;
}



window.onfocus = function() {   

miliseconds_passed=calculateduration(); 
seconds_passed = (miliseconds_passed/1000) % 60;
console.log("comming after"+seconds_passed);

};
  
window.addEventListener(eventName, function (event) { 
	 
	console.log("Unload is called");

	dur=calculateduration();
    updatedurationofappointment(duration_url, dur );

});

 