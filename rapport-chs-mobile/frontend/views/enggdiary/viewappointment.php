<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 14/10/2016
 * Time: 16:41
 */

use common\models\Documentsmanuals;
use common\models\Handyfunctions;
use common\models\Product;
use common\models\Sparesused;
use common\models\Jobstatus;
use common\models\Changeservicecallstatus;
use frontend\assets\LocateAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

LocateAsset::register($this);


$this->title = 'Service Call';

$customer_address_html = Handyfunctions::formataddressinhtml(
    $servicecall->customer->address_line_1,
    $servicecall->customer->address_line_2,
    $servicecall->customer->address_line_3,
    $servicecall->customer->town,
    $servicecall->customer->postcode
);


$customer_block = 'none';
if (Yii::$app->getRequest()->get('customer_block'))
    $customer_block = 'block';


$product_block = 'none';
if (Yii::$app->getRequest()->get('product_block'))
    $product_block = 'block';

$docs_manuals_block = 'none';
if (Yii::$app->getRequest()->get('docs_manuals_block'))
    $docs_manuals_block = 'block';

$servicecall_block = 'none';
if (Yii::$app->getRequest()->get('servicecall_block'))
    $servicecall_block = 'block';

$spares_block = 'none';
if (Yii::$app->getRequest()->get('spares_block'))
    $spares_block = 'block';

$signature_block = 'none';
if (Yii::$app->getRequest()->get('signature_block'))
    $signature_block = 'block';


$email_servicecall_block = 'none';
if (Yii::$app->getRequest()->get('email_servicecall_block'))
    $email_servicecall_block = 'block';


?>




<h1 title="Recording Time Spent on this call" class="runningtimer">
    <i class="fa fa-clock-o" aria-hidden="true"></i>
    <span id="admintimer"><?php echo Handyfunctions::convertsecondstoduration($enggdiary->duration_of_call); ?></span>
</h1>




<?php

$update_dur_url = Url::toRoute(['enggdiary/updatedurationofappointment']);

$jobsheet_url=Url::to(['servicecall/jobsheet', 'id' => $servicecall->id]);

?>

<input id="duration_of_call_already_captured" value="<?php echo $enggdiary->duration_of_call; ?>" type="hidden"/>
<input id="update_dur_url" value="<?php echo $update_dur_url; ?>" type="hidden"/>
<input id="enggdiary_id" value="<?php echo $enggdiary->id; ?>" type="hidden"/>

<table class="full_width">
	<tr>
		<td colspan='2'>
			<h2 class="text-center">
				<?php echo Handyfunctions::format_date($enggdiary->visit_start_date);?>
			</h2>
		</td>
	</tr>
	<tr>
		<td style="width:50%">
			<h4 class="cart contentbox">
    			<?php echo Handyfunctions::format_time($enggdiary->visit_start_date); ?>
    				-
    			<?php echo Handyfunctions::format_time($enggdiary->visit_end_date); ?>
			</h4>
		</td>

		<td style="width:50%">
			<h4 style="text-align:right" class="camera contentbox">
				<a href="<?php echo $jobsheet_url;?>" target="_blank">
                	<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                	#<?php echo $servicecall->service_reference_number; ?>
                </a>
			</h4>
		</td>
	</tr>
</table>
<div id="diary_notes" class="mobile_content">
	<i class="fa fa-sticky-note-o" aria-hidden="true"></i>
	<?php echo $enggdiary->notes; ?>
