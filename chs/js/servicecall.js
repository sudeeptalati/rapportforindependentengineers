/**
 * Created by sudeeptalati on 25/10/2016.
 */



if ( $( "#admintimer" ).length ) {
    var seconds = 0, minutes = 0, hours = 0, countingseconds=0,
        t;
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
    document.getElementById('Servicecall_time_spent_on_call_now').value=countingseconds;
    //timer();

    updateafterseconds=10;
    remainder=countingseconds%updateafterseconds;
    //console.log('remainder'+remainder);

    if (remainder===0)
    {
        updateadmintimeforservicecall(updateafterseconds);
    }
}



function timer() {

    t = setTimeout(add, 1000);
    t = setTimeout(countseconds,1000);

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
        document.getElementById('timespentoncall').innerHTML =data;
    })

        .fail(function() {
            console.log( "Could not update call admin time" );
        })

}///function updateadmintimeforservicecall()
