<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 19/10/2016
 * Time: 17:36
 */

use yii\widgets\ActiveForm;

use common\models\Documentsmanuals;
use common\models\Documenttype;

use yii\helpers\Html;
use yii\helpers\Url;


$docssmodel=new Documentsmanuals();

$docssmodel->name="SerRefNo ".$servicecallmodel->service_reference_number;

$docssmodel->filename=$string = preg_replace('/\s+/', '', $docssmodel->name);
$docssmodel->filename=strtolower($docssmodel->filename);

$docssmodel->brand_id=$servicecallmodel->product->brand_id;
$docssmodel->product_type_id=$servicecallmodel->product->product_type_id;
$docssmodel->active='1';

//$items = ArrayHelper::map(Documenttype::find()->all(), 'id', 'name');
//$items = ArrayHelper::map(Documenttype::find()->where(['category'=>'IMAGE'])->all(), 'id', 'name');
$items = Documenttype::getdocumenttypeslist('IMAGE');



?>
<input type="hidden" id="doc_title" value="<?php echo "SerRefNo ".$servicecallmodel->service_reference_number; ?>">

<?php $form = ActiveForm::begin([
    'action' =>['documentsmanuals/quickupload', 'servicecall_id'=>$servicecallmodel->id, ],
    'id' => 'quick_upload',
    'method' => 'post',
    'options' => ['enctype' => 'multipart/form-data'],
    'enableAjaxValidation' => true,
    'validationUrl' =>Url::toRoute('documentsmanuals/validation')


]);
?>


<?= $form->field($docssmodel, 'uploadfile')->fileInput() ?>


<table class="full_width responsive-stacked-table">
    <tr>
        <td>
            <?= $form->field($docssmodel, 'document_type_id')->dropDownList($items); ?>
        </td>
        <td>
            <?= $form->field($docssmodel, 'name')->textInput(); ?>
        </td>
        <td>
            <?= $form->field($docssmodel, 'filename')->textInput(); ?>
            <input id="hiddentempfilename" type="hidden" />


            <?= $form->field($docssmodel, 'brand_id')->hiddenInput()->label(false); ?>
            <?= $form->field($docssmodel, 'product_type_id')->hiddenInput()->label(false); ?>
            <?= $form->field($docssmodel, 'active')->hiddenInput()->label(false); ?>
        </td>
    </tr>


            <div class="form-group text-center">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>

</table>

<?php ActiveForm::end() ?>

<?php
$this->registerJs('

$(document).on("beforeSubmit", "#quick_upload", function () {
    // send data to actionSave by ajax request.
 
   return checkfileuploaded();
   
});

function checkfileuploaded()
{

  console.log("Check file calekd");
    if ($("#documentsmanuals-uploadfile").val())
        return true;
    else
    {
          alert("Please upload a file first");
        return false;
      
    }
       
}////end ofunction checkfileuploaded()



function generatefilename()
{
    doc_title=$("#doc_title").val();
    doc_type=$("#documentsmanuals-document_type_id").find(":selected").text();;
    uploaded_file_name=$("#hiddentempfilename").val();
   

    final_filename=doc_title+doc_type+uploaded_file_name;
    
    
    $("#documentsmanuals-name").val(doc_title+" "+doc_type);

    
    final_filename = final_filename.toLowerCase();
    final_filename = final_filename.replace(/\s+/g, "");
    
    console.log("final_filename:  "+final_filename);
    
    $("#documentsmanuals-filename").val(final_filename);

}


    $("#documentsmanuals-uploadfile").on("change", function () {


  
            
        
        $("#documentsmanuals-filename").val("");
       
        var file = this.files[0];
        file_title = file.name;
        formatted_filename = file_title.toLowerCase();
        formatted_filename = formatted_filename.replace(/\s+/g, "");
        console.log(formatted_filename);
        
        $("#hiddentempfilename").val(formatted_filename);
        
        generatefilename();

        

    });
    
    
    
    $("#documentsmanuals-document_type_id").on("change", function () {


        generatefilename();

        
          

    });
    
    

');


?>