</div>
<br>
<?= Html::button('Customer', ['class' => 'btn-lg customerheadingbox white_color full_width', 'onclick' => '(function ( $event ) { $("#customerbox").toggle("slow"); })();']); ?>
<div id="customerbox" class="customerbox contentbox" style="display: <?php echo $customer_block; ?>">

    <?= Html::button('<i class="fa fa-user fa-2x" aria-hidden="true"></i>', ['class' => 'btn btn-info', 'id' => 'customer_edit_btn', 'onclick' => '(function ( $event ) {  togglecustomereditbox(); })();']); ?>
    <div id="customer_edit_block" style="display: none  ;">


        <?php echo $this->render('//customer/editcustomeronly', [
                'enggdiary_id' => $enggdiary->id,
                'customer_id' => $servicecall->customer_id,
                'servicecall_id' => $servicecall->id
            ]
        ); ?>

    </div><!-- <div id="customer_edit_block" end of customer_edit_block -->


    <div id="customer_view_block">

        <table class="full_width responsive-stacked-table">
            <tr>
                <td>
                    <div class="mobile_title">
                        <?php echo $servicecall->customer->fullname; ?>
                    </div>
                    <div class="mobile_address">
                        <?php echo $customer_address_html; ?>
                    </div>
                </td>
                <td>
                    <div class="mobile_title">
                        <i class="fa fa-mobile"></i>
                        <?php echo Handyfunctions::get_telephone_link($servicecall->customer->mobile); ?>
                        </a>
                    </div>
                    <br>

                    <div class="mobile_title">
                        <i class="fa fa-phone"></i>
                        <?php echo Handyfunctions::get_telephone_link($servicecall->customer->telephone); ?>
                    </div>
                    <br>

                    <div class="mobile_title">
                        <i class="fa fa-envelope"></i>
                        <?php echo $servicecall->customer->email; ?>
                    </div>
                    <br>


                    <div class="mobile_title">
                        <i class="fa fa-car"></i>
                        <?php echo $servicecall->customer->fax; ?>
                    </div>
                </td>
                <td>
                    <div class="mobile_content_title">
                        <i class="fa fa-sticky-note-o" aria-hidden="true"></i> Notes
                    </div>
                    <div class="mobile_content">
                        <?php echo $servicecall->customer->notes; ?>
                    </div>
                </td>
                <td>
                    <button id="customer_details_check_btn" class="btn-clear" style="float: right; color:grey;"
                            onclick="customerdetailsverified();">
                        <i class="fa fa-check-circle fa-2x" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
        </table>
    </div>
</div>
<!-- end of Div customerbox  -->
<br><br>


<!-- Product Section -->
<?php $product_model_for_label = new Product(); ?>

<?= Html::button('Product', ['class' => 'btn-lg productheadingbox white_color full_width', 'onclick' => '(function ( $event ) { $("#productbox").toggle("slow"); })();']); ?>
<div id="productbox" class="productbox contentbox" style="display: <?php echo $product_block; ?>">

    <?= Html::button('<i class="fa fa-archive fa-2x" aria-hidden="true"></i>', ['class' => 'btn btn-info', 'id' => 'product_edit_btn', 'onclick' => '(function ( $event ) {  toggleproducteditbox(); })();']); ?>
    <div id="product_edit_block" style="display: none  ;">


        <?php echo $this->render('//product/editproductonly', [
                'enggdiary_id' => $enggdiary->id,

                'product_id' => $servicecall->product_id,
                'servicecall_id' => $servicecall->id
            ]
        ); ?>

    </div><!-- <div id="product_edit_block" end of product_edit_block -->


    <div id="product_view_block">

        <table class="full_width responsive-stacked-table">

            <tr>
                <td>
                    <h1>
                        <i class="fa fa-industry" aria-hidden="true"></i>

                        <?php echo Handyfunctions::getawesomebrandicon($servicecall->product->brand->name); ?>
                    </h1>
                    <div class="mobile_content">
                        <?php echo $servicecall->product->brand->name; ?>
                    </div>

                </td>
                <td>
                    <h1>
                        <i class="ukwfa ukwfa-threeappliancelogo"></i>
                        <?php echo Handyfunctions::getawesomeapplianceicon($servicecall->product->productType->name); ?>
                    </h1>
                    <div class="mobile_content">
                        <?php echo $servicecall->product->productType->name; ?>
                    </div>
                </td>
                <td>
                    <div
                        class="mobile_content_title"><?php echo $product_model_for_label->attributeLabels()['serial_number']; ?></div>
                    <div class="mobile_content">
                        <?php echo $servicecall->product->serial_number; ?>
                    </div>
                </td>

                <td>
                    <button id="product_details_check_btn" class="btn-clear" style="float: right; color:grey;"
                            onclick="productdetailsverified();">
                        <i class="fa fa-check-circle fa-2x" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <td>
                    <div
                        class="mobile_content_title"><?php echo $product_model_for_label->attributeLabels()['model_number']; ?></div>
                    <div class="mobile_content">
                        <?php echo $servicecall->product->model_number; ?>
                    </div>
                </td>
                <td>
                    <div
                        class="mobile_content_title"><?php echo $product_model_for_label->attributeLabels()['enr_number']; ?></div>
                    <div class="mobile_content">
                        <?php echo $servicecall->product->enr_number; ?>
                    </div>
                </td>
                <td>
                    <div
                        class="mobile_content_title"><?php echo $product_model_for_label->attributeLabels()['fnr_number']; ?></div>
                    <div class="mobile_content">
                        <?php echo $servicecall->product->fnr_number; ?>
                    </div>
                </td>
                <td>
                    <div
                        class="mobile_content_title"><?php echo $product_model_for_label->attributeLabels()['production_code']; ?></div>
                    <div class="mobile_content">
                        <?php echo $servicecall->product->production_code; ?>
                    </div>
                </td>


            </tr>

            <tr>
                <td>

                    <div class="mobile_content_title">
                        <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                        <?php echo $product_model_for_label->attributeLabels()['notes']; ?>
                    </div>
                    <div class="mobile_content">
                        <?php echo $servicecall->product->notes; ?>
                    </div>


                </td>

            </tr>


        </table>
    </div><!-- end of product_view_block-->
