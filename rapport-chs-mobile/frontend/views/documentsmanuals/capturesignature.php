<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 20/10/2016
 * Time: 16:27
 */

use common\models\Documentsmanuals;
use common\models\Documenttype;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


$docssmodel = new Documentsmanuals();

$docssmodel->name = "SerRefNo " . $servicecallmodel->service_reference_number . " Customer Signature " . date('d-M-Y H:i:s');

$docssmodel->filename = "SerRefNo " . $servicecallmodel->service_reference_number . " Customer Signature";
$docssmodel->filename = preg_replace('/\s+/', '', $docssmodel->filename);
$docssmodel->filename = $docssmodel->filename . time() . ".png";
$docssmodel->filename = strtolower($docssmodel->filename);

$docssmodel->brand_id = $servicecallmodel->product->brand_id;
$docssmodel->product_type_id = $servicecallmodel->product->product_type_id;
$docssmodel->document_type_id = '1'; ///Document type id for customer signature

$docssmodel->active = '1';

$items = Documenttype::getdocumenttypeslist('SIGNATURE');

?>


<h1>Your autograph please</h1>
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">


<style>


    #sig-canvas {
        border: 2px dotted #000;
        border-radius: 5px;
        cursor: crosshair;
    }

    #sig-dataUrl {
        width: 80%;
    }
</style>


<div class="container">
    <div class="row">

        <h2>E-Signature</h2>
        <h3 id="sig-info">Please sign in box below<br></h3>

    </div>

    <div class="row" id="sig-canvas-div">
        <div class="col-md-12">
            <canvas id="sig-canvas" width="300" height="300">
                Get a better browser, bro.
            </canvas>

            <div style="display: none">
                <textarea id="sig-dataUrl" class="form-control" type="hidden" readonly="readonly">
                </textarea>
            </div>
        </div>
    </div>

    <img id="sig-image" src="" alt=""/>

    <div class="row">
        <div class="col-md-12">

        </div>
    </div>
    <br/>
</div>



<?php $form = ActiveForm::begin([
    'action' => ['documentsmanuals/uploadsignature', 'servicecall_id' => $servicecallmodel->id,],
    'id' => 'signature_upload',
    'method' => 'post',
    'options' => ['enctype' => 'multipart/form-data'],
    'enableAjaxValidation' => true,
    'validationUrl' => Url::toRoute('documentsmanuals/validation')


]);
?>





<?= $form->field($docssmodel, 'document_type_id')->dropDownList($items); ?>


<div class="form-group" id="upload-signature-btn" style="display:none;">
    <?= Html::submitButton('Yes this is my signature', ['class' => 'btn btn-success']) ?>
</div>


<?= $form->field($docssmodel, 'base64string')->hiddenInput()->label(false); ?>
<?= $form->field($docssmodel, 'name')->hiddenInput()->label(false); ?>
<?= $form->field($docssmodel, 'filename')->hiddenInput()->label(false); ?>
<?= $form->field($docssmodel, 'brand_id')->hiddenInput()->label(false); ?>
<?= $form->field($docssmodel, 'product_type_id')->hiddenInput()->label(false); ?>
<?= $form->field($docssmodel, 'active')->hiddenInput()->label(false); ?>

<input id="hiddentempfilename" type="hidden"/>

<?php ActiveForm::end() ?>


<button class="btn btn-primary" id="sig-submitBtn">Submit Signature</button>
<button class="btn btn-warning" id="sig-clearBtn">Clear Signature</button>



<?php
$this->registerJs('

$(document).on("beforeSubmit", "#signature_upload", function () {
    // send data to actionSave by ajax request.
 
   return copybase64data();
   
});

function copybase64data()
{
    console.log("copybase64datafile calekd");
   
    signature_data=$("#sig-dataUrl").val();
    $("#documentsmanuals-base64string").val(signature_data);
    
    return true;       
}////end ofunction checkfileuploaded()
     
     
     
     
    $("#sig-submitBtn").on("click", function () {
        
        console.log("Signature Submit clicked");
        
        
        $("#sig-canvas-div").hide();
        $("#sig-submitBtn").hide();
        $("#upload-signature-btn").show();
               
    });
    
       $("#sig-clearBtn").on("click", function () {
        
        console.log("Clear Signature  clicked");
                
        $("#sig-canvas-div").show();
        $("#sig-submitBtn").show();
        $("#upload-signature-btn").hide();
        
        
        
    });
    
    
    

');


?>


<!-- Scripts -->
<script src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<script src="js/signature.js"></script>
