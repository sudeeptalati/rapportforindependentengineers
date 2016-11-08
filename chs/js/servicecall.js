/**
 * Created by sudeeptalati on 25/10/2016.
 */



if ( $( "#admintimer" ).length ) {
    var seconds = 0, minutes = 0, hours = 0, countingseconds=0,
        t;


    total_seconds=$( "#admin_time_in_seconds_spent_on_servicecall" ).val();

    seconds= total_seconds % 60;
    minutes = Math.floor(total_seconds / 60);
    hours = Math.floor(total_seconds / 3600);


    timer();

}

function add() {

    countingseconds++;

    //console.log('Counting Seconds'+countingseconds);
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






function timer() {

    t = setTimeout(add, 1000);

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



}


function updateadmintimeforservicecall(secondspassed)
{
    servicecall_id=document.getElementById('Servicecall_id').value;
    timerupdateurl=document.getElementById('timerupdateurl').value;

    timerupdateurl=timerupdateurl+'&servicecall_id='+servicecall_id+'&admintime='+secondspassed;

    //console.log('Seconds Passed'+timerupdateurl);
     var d = new Date();
    //console.log('Servicecall Id'+d);


    $.post( timerupdateurl, function(data) {
        console.log( "success" +data);
        //document.getElementById('timespentoncall').innerHTML =data;
    })

        .fail(function() {
            console.log( "Could not update call admin time" );
        })

}///function updateadmintimeforservicecall()




var start;
var duration_url =$("#update_dur_url").val();

$(document).ready(function() {
    start = new Date().getTime();


});


$(window).on('beforeunload', function(){


    end = new Date().getTime();
    dur= end - start;
    console.log('Unliading pgage');
    updateadmintimeforservicecall( dur );

});