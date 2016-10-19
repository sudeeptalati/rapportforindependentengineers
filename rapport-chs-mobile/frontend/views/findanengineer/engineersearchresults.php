<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 14/09/2016
 * Time: 11:17
 */

use yii\helpers\Url;
use yii\helpers\Html;


use common\models\Engineer;
use common\models\Handyfunctions;

use frontend\assets\LocateAsset;
LocateAsset::register($this);


function updateImpressions($engineer_id)
{
    $engineer = Engineer::findOne($engineer_id);
    $engineer->updateCounters(['impressions' => 1]);
}



?>

<h6 style="text-align:right;">
    <?= Html::a('<i class="fa fa-repeat" aria-hidden="true"></i> Search Again',['/findanengineer'], ['class'=>'btn btn-primary'])?>

</h6>


<div class="progress-container">
    <ul class="progressbar">

        <li class="active" id="step-1">Postcode
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <div id="enggsearch-selectedpostcode">
                <h3>
                    <?php echo $model->postcode; ?>
                </h3>
            </div>

        </li>
        <li class="active" id="step-2">
            Appliance
            <i class="ukwfa ukwfa-threeappliancelogo"></i>
            <div id="enggsearch-selectedproducttype">
                <h1>
                    <?php echo Handyfunctions::getawesomeapplianceicon($model->product_type_name); ?>
                </h1>
                <h5>
                    <?php echo $model->product_type_name; ?>
                </h5>
            </div>
        </li>
        <li class="active" id="step-3">Make
            <i class="fa fa-industry" aria-hidden="true"></i>
            <div id="enggsearch-selectedbrand">
                <h1>
                    <?php echo Handyfunctions::getawesomebrandicon($model->brand_name); ?>
                </h1>
                <h5>
                    <?php echo $model->brand_name; ?>
                </h5>
            </div>
        </li>
    </ul>
</div>


<h1 class="progressbar">
    <i class="fa fa-thumbs-o-up fa-2x" aria-hidden="true"></i>
     Great all done, here's what we found
</h1>




<hr>

<?php if ($json_results->status=='OK'): ?>
<table style="width: 100%">
    <tr>
        <th style="width:50%"></th>
        <th style="width:25%"></th>
        <th style="width:25%"></th>
    </tr>

    <?php foreach ( $json_results->engineers as $engg): ?>
        <?php updateImpressions($engg->id);?>
        <tr class="mouseover">
            <td style="padding-left:30px;">
                <?php if ($engg->wta_member == 1): ?>
                    <div style="color: #FFC107;float:right;">
                        <i class="fa fa-star fa-4x" aria-hidden="true"></i>
                        Recommended
                    </div>
                <?php endif;//if ($engg->wta_member==1)?>

                <h2><?php echo $engg->name; ?></h2>
            </td>
            <td style="text-align: right;">
                <?php  $send_enquiry_url= Url::to(['findanengineer/sendenquiry', 'engineer_id' => $engg->id, 'postcode' => $model->postcode, 'brand_id' => $model->brand_id, 'product_type_id' => $model->product_type_id], true); ?>
                 <a id="enquiryclick" href="<?php echo $send_enquiry_url; ?>" onclick="recordenquiryclick(<?php echo $engg->id;?>) " >
                    <h1><i class="fa fa-envelope" aria-hidden="true"></i></h1>
                     <h3>Send Enquiry</h3>
                </a>


            </td>
            <td style="text-align: right;padding-right:30px;">
                <?php
                //echo $engg->phone;
                $mobile=$engg->phone;

                $mobile = preg_replace('/\s+/', '', $mobile);


                if (substr($mobile, 0, 1) == '0')
                {

                    $mobile=$engg->phone;
                    //echo "First place is 0";
                    $mobile = substr($mobile, 1);
                    $mobile='+44'.$mobile;

                }else
                {

                    //echo "First place is not";
                    $mobile=$engg->phone;

                }
                $mobile = preg_replace('/\s+/', '', $mobile);
                //echo '<br>'.$mobile;
                ?>
                <a id="phoneclick" href="tel:<?php echo $mobile; ?>" target="_blank"  onclick="recordphoneclick(<?php echo $engg->id;?>) " >
                    <h1>
                        <i class="fa fa-phone" aria-hidden="true"></i>
                    </h1>
                    <h3>Call Now</h3>
                </a>
            </td>

        </tr>
    <?php endforeach; ?>
</table>

<?php endif; ///if ($json_results->status=='OK'):?>


<?php if ($json_results->status==='DEAD_REGION'): ?>
    <div class="bg-warning container btn text-warning">
        <h3><i class="fa fa-frown-o" aria-hidden="true"></i>
             We are sorry as there is no engineer found for you  <?php echo $model->brand_name; ?>&nbsp;<?php echo $model->product_type_name?>
        </h3>
        <h2>
            <i class="fa fa-smile-o" aria-hidden="true"></i>
                However, we can still help you. Please <?php echo Handyfunctions::get_support_email(); ?>
        </h2>
    </div>

<?php endif;?>


<?php if ($json_results->status=='INVALID_PARAMETERS'): ?>
    <div class="bg-danger container btn text-danger">
        <h3>There was a problem in your request. Please try again or <?php echo Handyfunctions::get_support_email(); ?></h3>
    </div>

<?php endif;?>



