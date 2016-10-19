<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 19/09/2016
 * Time: 16:20
 */





?>

<button style="float: right;" class="btn btn-success"  onclick="js:window.print();">Print this page</button>

<?php if ($emailsent==1):?>

    <h2>Thank you for using our service</h2>
    <h4>The engineer have been informed with your query.</h4>
    <h4>Your enquiry no. # <b>UKW-<?php echo $new_customer_model->enquiry_number; ?></b></h4>

    <hr>
    <div>
        <b>The following email has been sent to you and the engineer.</b>
    </div>
    <?php echo $mail_html_content;?>
<?php endif; ?>


<?php //var_dump($sms_sent);?>
<?php //var_dump($sent_to_rapport);?>
