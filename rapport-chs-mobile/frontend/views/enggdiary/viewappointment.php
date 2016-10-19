<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 14/10/2016
 * Time: 16:41
 */

use common\models\Handyfunctions;
use yii\helpers\Html;
use frontend\assets\LocateAsset;



LocateAsset::register($this);


$this->title = 'Service Call';

$customer_address_html = Handyfunctions::formataddressinhtml(
    $servicecall->customer->address_line_1,
    $servicecall->customer->address_line_2,
    $servicecall->customer->address_line_3,
    $servicecall->customer->town,
    $servicecall->customer->postcode
);


?>

<?= Html::button('Customer', ['class' => 'btn-lg btn-primary full_width', 'onclick' => '(function ( $event ) { $("#customerbox").toggle(); })();']); ?>
    <div id="customerbox" class="customerbox contentbox">

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
                            <i class="fa fa-car"></i>
                            <?php echo $servicecall->customer->fax; ?>
                        </div>


                    </td>
                    <td>
                        <div style="float: left;">


                        </div>


                        <div style="float: right; color:grey;">
                            <i class="fa fa-check-circle fa-3x" aria-hidden="true"></i>
                        </div>
                    </td>
                </tr>
            </table>
        </div>



        <?= Html::button('<i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i>', ['class' => 'btn btn-success','id' => 'customer_edit_btn', 'onclick' => '(function ( $event ) {  togglecustomereditbox(); })();']); ?>
        <div id="customer_edit_block" style="display: none  ;">


            <?php echo $this->render('//customer/editcustomeronly', [
                    'customer_id' => $servicecall->customer_id,
                 ]
            ); ?>

        </div><!-- <div id="customer_edit_block" end of customer_edit_block -->


    </div>

