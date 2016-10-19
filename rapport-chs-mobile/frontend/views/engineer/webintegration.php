<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 23/09/2016
 * Time: 08:11
 */


/* @var $this yii\web\View */

use common\models\Handyfunctions;
use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = 'Website Integration';
$this->params['breadcrumbs'][] = $this->title;


?>
<p>
    With the web integration feature, now you can integrate book service call page into your website.
    All you need to do is copy and paste the code into your website.
    Moreover, we have got team of developers that can help you to integrate this into your website irrespective how much old or complex your website is, we will integrate it for you

</p>
<h4>
    If you want us to integrate this into your website, please buy this service
    <a href="https://shop.ukwhitegoods.co.uk/" target="_blank"><div class="btn btn-success"> <i class="fa fa-shopping-cart" aria-hidden="true"></i>  Integrate into my website</div></a>
</h4>

<h4>Benifits</h4>
<ul>
    <br><i class="fa fa-lightbulb-o" aria-hidden="true"></i>
    &nbsp;&nbsp; Customer history
    <br><i class="fa fa-lightbulb-o" aria-hidden="true"></i>
    &nbsp;&nbsp; Easy integration
    <br><i class="fa fa-lightbulb-o" aria-hidden="true"></i>
    &nbsp;&nbsp; Capture customers Out of hours business
    <br><i class="fa fa-lightbulb-o" aria-hidden="true"></i>
    &nbsp;&nbsp; Capture customers in Busy hours
    <br><i class="fa fa-lightbulb-o" aria-hidden="true"></i>
    &nbsp;&nbsp; Rapport Integration
    <br><i class="fa fa-lightbulb-o" aria-hidden="true"></i>
    &nbsp;&nbsp; Integrate as a button or dedicate the complete page
</ul>

<h4>Moreover, it will save the customer information in your online account, so you can visit back the customer information</h4>

<h3>For <a href="http://www.rapportsoftware.co.uk/" target="_blank">Rapport </a>Call Handling software Users </h3><p>
<b>Note: </b>It won’t be allocating a engineer or booking into diary. It will just sit in your rapport as remotely booked. You can review the details and then can decide whom you want to assign to and at what time.

    So in busy hours or out of work hours, when customer is hearing a recorded message, you can say that please go online and book the servicecall yourself and we will contact you back. It will help you to increase the customer base and less likely to miss any customer.


</p>
<hr>

<h1>How to Integrate</h1>

<div>


    <?php
    $server_name = Yii::$app->request->getServerName();
    $script_url = Yii::$app->request->getScriptUrl();
    $booking = '/findanengineer/sendenquiry?engineer_id=' . $model->id;
    $book_service_url = 'http://' . $server_name . $script_url . $booking;
    ?>

    <table>
        <tr>
            <td>
                <h3>Insert as Button</h3>
                <textarea style="width:400px;height: 200px" id="bookmyservicecallbutton"><!-- FIND AN ENGINEER CODE START-->
                    <a href="<?php echo $book_service_url; ?>" target="_blank">
                        <button style="color: #fff;background-color: #337ab7;border-color: #2e6da4;display: inline-block;padding: 6px 12px;    margin-bottom: 0;    font-size: 14px;    font-weight: normal;    line-height: 1.42857143;    text-align: center;    white-space: nowrap;    vertical-align: middle;      cursor: pointer;         border: 1px solid transparent;    border-radius: 4px;">
                            Book Servicecall
                        </button>
                    </a>
                    <!-- FIND AN ENGINEER CODE END--></textarea>
                <br>
                <button class="btn btn-info" id="copybookservicecallbutton">
                    <i class="fa fa-clone" aria-hidden="true"></i>
                    Copy
                </button>
                <script>
                    document.getElementById("copybookservicecallbutton").addEventListener("click", function () {
                        document.getElementById("bookmyservicecallbutton").select();
                        document.execCommand('copy');
                    });
                </script>
            </td>
            <td>
                <h1>Demo</h1>
                <span style="margin: 20px">
                    <br>Copy and paste this code on your website to directly book the servicecall to your account
                    <br>The button will be visible on your website as :
                    <a href="<?php echo $book_service_url; ?>" target="_blank">
                        <br>
                        <button style="color: #fff;background-color: #337ab7;border-color: #2e6da4;display: inline-block;padding: 6px 12px;    margin-bottom: 0;    font-size: 14px;    font-weight: normal;    line-height: 1.42857143;    text-align: center;    white-space: nowrap;    vertical-align: middle;      cursor: pointer;         border: 1px solid transparent;    border-radius: 4px;">
                            Book Servicecall
                        </button>
                    </a>
                </span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
                <h3>Integrate as iframe</h3>
                <textarea style="width:1200px;height:50px" id="bookmyservicecalliframe"><iframe src="<?php echo $book_service_url; ?>" style="width: 100%; height: 1800px"></iframe></textarea>
                <br>
                <button class="btn btn-info" id="copybookservicecalliframe">
                    <i class="fa fa-clone" aria-hidden="true"></i>
                    Copy
                </button>
                <script>
                    document.getElementById("copybookservicecalliframe").addEventListener("click", function () {
                        document.getElementById("bookmyservicecalliframe").select();
                        document.execCommand('copy');
                    });
                </script>
                <h4>If you want us to integrate this into your website, please buy this service

                    <a href="https://shop.ukwhitegoods.co.uk/" target="_blank"><div class="btn btn-success"> <i class="fa fa-shopping-cart" aria-hidden="true"></i>  Integrate into my website</div></a>
                </h4>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <h1>Demo</h1>
                <div>
                    <iframe src="http://192.168.1.150/findanengineer/advanced/frontend/web/index.php/findanengineer/sendenquiry?engineer_id=141" style="width: 100%; height: 1500px"></iframe>
                </div>

            </td>
        </tr>
    </table>




</div>