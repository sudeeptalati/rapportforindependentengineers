<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 21/10/2016
 * Time: 14:05
 */

use common\models\Sparesused;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

<br>

<?= Html::input('searchitem', '', '', ['id' => 'searchitemwithkeyword', 'class' => 'form-control', 'placeholder' => 'Start searching Items here............']) ?>



<style>
    tr.mytr:hover {
        background-color: yellow;
    }

    tr.mytr:visited {
        background-color: yellow;
    }

    .mytr {
        cursor: pointer;
        /*border-bottom: 1px solid red;*/
        border-radius: 5px;
        background: azure;
        margin: 10px;
    }

</style>
<div id="itemsearchdiv">

    <?php $itemsearchurl= Url::toRoute('sparesused/searchmasteritemsrecords');?>
    <?= Html::hiddenInput('itemsearchurl', $itemsearchurl, ['id' => 'itemsearchurl']) ?>

    <table id="masteritems_table" class="full_width responsive-stacked-table">

    </table>

    <div style="float: right">
        <?= Html::button('<i class="fa fa-plus-square-o fa-2x" aria-hidden="true"></i>',['id'=>'add-new-spare-btn','class'=>'btn btn-info']) ?>
    </div>



</div>
<div id="request-sparepart-form" style="display: none">
    <?php
    $sparepart = new Sparesused();

    $sparepart->master_item_id=0;
    $sparepart->servicecall_id=$servicecallmodel->id;


    $form = ActiveForm::begin([
        'action' => ['sparesused/requestsparepart'],
        'id' => 'request_spare_part',
        'method' => 'post',
    ]);
    ?>


    <?= $form->field($sparepart, 'master_item_id')->hiddenInput()->label(false); ?>
    <?= $form->field($sparepart, 'servicecall_id')->hiddenInput()->label(false); ?>


    <table class="full_width responsive-stacked-table">
        <tr>
            <td>
                <?= $form->field($sparepart, 'item_name')->textInput(); ?>
            </td>
            <td>
                <?= $form->field($sparepart, 'part_number')->textInput(); ?>
            </td>
            <td>
                <?= $form->field($sparepart, 'quantity')->textInput(); ?>
            </td>
        </tr>
    </table>

    <?= $form->field($sparepart, 'notes')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Request Part', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end() ?>
</div>


<br>



<?php
$this->registerJs('

 

    function searchitemwithkeyword()
    {
        keyword=$("#searchitemwithkeyword").val();
        console.log("searchitemwithkeyword called: "+keyword);
        
        searchurl=$("#itemsearchurl").val();
        console.log("searchurl called: "+searchurl);
        
        
        
         if (keyword.length>3)
         {
            $.get( searchurl, { keyword: keyword } )
                .done(function( data ) {
                    ///This function is defined in viewappointment.js
                    formatoutputdata(data);
                });
         
         }///end of if 
      
  
    }////end ofunction checkfileuploaded()
     

     
    $("#searchitemwithkeyword").on("keyup", function () {
        
        searchitemwithkeyword();
        $("#request-sparepart-form").hide();
        
       
    
                
    });
         
    $("#add-new-spare-btn").on("click", function () {
        
        $("#request-sparepart-form").show(); 
        $("#sparesused-item_name").val("");
        $("#sparesused-part_number").val("");
                
    });
    
    
    

');


?>

