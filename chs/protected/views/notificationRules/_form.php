<?php

if(isset($_GET['system_msg']))
{
	echo $_GET['system_msg'];
}
?>



<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notification-rules-form',
	'enableAjaxValidation'=>false,
)); 

?>

<?php $jobstatuslist = JobStatus::model()->getAllStatuses();//listdata for dropdown ?>

	<div class="box">
		<table style="width:100%;   vertical-align: top;">
			<tr>
				<td>
				<label>When job status is changed to</label>
				<?php
						echo $form->dropDownList($model, 'job_status_id', $jobstatuslist ,
							 array(
									'prompt' => 'Please Select job status (required)',
									'value' => '0',
									'ajax'  => array(
											'type'  => 'POST',
											'url' => CController::createUrl('NotificationRules/notificationPresent/'),
											'data' => array("job_id" => "js:this.value"),
											'success'=> 'function(data) {
													if(data != "NULL")
													{
														alert(data);
														$("#form_save_button").attr("disabled", true);
													}
													else
													{
														$("#form_save_button").attr("disabled", false);
													}
												}',
											'error'=> 'function(){alert("AJAX call error..!!!!!!!!!!");}',
									)//end of ajax array().
						)//end of array
					);//end of dropDownList.
				?>

				</td>
				<td>
					<?php echo $form->labelEx($model,'active') ?>
					<?php echo $form->dropDownList($model, 'active', array('1'=>'Yes','0'=>'No')); ?><br>
					<small>For Scheduled Job Status, keep rule as inactive as Cron jobs automatically activates this rule</small>
				</td>
				<td><?php echo CHtml::submitButton($model->isNewRecord ? 'Set up this New rule' : 'Save the Rule',
						array('id'=>'form_save_button')); ?></td>

			</tr>
			<tr>
				<td colspan="3"><hr><b>Send Notification to</b></td>
			</tr>

			<tr>
				<td>
					Customer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php
						//EVENT LISTENER FOR CUSTOMER FIELD.
						Yii::app()->clientScript->registerScript('my-customer-listener',"
						$('#customer-checkbox-id').click(function() {
							$('.customer-form')[this.checked ? 'show' : 'hide']();
						});
						");

						?>
						<?php
							$customer_email_checked=NotificationRules::model()->getEmailCheckBoxStatus($model->customer_notification_code);
							$customer_sms_checked=NotificationRules::model()->getSMSCheckBoxStatus($model->customer_notification_code);

							if ($customer_email_checked || $customer_sms_checked)
								$customer_checked=true;
							else
								$customer_checked=false;
					?>

					<?php echo $form->checkbox($model, 'customer_notification_code', array('checked'=>$customer_checked,'id'=>'customer-checkbox-id')); ?>

					<div class="customer-form" style="display:none">
					by
						<small><b>Email</b></small>&nbsp;<?php echo CHtml::checkBox('customer_email_notification', $customer_email_checked, array('uncheckValue' => 0)); ?>
						&nbsp;&nbsp;<small><b>SMS</b></small>&nbsp;<?php echo CHtml::checkBox('customer_sms_notification', $customer_sms_checked, array('uncheckValue' => 0)); ?>
					</div>
	 
				</td>
				<td>Engineer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php
							//EVENT LISTENER FOR ENGINEER FIELD.
						Yii::app()->clientScript->registerScript('my-engineer-listener',"
						$('#engineer-checkbox-id').click(function() {
							$('.engineer-form')[this.checked ? 'show' : 'hide']();
						});
						");
					?>


					<?php
						$engineer_checked;

						$engineer_email_checked=NotificationRules::model()->getEmailCheckBoxStatus($model->engineer_notification_code);
						$engineer_sms_checked=NotificationRules::model()->getSMSCheckBoxStatus($model->engineer_notification_code);

						if ($engineer_email_checked || $engineer_sms_checked)
							$engineer_checked=true;
						else
							$engineer_checked=false;
					?>
					<?php echo $form->checkbox($model, 'engineer_notification_code', array('checked'=>$engineer_checked,'id'=>'engineer-checkbox-id')); ?>

					<div class="engineer-form" style="display:none">
					by <small><b>Email</b></small>&nbsp;<?php echo CHtml::checkBox('engineer_email_notification', $engineer_email_checked, array('uncheckValue' => 0)); ?>
					&nbsp;&nbsp;<small><b>SMS</b></small>&nbsp;<?php echo CHtml::checkBox('engineer_sms_notification', $engineer_sms_checked, array('uncheckValue' => 0)); ?>
					</div>
				</td>
				<td>
					<?php
						//EVENT LISTENER FOR WARRANTY PROVIDER FIELD.
						Yii::app()->clientScript->registerScript('my-warranty-provider-listener',"
						$('#warranty-provider-checkbox-id').click(function() {
							$('.warranty-provider-form')[this.checked ? 'show' : 'hide']();
						});
						");
					?>

					Warranty Provider&nbsp;&nbsp;
					<?php
						$warranty_provider_checked;

						$warranty_provider_email_checked=NotificationRules::model()->getEmailCheckBoxStatus($model->warranty_provider_notification_code);
						$warranty_provider_sms_checked=NotificationRules::model()->getSMSCheckBoxStatus($model->warranty_provider_notification_code);

						if ($warranty_provider_email_checked || $warranty_provider_sms_checked)
							$warranty_provider_checked=true;
						else
							$warranty_provider_checked=false;
					?>
					<?php echo $form->checkbox($model, 'warranty_provider_notification_code', array('checked'=>$warranty_provider_checked,'id'=>'warranty-provider-checkbox-id')); ?>
					<div class="warranty-provider-form" style="display:none">
						by <small><b>Email</b></small>&nbsp;<?php echo CHtml::checkBox('warranty_provider_email_notification', $warranty_provider_email_checked, array('uncheckValue' => 0)); ?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><b>SMS</b></small>&nbsp;<?php echo CHtml::checkBox('warranty_provider_sms_notification', $warranty_provider_sms_checked, array('uncheckValue' => 0)); ?>
					</div>
	
				</td>
			</tr>

			<!-- Notify Others -->
			<tr>
				<td colspan="3">
					<hr>
					<table>
					<tr>
						<td>
							<?php echo $form->labelEx($model,'notify_others') ?>
						</td>
						<td>
							<?php echo $form->dropDownList($model, 'notify_others', array('1'=>'Yes','0'=>'No')); ?><small class="cart">You need to save rule first before being able to add person</small><br>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<?php
								if ($model->notify_others==1)
									$display_div="block";
								else
									$display_div="none";
							?>



							<div id="notify_others_people" style="display:<?php echo $display_div;?>;">

								<div class="attention">
								<?php echo CHtml::link('Add More Person', '#', array(
									'onclick'=>'$("#addperson").dialog("open"); return false;',
								));
								?>
								</div>





								<!---Printing the existing added people --->


								<?php $contactModel = NotificationContact::model()->findAllByAttributes(array('notification_rule_id'=>$model->id ));?>
								<?php if(count($contactModel) != '0'): ?>
										<table style="margin-bottom:0px;">
											<tr>
												<th style="color:maroon">Person Name</th>
												<th style="color:maroon">Person Info</th>
												<th style="color:maroon">Email</th>
												<th style="color:maroon">Mobile</th>
												<th style="color:maroon">Notify By</th>
											</tr>
											<?php foreach ($contactModel as $data){ ?>
												<tr>
													<td><?php echo $data->person_name;?></td>
													<td><?php echo $data->person_info;?></td>
													<td><?php echo $data->email;?></td>
													<td><?php echo $data->mobile;?></td>
													<td><?php
														switch ($data->notification_code_id)
														{
															case 0:echo "None";
																break;

															case 1:echo "Email";
																break;

															case 2:echo "SMS";
																break;

															case 3:echo "Email and SMS";
																break;
														}//end of switch.
														?>
													</td>
													<!-- START OF SECOND COLUMN -->
													<td>
														<?php echo CHtml::link('Delete', array('/notificationContact/delete','id'=>$data->id));?>
													</td>
													<!-- END OF SECOND COLUMN -->
												</tr>

											<?php }///enf of foreach?>
										</table>
								<?php endif; ?>

							</div>
						</td>
					</tr>
				</table>
					<hr>
				</td>
			</tr>


			<!--End  Notify Others -->








			<tr>
				<td colspan="3">
					<table>
						<tr>
							<td>
								<?php echo $form->labelEx($model,'frequency') ?>
								<div id='frequecy_text' class="cart">
									<?php
									if ($model->frequency!='')
									{
										$rf=json_decode($model->frequency);
										echo "This rule is set to run <b>".$rf->frequency."</b> on every <b>".$rf->day."</b>";

									}//edn of if ($model->frequency!='')

									?>
								</div><?php echo CHtml::dropDownList('rulefrequency', '', array('daily'=>'Daily','weekly'=>'Weekly','monthly'=>'Monthly'), array('empty'=>array(''=>'Select'), 'onChange'=>'runthisrulefrequency()')); ?>
								<div id='day_or_week'></div>


							</td>
							<td>
								<br>
								<?php echo $form->textArea($model, 'frequency', array('readonly'=>'readonly', 'style'=>'width:370px;height:70px')); ?>

							</td>

						</tr>
					</table>
				</td>
			</tr>


				<?php

				$common_msg='Hello {CUSTOMER_NAME}{\n}{\n}
								The service status of your {PRODUCT} has been changed to {JOB_STATUS}.{\n}
								For any queries pls contact us at {YOUR_COMPANY_EMAIL} with service reference no. {SERVICE_REF_NO} {\n}{\n}
								Regards{\n}
								{YOUR_COMPANY_NAME}';

				if (empty($model->sms_template))
					$model->sms_template=$common_msg;


				if (empty($model->email_template))
					$model->email_template=$common_msg;



				?>
				<tr>
					<td colspan="3">
						<hr>
						<table>
							<tr>
								<td><h4>
									<span class="fa fa-comment" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;SMS Template
									</h4>
									<?php echo $form->textArea($model, 'sms_template', array('style'=>'width:300px;height:300px;')); ?>
								</td>
								<td><h4>
									<span class="fa fa-envelope" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;Email Template
									</h4>
									<?php echo $form->textArea($model, 'email_template', array('style'=>'width:300px;;height:300px;')); ?>
								</td>
							</tr>
						</table>
						<div class="cart">
							You can use following variables for Email or SMS templates.<br><br>
							<table   style="width:70%">
								<tr class="oddrow">
									<td>{CUSTOMER_NAME}</td><td>Customer Name</td>
								</tr>
								<tr class="evenrow">
									<td>{SERVICE_REF_NO}</td><td>Service Reference No</td>
								</tr>
								<tr class="oddrow">
									<td>{PRODUCT}</td><td>Product</td>
								</tr>
								<tr class="evenrow">
									<td>{JOB_STATUS}</td><td>Job Status</td>
								</tr>
								<tr class="oddrow">
									<td>{ENGINEER_NAME}</td><td>Engineer Name</td>
								</tr>
								<tr class="evenrow">
									<td>{WARRANTY_PROVIDER}</td><td>Warranty / Contract Name</td>
								</tr>
								<tr class="oddrow">
									<td>{DATE_OF_VISIT}</td><td>Appointment Date</td>
								</tr>
								<tr class="evenrow">
									<td>{VISIT_START_TIME}</td><td>Appointment Start Time</td>
								</tr>
								<tr class="oddrow">
									<td>{VISIT_END_TIME}</td><td>Appointment End Time</td>
								</tr>

								<tr class="evenrow">
									<td>{YOUR_COMPANY_NAME}</td><td>Your Company Name </td>
								</tr>
								<tr class="oddrow">
									<td>{YOUR_COMPANY_EMAIL}</td><td>Your Company Email</td>
								</tr>
								<tr class="evenrow">
									<td>{YOUR_COMPANY_TELEPHONE}</td><td>Your Company Telephone</td>
								</tr>
								<tr class="oddrow">
									<td>{\n}</td><td>For Starting a new line</td>
								</tr>
							</table>
						</div>

					</td>
				</tr>













			 <tr>
				<td colspan="3"><?php echo CHtml::submitButton($model->isNewRecord ? 'Set up this New rule' : 'Save the Rule',
																		array('id'=>'form_save_button')); ?>
				</td>
			 </tr>
 		</table>
	</div>
 <?php $this->endWidget(); ?>
	
</div><!-- form -->


<script>





	/**** CODE TO DISPLAY EMAIL AND SMS ON CHECK OF CHECKBOX, FOR ALL CHECKBOXES ******/

	$(function() {//code inside this function will run when the document is ready
		if($('#customer-checkbox-id').is(':checked'))
		{
			$('.customer-form').show();
		}
		if($('#engineer-checkbox-id').is(':checked'))
		{
			$('.engineer-form').show();
		}
		if($('#warranty-provider-checkbox-id').is(':checked'))
		{
			$('.warranty-provider-form').show();
		}

	});
	/**** END OF CODE TO DISPLAY EMAIL AND SMS ON CHECK OF CHECKBOX, FOR ALL CHECKBOXES ******/



	function runthisrulefrequency()
	{

		//days_in_week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
		days_in_month=['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28' ];
		daily_options=['Instantly','End of the Day'];

		rulefrequency=document.getElementById("rulefrequency").value;
		console.log("--runthisrulefrequency----"+rulefrequency);

		switch(rulefrequency) {
			case "daily":
				console.log("daily clicked");
				createdaysorweekdaydropdown(daily_options);
				break;


			case "weekly":
				console.log("weekly clicked");
				days_in_week=getweekdays();
				createdaysorweekdaydropdown(days_in_week);
				break;


			case "monthly":
				createdaysorweekdaydropdown(days_in_month);
				console.log("monthly clicked");
				break;
			default :
				console.log("default");

		}///end of switch





	}//end of runthisrulefrequency


	function createdaysorweekdaydropdown(listdata)
	{





		var select_day_or_weekday = document.createElement("Select");
		select_day_or_weekday.setAttribute("name", 'on_day_or_weekday');
		select_day_or_weekday.setAttribute("id", 'on_day_or_weekday');

		for(var i = 0; i < listdata.length; i++) {

			var opt = document.createElement('option');
			opt.innerHTML = listdata[i];
			opt.value =i;
			select_day_or_weekday.appendChild(opt);
			//console.log("*****createDropdynamicselecDown*******"+listdata[i]);

		}
		select_day_or_weekday.selectedIndex=0;
		select_day_or_weekday.setAttribute("onchange", "createthefrequencyrule()");


		var day_or_week_div = document.getElementById("day_or_week");

		///clearing the existing ones first
		while (day_or_week_div.hasChildNodes()) {
			day_or_week_div.removeChild(day_or_week_div.lastChild);
		}
		day_or_week_div.appendChild(select_day_or_weekday);

		createthefrequencyrule();
	}///end of 	function createdaysorweeksdropdown()




	function createthefrequencyrule()
	{

		frequency_every=document.getElementById("rulefrequency").value;
		weekday_index=document.getElementById("on_day_or_weekday").value;

		weekdays_array=getweekdays();

		//in javascript week starts from ~Sunday = 0 to Saturday = 6

		last_run=calculateNextdateforday(weekday_index, frequency_every);
		last_run_date=formatdate(last_run);
		next_run_date=last_run_date;

		if (frequency_every=='daily')
			run_this_day_or_weekday="daily";

		if (frequency_every=='weekly')
			run_this_day_or_weekday=weekdays_array[weekday_index];

		if (frequency_every=='monthly')
		{
			s_day=parseInt(weekday_index);
			run_this_day_or_weekday=s_day+1; ///as our dropdown indexon main page starts from zero

		}

		frequency={"frequency":frequency_every , "day": run_this_day_or_weekday, "performed":"false", "last_run":last_run_date, "next_run": next_run_date };

		document.getElementById("NotificationRules_frequency").value=	JSON.stringify(frequency);
		document.getElementById("frequecy_text").innerHTML="I want to run this rule <b>"+frequency_every+"</b> on every <b>"+run_this_day_or_weekday+"</b>";
		document.getElementById("NotificationRules_frequency").style.width = "370px";

	}///end of function createtherule()



	function calculateNextdateforday(selected_day, type)
	{
		//console.log("*********************************************************+");
		var nextday=new Date();
		selected_wd = parseInt(selected_day);
		selected_wd_operation =selected_wd +1;

		aajkadin=new Date();


		no_of_days_to_be_addded=0;

		if (type=="monthly")
		{
			console.log("Monthly Selectde");
			console.log("Day of Month"+selected_wd_operation);

			console.log("toady date"+aajkadin.getDate());

			today_date=aajkadin.getDate();

			if (today_date>selected_wd_operation)
			{
				//next month

				var d= selected_wd_operation;
				var m= aajkadin.getMonth();
				var y= aajkadin.getFullYear();

				if (m==11)
				{
					y=y+1;
					m=0;
				}

				console.log("Month is "+m);
				console.log("Month is "+getmonthnamebyint(m));
				tarik=d+" "+getmonthnamebyint(m)+" "+y;

			}else
			{	///this month
				var d= selected_wd_operation;
				var m= aajkadin.getMonth();
				var y= aajkadin.getFullYear();

				tarik=d+" "+getmonthnamebyint(m)+" "+y;
			}
			console.log("Netx month Taaroik "+tarik)
			nextday=new Date(tarik);
		}

		if (type=='weekly')
		{



			td_wd=aajkadin.getDay();
			operation_td_wd=td_wd+1;

			//console.log("today is"+aajkadin);


			//console.log("Selected Weekday  is "+weekday);
		//	console.log("Selected operation_wd  is "+selected_wd );
			//console.log("Selected Weekday  is "+getdaybyint(weekday));

			//console.log("today Weekday  is "+td_wd);
			//console.log("today operation_td_wd  is "+operation_td_wd);
			//console.log("today Weekday  is "+getdaybyint(td_wd));



			if (operation_td_wd==selected_wd_operation )
			{
				no_of_days_to_be_addded=0;
			}

			if (operation_td_wd<selected_wd_operation )
			{
				no_of_days_to_be_addded=selected_wd_operation-operation_td_wd;
				//console.log("TD weekday is smmaler OPERATION is no_of_days_to_be_addded="+selected_wd_operation +"-"+operation_td_wd);
			}


			if (operation_td_wd>selected_wd_operation )
			{
				no_of_days_to_be_addded=7-(operation_td_wd-selected_wd_operation);
				//console.log("TD weekday is bigger  OPERATION is no_of_days_to_be_addded= 7 -("+operation_td_wd +"-"+selected_wd_operation+")");

			}

			nextday.setDate(aajkadin.getDate() + no_of_days_to_be_addded);

			//console.log("no_of_days_to_be_addded is  "+no_of_days_to_be_addded);
			//console.log("nextday is"+nextday);
		}///end of if type==weekly
		return nextday;
	}///end of function calculateNextdateforday(day)

	function getweekdays()
	{
		var weekday = new Array(7);
		weekday[0]=  "Sunday";
		weekday[1] = "Monday";
		weekday[2] = "Tuesday";
		weekday[3] = "Wednesday";
		weekday[4] = "Thursday";
		weekday[5] = "Friday";
		weekday[6] = "Saturday";

		return weekday;
	}//end of function getweekdays

	function getdaybyint(i)
	{
		w=getweekdays();
		return w[i];
	}////end of function getdaybyint(i)


	function getmonthsarray()
	{
		var month_names = ["January", "February", "March", "April", "May", "June",
			"July", "August", "September", "October", "November", "December"
		];

		return month_names;
	}//end of function getmonthsarray


	function getmonthnamebyint(i)
	{
		m=getmonthsarray();
		return m[i];
	}////end of function getmonthnamebyint(i)

	function formatdate(d)
	{
		var weekday= getdaybyint(d.getDay());

		var date= d.getDate();
		var monthInt= d.getMonth();
		var year= d.getFullYear();

		var hh = d.getHours();
		var mm = d.getMinutes();
		var ss = d.getSeconds();

		//formatted_date=weekday+", "+date+"-"+getmonthnamebyint(monthInt)+"-"+year+" "+hh+":"+mm+":"+ss;
		formatted_date=weekday+", "+date+"-"+getmonthnamebyint(monthInt)+"-"+year+"";
		return formatted_date;
	}

</script>

<!-- This is created at bottom of page as a single page can't have two form tags within each pther -->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
	'id'=>'addperson',
	// additional javascript options for the dialog plugin
	'options'=>array(
		'title'=>'Add Person',
		'autoOpen'=>false,
		'modal'=>true,
	),
));

echo $this->renderPartial('addotherperson', array('notification_rule_id'=>$model->id));

$this->endWidget('zii.widgets.jui.CJuiDialog');



?>