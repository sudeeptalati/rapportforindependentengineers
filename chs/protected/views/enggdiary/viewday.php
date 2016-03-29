<link href='js/fullcalendar2/fullcalendar.css' rel='stylesheet' />
<link href='js/fullcalendar2/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='js/fullcalendar2/lib/moment.min.js'></script> 
<script src='js/fullcalendar2/fullcalendar.min.js'></script>


<?php $baseUrl=Yii::app()->request->baseUrl; ?>

<script>

var baseUrl='<?php echo $baseUrl; ?>';
var engineer_id = '<?php echo $engineer_id;?>';
var selected_date_str = '<?php echo $selected_date_str;?>';

var dataUrl  =  baseUrl+'/index.php?r=enggdiary/getdiaryofengineerfordate&engineer_id='+engineer_id+'&date='+selected_date_str;
	
	
$(document).ready(function() {

    // page is now ready, initialize the calendar...

    $('#calendar').fullCalendar({
	 
		header: {
				left: '',
				center: 'title',
				right: ''
			},
		defaultDate: selected_date_str,
      	defaultView: 'agendaDay',
      	height: 1200,
    	slotDuration:'00:15:00',
    	slotEventOverlap:false,
      	
      	
		editable: true,
		events:dataUrl,
		
	    eventResize: function(event, delta, revertFunc) {
    	    
    	    if (confirm("Are you sure about this change?")) {
				newstarttime=event.start.format("YYYY-MM-DD HH:mm");
    	       	newendtime=event.end.format("YYYY-MM-DD HH:mm");
    	        updatediaryschedule(event.id, newstarttime, newendtime );
    	    }else
			{
			    revertFunc(); //call back function
			}
	    },//end of event Resize

			
		eventDrop: function(event, delta, revertFunc) {

	        if (confirm("Are you sure about this change?")) {
	        	newstarttime=event.start.format("YYYY-MM-DD HH:mm");
    	       	newendtime=event.end.format("YYYY-MM-DD HH:mm");
    	        updatediaryschedule(event.id, newstarttime, newendtime );
    	    }else
    		{
    		    revertFunc(); //call back function
    		}

		},//end of eventDrop.

    })

});






	function updatediaryschedule(diary_id, starttime, endtime )
    {
    	
     
	     var updateUrl= baseUrl+'/index.php?r=enggdiary/updatescheduleindiary&diary_id='+diary_id+'&visit_start_date='+starttime+'&visit_end_date='+endtime;
	     console.log(updateUrl);
	     $.ajax({
        	type: 'GET',
            url: updateUrl ,
          success: function(data) 
          { 
	          console.log('Appointment'+data);
	          //document.getElementById("routedetail").style.display = "none";
	          
	          refreshiframe();

	      },
          error: function()
          {
	       	//alert("Error in updating");
  	       	alert('Cannot update previous Appointments'); 
          }
          });

    }//end of getResponse func().


	function refreshiframe()
	{	
		document.getElementById("save_revert_control").style.display = "block";
		iframe = document.getElementById('routeiframe');
		iframe.src = iframe.src;
	}///end of 	function refreshiframe()

  
    
	 
	 
	
	 
 </script>
 
 
 
  
<!-- Dialog Start--> 
<?php 
	
	$route_on_googlemap_link=Yii::app()->createUrl('/enggdiary/markrouteongooglemap', array('engineer_id'=>$engineer_id,'route_date'=>$selected_date_str)); 
	$savebutton= CHtml::link(' ',array('/enggdiary/optimiseroutebygoogleapi',
										'engineer_id'=>$engineer_id,
										'route_date'=>$selected_date_str,
										'planroute'=>'0'), 
								array( 'class'=>'fa fa-save fa-3x',
								 		'title'=>'Save Route Order',
								));
								
	$googleoptimisedroutebutton= CHtml::link(' ',array('/enggdiary/optimiseroutebygoogleapi',
										'engineer_id'=>$engineer_id,
										'route_date'=>$selected_date_str,
										'planroute'=>'1'), 
								array( 'class'=>'fa fa-road fa-3x',
								 		'title'=>'Revert To Google Optimised Route Order',
								 		'onclick'=>'javascript: return confirm("This will update your diary. Are you sure you want to continue  ?");'
								));
								
								
	$showmap= CHtml::link(' ', '#', array(
						   'onclick'=>'$("#routemap").dialog("open"); refreshiframe();return false;',
						   'class'=>'fa fa-map-marker fa-3x',
						   'title'=>'Map Route'
						));
						
						
							
		
?>
<?php	
 
		 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'routemap',
      
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Route Map',
        'autoOpen'=>false,
        'modal'=>false,
		'width'=>800,
		'height'=>1000,
		'position'=> 'right top',
		 
 

  
    ),
));
?>
 
<iframe id='routeiframe' width="800" height="1000" src=<?php echo $route_on_googlemap_link; ?> ></iframe>
 
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
 
<!-- Dialog End --> 

 <div  style='float: left; display:none;'   id='save_revert_control'>
	<div style='float: left; width:100px;'><?php echo $savebutton; ?></div>	
 	
 </div>
 <div style='float: left; width:100px;'><?php echo $googleoptimisedroutebutton; ?></div>	
 <div style='float: left; width:100px;'><?php echo $showmap; ?></div>	
 
 

 <table>
 	<tr>
 		<td>
	 		 <div id='calendar'></div>
 		</td>
 		<td>
				<?php //echo $showmap; ?>
			
		</td>
	</tr>
</table> 		
 <?php echo $showmap; ?>
  


 