</div>
<!-- end of Div productbox  -->


<br><br>


<!-- documentsmanuals Section -->

<?= Html::button('Photos & Attachments', ['class' => 'btn-lg attachmentsheadingbox white_color full_width', 'onclick' => '(function ( $event ) { $("#documentsmanualsbox").toggle("slow"); })();']); ?>
<div id="documentsmanualsbox" class="attachmentsbox contentbox" style="display: <?php echo $docs_manuals_block; ?>">

    <?= Html::button('<i class="fa fa-camera  fa-2x" aria-hidden="true"></i>', ['class' => 'btn btn-info', 'id' => 'upload_document_and_manuals_btn', 'onclick' => '(function ( $event ) { $("#documentsmanuals-uploadfile").click(); toggledocumentsmanualseditbox(); })();']); ?>
    <div id="documentsmanuals_edit_block" style="display: none  ;">


        <?php echo $this->render('//documentsmanuals/uploaddocumentsmanualsonly', [
                'servicecallmodel' => $servicecall,
                'enggdiary_id' => $enggdiary->id,
            ]
        ); ?>

    </div><!-- <div id="documentsmanuals_edit_block" end of documentsmanuals_edit_block -->


    <div id="documentsmanuals_view_block">

        <button id="photos_check_btn" class="btn-clear" style="float: right; color:grey;"
                onclick="needtotakephotos();">
            <i class="fa fa-check-circle fa-2x" aria-hidden="true"></i>
        </button>


        <table class="full_width responsivetable">


            <?php $alldocs = Documentsmanuals::loadalldocumentsbyservicecallid($servicecall->id); ?>
            <?php foreach ($alldocs as $doc): ?>
                <?php $doc_link = Yii::$app->params['documents_upload_location_web_path'] . $doc->document->filename; ?>
                <tr>
                    <td><?php echo $doc->document->doctype->name; ?></td>
                    <td>
                        <span>
                            <a href=<?php echo $doc_link; ?> target="_blank">
                                <?php echo $doc->document->name; ?>
                            </a>
                        </span>

                    </td>

                    <td>
                        <a href=<?php echo $doc_link; ?> target="_blank">
                            <embed class="embed_image" src="<?php echo $doc_link; ?>">
                        </a>
                    </td>


                </tr>

            <?php endforeach; ?>
        </table>


    </div><!-- end of documentsmanuals_view_block-->
</div>
<!-- end of Div documentsmanualsbox  -->


<br><br>

<!-- servicecall Section -->

