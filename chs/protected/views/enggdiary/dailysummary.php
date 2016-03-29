<h2 align="center">Call Summary Sheet-
<?php $engineer = Engineer::model()->findByPk($engineer_id);
echo $engineer->first_name; ?></h2>
<?php
	echo '<h3 align="center">'.date('l, d-F-Y', strtotime($summary_date)).'</h3>';
	$summarydate=strtotime($summary_date);
	//echo $summarydate;
	
?>
<b>Please phone from site where any job is not completed not just spares orders</b>
	
	
<table width= 100%;>
<tr>
	
	<th style='border: 1px solid DARKSEAGREEN; background-color: DARKSEAGREEN;
    color: white;'> Time</th>
	<th style='border: 1px solid DARKSEAGREEN; background-color: DARKSEAGREEN;
    color: white;'> Name</th>
	<th style='border: 1px solid DARKSEAGREEN; background-color: DARKSEAGREEN;
    color: white;'> Address</th>
	<th style='border: 1px solid DARKSEAGREEN; background-color: DARKSEAGREEN;
    color: white;'> Type</th>
	<th style='border: 1px solid DARKSEAGREEN; background-color: DARKSEAGREEN;
    color: white;'> Telephone</th>
	<th style='border: 1px solid DARKSEAGREEN; background-color: DARKSEAGREEN;
    color: white;'> Product</th>
	<th style='border: 1px solid DARKSEAGREEN; background-color: DARKSEAGREEN;
    color: white;'> Spares</th>

</tr>


<?php
	///step 1
	//get all jobs by date and engineer_id 1442268000
	
	$result=Enggdiary::model()->fetchDiaryDetails($engineer_id ,$summarydate);	
	
	foreach ($result as $r)
	{
			$servicecall=Servicecall::model()->findByPk($r->servicecall_id);
			
			echo '<tr>';
			//echo '<hr>'.$r->servicecall_id;
					
			//echo "<td style='border: 1px solid DARKSEAGREEN; '> ".$servicecall->service_reference_number."</td>";
			if (isset($r->visit_start_date))
			{ 
				//echo date('l, j-F-Y', $r->visit_start_date);
				echo "<td style='border: 1px solid DARKSEAGREEN;'><b>".date('g:i a', $r->visit_start_date).' -'.date( 'g:i a', $r->visit_end_date)."</b></td>";
			}
			
			echo "<td style='border: 1px solid DARKSEAGREEN; '>".$servicecall->customer->fullname."</td>";
			echo "<td style='border: 1px solid DARKSEAGREEN; '> ".$servicecall->customer->postcode."</td>";
			echo "<td style='border: 1px solid DARKSEAGREEN; '> ".$servicecall->contract->name."</td>";
			echo "<td style='border: 1px solid DARKSEAGREEN; '> ".$servicecall->customer->mobile;
			echo "<br> <style='border: 1px solid DARKSEAGREEN; '> ".$servicecall->customer->telephone."</td>";
			echo "<td style='border: 1px solid DARKSEAGREEN; '> ".$servicecall->product->brand->name." ".$servicecall->product->productType->name."</td>";
			
			
			echo "<td style='border: 1px solid DARKSEAGREEN; '>";
				$sparesModel = SparesUsed::model()->findAllByAttributes(array('servicecall_id'=> $r->servicecall_id));
				foreach ($sparesModel as $data)
				{	
					if($data->part_number==null)
					{
					echo "<br> ".$data->item_name;
					}
					else
					{
					echo "<br> ".$data->part_number."-".$data->item_name;
					}
				}
			echo "</td>";
			
			echo '</tr>';

			
			
	}


	
	
	//echo $engineer_id;
?>

</table>
<h4>Additional Hours Worked-</h4>