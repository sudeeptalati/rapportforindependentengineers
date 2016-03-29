<?php


header("Cache-Control: public");
header("Content-Description: File Transfer");
//header("Content-Disposition: attachment; filename=$file");
header("Content-Transfer-Encoding: binary");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header( "Content-Type: application/vnd.ms-excel; charset=utf-8" );
header( "Content-Disposition: inline; filename=\"Engineer Report  ".date("F j, Y").".xls\"" );


$dataProvider = $criteriaData;
$dataProvider->pagination = false;

?>
        <table border="1"> 
        <tr>
			<th>COMPANY NAME </th>
			<th>JOB NUMBER</th>
			<th>TOTAL COST</th>
			<th>X = VAT REGISTERED (UK USE ONLY)</th>
			<th>INDEX CODE</th>
			<th>SERIAL NUMBER</th>
			<th>CUSTOMER NAME</th>
			<th>ADDRESS</th>
			<th>RETAILER NAME</th>
			<th>MODEL NUMBER</th>
			<th>GROUP </th>
			<th>GROUP 1 </th>
			<th>SUPPLIER </th>
			<th>Date OF PURCHASE</th>
			<th>DATE RAISED</th>
			<th>COMPLETED DATE</th>
			<th>WARRANTY DAY</th>
			<th>SPEED</th>
			<th>CLAIM DESCRIPTION- CUSTOMER </th>
			<th>FAULT CODE</th>
			<th>CLAIM DESCRIPTION-ENGINEER</th>
			<th>UPLIFT NO</th>
			<th>REASON FOR UPLIFT</th>
			<th>WORK SUMMARY</th>
			<th>Job Status</th>
			<th>Spares Part Number</th>
			<th>Quantity</th>
			<th>Price</th>
			
			 
			
			
		</tr>
		<?php 
		foreach( $dataProvider->data as $data )
		{
		?>
			<tr> 
				<td><?php echo $data->engineer->company;?></td>
				<td><?php echo $data->service_reference_number;?></td>
				<td><?php echo $data->net_cost;?></td>
				<td></td>
				<td><?php echo $data->product->enr_number;?></td>
				<td><?php echo $data->product->serial_number;?></td>
				<td><?php echo $data->customer->fullname;?></td>
				<td><?php 
							echo $data->customer->address_line_1;
							echo "\n".$data->customer->address_line_2;
							echo "\n".$data->customer->address_line_3;
							echo "\n".$data->customer->town;
							echo "\n".$data->customer->postcode ;
					?>
				</td>
				<td><?php echo $data->product->purchased_from;?></td>
				<td><?php echo $data->product->model_number;?></td>
				<td></td>
				<td></td>
				<td></td>
				<td><?php 
						if (!empty($data->product->purchase_date)){
								echo date('d-M-Y',$data->product->purchase_date);
							}
						?>
				</td>
				<td><?php 
						if (!empty($data->fault_date)){
								echo date('d-M-Y',$data->fault_date);
							}
						?>
				</td>
				<td><?php 
						if (!empty($data->job_finished_date)){
								echo date('d-M-Y',$data->job_finished_date);
							}
						?>
				</td>
				<td></td>
				<td></td>
				<td><?php echo $data->fault_description;?></td>
				<td><?php echo $data->fault_code ;?></td>
				<td><?php echo $data->work_carried_out;?></td>
				<?php
					
					$uplift_number=''	;
					$reason_for_uplift='';
				
					$uplift=Uplifts::model()->findByAttributes(array('servicecall_id'=>$data->id));
					
					if ($uplift)	
					{
						$uplift_number= 	$uplift->uplift_number;
						$reason_for_uplift=$uplift->reason_for_uplift;
					
					}
				 			
					
					?>
				
				
				<td><?php echo $uplift_number; ?></td>
				<td><?php echo $reason_for_uplift; ?></td>
				<td><?php echo $data->work_summary;?></td>
				<td><?php echo $data->jobStatus->name;?></td>
				<?php
				
				if ($data->spares_used_status_id==1)
				{
				
					$spares=SparesUsed::model()->findByAttributes(array('servicecall_id'=>$data->id));
				
					if ($spares)
					{
					?>
					<td><?php echo $spares->part_number; ?></td>
					<td><?php echo $spares->quantity; ?></td>
					<td><?php echo $spares->unit_price; ?></td>
					
					
					<?php
					}
				
				
				}
				?> 
				
				
				
				
			</tr>
        
        <?php }//end of foreach($dataProvider); ?> 
		
		</table>