<?= Html::button('Service', ['class' => 'btn-lg serviceheadingbox white_color full_width', 'onclick' => '(function ( $event ) { $("#servicecallbox").toggle("slow"); })();']); ?>
<div id="servicecallbox" class="servicebox contentbox" style="display: <?php echo $servicecall_block; ?>">

    <?= Html::button('<i class="fa fa-wrench  fa-2x" aria-hidden="true"></i>', ['class' => 'btn btn-info', 'id' => 'upload_document_and_manuals_btn', 'onclick' => '(function ( $event ) {  toggleservicecalleditbox(); })();']); ?>
    <div id="servicecall_edit_block" style="display: block  ;">


        <?php echo $this->render('//servicecall/editservicecallonly', [
                'servicecallmodel' => $servicecall,
                'enggdiary_id' => $enggdiary->id,

            ]
        ); ?>

    </div><!-- <div id="servicecall_edit_block" end of servicecall_edit_block -->


    <div id="servicecall_view_block">

        <table class="responsive-stacked-table">
            <tr>

                <td>
                    <div class="mobile_content_title">
                        <?php echo $servicecall->attributeLabels()['contract']; ?>
                    </div>
                    <div class="mobile_content">
                        <?php echo $servicecall->contract->name; ?>
                    </div>
                </td>
                <td>
                    <div class="mobile_content_title">
                        <?php echo $servicecall->attributeLabels()['insurer_reference_number']; ?>
                    </div>
                    <div class="mobile_content">
                        <?php echo  $servicecall->insurer_reference_number; ?>
                    </div>
                </td>


                <td>
                    <div class="mobile_content_title">
                        <?php echo $servicecall->attributeLabels()['fault_code']; ?>
                    </div>
                    <div class="mobile_content">
                        <?php echo $servicecall->fault_code; ?>
                    </div>
                </td>


            </tr>


            <tr>
                <td>
                    <div class="mobile_content_title">
                        <?php echo $servicecall->attributeLabels()['fault_date']; ?>
                    </div>
                    <div class="mobile_content">
                        <?php echo Handyfunctions::format_date($servicecall->fault_date); ?>
                    </div>
                </td>
                <td colspan="2">
                    <div class="mobile_content_title">
                        <?php echo $servicecall->attributeLabels()['notes']; ?>
                    </div>
                    <div class="mobile_content">
                        <?php echo $servicecall->notes; ?>
                    </div>
                </td>


            </tr>
        </table>
        <button id="service_check_btn" class="btn-clear" style="float: right; color:grey;"
                onclick="workcarriedoutadded();">
            <i class="fa fa-check-circle fa-2x" aria-hidden="true"></i>
        </button>


        <div class="mobile_content_title">
            <?php echo $servicecall->attributeLabels()['fault_description']; ?>
        </div>
        <div class="mobile_content">
            <?php echo $servicecall->fault_description; ?>
        </div>


    </div><!-- end of servicecall_view_block-->
</div>
<!-- end of Div servicecallbox  -->


<br><br>

<!-- spares Section -->

<?= Html::button('Spares', ['class' => 'btn-lg sparesheadingbox white_color full_width', 'onclick' => '(function ( $event ) { $("#sparesbox").toggle("slow"); })();']); ?>
<div id="sparesbox" class="sparesbox contentbox" style="display: <?php echo $spares_block; ?>">

    <button id="spares_check_btn" class="btn-clear" style="float: right; color:grey;"
            onclick="sparesrequested();">
        <i class="fa fa-check-circle fa-2x" aria-hidden="true"></i>
    </button>

    <?= Html::button('<i class="fa fa-gears  fa-2x" aria-hidden="true"></i>', ['class' => 'btn btn-info', 'id' => 'upload_document_and_manuals_btn', 'onclick' => '(function ( $event ) {  togglespareseditbox(); })();']); ?>
    <div id="spares_edit_block" style="display:block;">


        <?php echo $this->render('//sparesused/requestsparepart', [
                'servicecallmodel' => $servicecall,
                'enggdiary_id' => $enggdiary->id,
            ]
        ); ?>


    </div><!-- <div id="spares_edit_block" end of spares_edit_block -->

    <hr>
    <div id="spares_view_block" style="display: block  ;">


        <table class="full_width responsive-stacked-table ">
            <tr>
                <th>Used</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Total Price</th>

            </tr>
            <?php $appspares = Sparesused::loadallsparesbyservicecallid($servicecall->id); ?>
            <?php foreach ($appspares as $sparepart): ?>

            	<?php $edit_spare_url=Url::to(['sparesused/update_qty', 'id' => $sparepart->id,'enggdiary_id' => $enggdiary->id,]);?>
                <tr style="    background: azure;border: dashed 1px #2196f3;">

                    <td>
                        <?php $togglesparesusedurl = Url::to(['sparesused/togglesparesused', 'id' => $sparepart->id, 'enggdiary_id' => $enggdiary->id,]); ?>

                        <a href="<?php echo $togglesparesusedurl; ?>">
                            <div class="mobile_content">
                                <?php if ($sparepart->used == 1) {
                                    echo '<i class="fa fa-check-square-o" aria-hidden="true"></i>';

                                } else {
                                    echo '<i class="fa fa-square-o" aria-hidden="true"></i>';
                                } ?>
                            </div>
                        </a>

                    </td>
                    <td>
                        <div class="mobile_content">
                            <?php echo $sparepart->item_name . ' - ' . $sparepart->part_number; ?>
                        </div>
                    </td>
                    <td>
                       <div class="mobile_content" >
                         <?php echo $sparepart->quantity ?>
                       </div>
                   </td>

                   <td>
                      <div class="mobile_content" >
                        <?php echo $sparepart->unit_price ?>
                      </div>
                  </td>

                  <td>
                     <div class="mobile_content" >
                       <b><?php echo $sparepart->total_price ?></b>
                     </div>
                 </td>



                    <td>
                        <a href="<?php echo $edit_spare_url; ?>">
                            <i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i>
                        </a>
                    </td>



                </tr>

            <?php endforeach; ?>

         

            <tr>
              <td colspan="3"></td>
              <td><div class="mobile_content">Subtotal</div></td>
              <td>
                  <div class="mobile_content">
                    <b><?php echo $servicecall->total_cost ?></b>
                  </div>
              </td>
            </tr>


            <tr>
              <td colspan="3"></td>
              <td><div class="mobile_content">Vat @<?php echo  Yii::$app->params['vat_percentage'];?>% </div></td>
              <td>
                  <div class="mobile_content">
                    <b><?php echo $servicecall->vat_on_total ?></b>
                  </div>
              </td>
            </tr>


            <tr>
              <td colspan="3"></td>
              <td><div class="mobile_content">Net Cost </div></td>
              <td>
                  <div class="mobile_content">
                    <b><?php echo $servicecall->net_cost ?></b>
                  </div>
              </td>
            </tr>







        </table>



    </div><!-- end of spares_view_block-->
</div>
<!-- end of Div sparesbox  -->






<br><br>

<!-- Signature Section -->

<?= Html::button('Signature', ['class' => 'btn-lg signatureheadingbox white_color full_width', 'onclick' => '(function ( $event ) { $("#signaturebox").toggle("slow"); })();']); ?>
<div id="signaturebox" class="signaturebox contentbox" style="display: <?php echo $signature_block; ?>">



    <?= Html::button('<i class="fa fa-glide-g  fa-2x" aria-hidden="true"></i>', ['class' => 'btn btn-info', 'id' => 'upload_document_and_manuals_btn', 'onclick' => '(function ( $event ) {  togglesignatureeditbox(); })();']); ?>
    <div id="signature_edit_block" style="display: block  ;">


        <?php echo $this->render('//documentsmanuals/capturesignature', [
                'enggdiary_id' => $enggdiary->id,
                'servicecallmodel' => $servicecall

            ]
        ); ?>



    </div><!-- <div id="signature_edit_block" end of signature_edit_block -->

    <hr>

    <div id="signature_view_block">
        <?php $signatures = Documentsmanuals::loadallallsignaturesforservicecallid($servicecall->id); ?>

        <table class="full_width responsivetable">
            <?php foreach ($signatures as $sign): ?>
                <?php $sign_link = Yii::$app->params['documents_upload_location_web_path'] . $sign->document->filename; ?>

                <tr>
                    <td><?php echo $sign->document->doctype->name; ?></td>
                    <td>
                        <a href=<?php echo $sign_link; ?> target="_blank">
                            <?php echo $sign->document->name; ?>
                        </a>
                    </td>


                    <td>
                        <a href=<?php echo $sign_link; ?> target="_blank">
                            <embed class="embed_image" src="<?php echo $sign_link; ?>">
                        </a>
                    </td>


                </tr>

            <?php endforeach; ?>
        </table>


    </div><!-- end of signature_view_block-->
</div>
<!-- end of Div signaturebox  -->

<br><br>








<!------------------------------------------------------------------------------------>


            <!-- <div id="email_servicecall_block" end of email_servicecall_block -->
			<?= Html::button('<h4><i class="fa fa-paper-plane"></i> Email Jobsheet </h4>', ['class' => 'btn white_color btn-info center-block full_width', 'onclick' => '(function ( $event ) { $("#email_servicecall_block").toggle("slow"); })();']); ?>

			<div id="email_servicecall_block" style="display: <?php echo $email_servicecall_block ?> ;">


				<?php echo $this->render('//servicecall/emailform', [
						'servicecallmodel' => $servicecall,
						'enggdiary_id' => $enggdiary->id,
					]
				); ?>

			</div>
		<!-- <div id="email_servicecall_block" end of email_servicecall_block -->





<hr>
<table class="full_width responsive-stacked-table">
    <tr>
        <td>
            <?php $job_finished_id = '24'; ?>
            <?php $job_finished_url = Url::to(['servicecall/changestatus', 'servicecall_id' => $servicecall->id, 'job_status_id' => $job_finished_id]); ?>
            <a href="<?php echo $job_finished_url; ?>">
                <button class="btn btn-success center-block">
                    <h4>
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                        Job Finished
                    </h4>
                </button>

            </a>
        </td>
        <td>
            <?php $incomplete_job_id = '25'; ?>
            <?php $incomplete_job_url = Url::to(['servicecall/changestatus', 'servicecall_id' => $servicecall->id, 'job_status_id' => $incomplete_job_id]); ?>
            <a href="<?php echo $incomplete_job_url; ?>">
                <button class="btn btn-danger center-block">
                    <h4>
                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                        Job Incomplete
                    </h4>
                </button>
            </a>
        </td>

        <td>
       	  <?= Html::button('<i class="fa fa-code-fork  fa-2x" aria-hidden="true"></i>', ['class' => 'btn contentbox attention center-block', 'id' => 'job_status_dropdown_block_btn', 'onclick' => '(function ( $event ) {  togglejobstatusdropdownblock(); })();']); ?>

        </td>

    </tr>
</table>



    <div id="job_status_dropdown_block" style="display: none  ;">

        <div class='media contentbox' >

            <?php $change_status_url = Url::to(['servicecall/changestatus', 'servicecall_id' => $servicecall->id]); ?>
            <?php $changesservicecallstatus=new Changeservicecallstatus(); ?>
            <?php $changesservicecallstatus->servicecall_id=$servicecall->id; ?>

            <?php
            $form = ActiveForm::begin([
                'id' => 'change-status-form',
                'action'=>$change_status_url,
				'method'=>'get',
                'options' => ['class' => 'form-horizontal'],
            ]);

            ?>

            <?= $form->field($changesservicecallstatus, 'servicecall_id')->hiddenInput()->label(false) ?>
            <?= $form->field($changesservicecallstatus, 'job_status_id')->dropDownList(Jobstatus::listformobiledropdown(),['prompt'=>'Select...'])->label(false); ?>
            <br>
            <div class="text-center ">
                <?= Html::submitButton('Close the Job', ['class' => 'btn btn-info']) ?>
            </div>

            <?php ActiveForm::end() ?>

        </div>




    </div><!-- <div id="job_status_dropdown_block" end of job_status_dropdown_block -->
