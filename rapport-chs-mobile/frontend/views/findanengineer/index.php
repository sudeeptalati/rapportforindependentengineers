<?php
/* @var $this yii\web\View */

use frontend\assets\LocateAsset;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

LocateAsset::register($this);


$this->title = 'Find an Engineer';

?>







<?php $form = ActiveForm::begin(['id' => 'findanengineer-form']); ?>
<?php $form->action = Url::to(['findanengineer/engineersearchresults']); ?>

<h6 style="text-align:right;">
    <?= Html::a('<i class="fa fa-repeat" aria-hidden="true"></i> Search Again',['/findanengineer'], ['class'=>'btn btn-primary'])?>

</h6>

<div class="progress-container">
    <ul class="progressbar">

        <li id="step-1">Postcode
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <span id="enggsearch-selectedpostcode"></span>
        </li>
        <li id="step-2">
            Appliance
            <i class="ukwfa ukwfa-threeappliancelogo"></i>
            <span id="enggsearch-selectedproducttype"></span>
        </li>
        <li id="step-3">Make
            <i class="fa fa-industry" aria-hidden="true"></i>
            <span id="enggsearch-selectedbrand"></span>
        </li>
    </ul>
</div>


<table style="width: 100%">
    <tr>
        <td>
            <div id="enggsearch-postcodediv" style="display: block;">

                <h3>
                    <i class="fa fa-location-arrow" aria-hidden="true"></i>
                    Step 1: Please tell us your Postcode ?
                </h3>

                <?= $form->field($model, 'postcode')->textInput(['autofocus' => true])->label(false);?>



                <div style="color:darkred;" id="postcode_error"></div>
            </div>


        </td>

        <td>
            <div id="enggsearch-producttypediv" style="display: none;">
                <h3 style="text-align: center">
                    <i class="ukwfa ukwfa-threeappliancelogo"></i>
                    Step 2: Thanks, now can you tell us what appliance you have ?</h3>


                <?= $form->field($model, 'product_type_id')->dropDownList(
                    $all_product_types,           // Flat array ('id'=>'label')
                    ['prompt' => '']    // options
                )->label(false);?>
            </div>
        </td>

        <td>
            <div id="enggsearch-branddiv" style="display: none;">

                <h3 style="text-align: right;">
                    <i class="fa fa-industry" aria-hidden="true"></i>
                    Step 3: Great, nearly there, please tell us what make it is ?</h3>

                <?= $form->field($model, 'brand_id')->dropDownList(
                    $all_brands,           // Flat array ('id'=>'label')
                    ['prompt' => '']    // options
                )->label(false);?>
            </div>
        </td>

    </tr>


    <tr>
        <td>
            <table>
                <tr>
                    <td>
                        <?= $form->field($model, 'postcode_s')->hiddenInput(['style' => 'width:100px', 'readonly' => 'readonly'])->label(false); ?>
                    </td>
                    <td>
                        <?= $form->field($model, 'postcode_e')->hiddenInput(['style' => 'width:100px', 'readonly' => 'readonly'])->label(false); ?>
                    </td>
                </tr>
            </table>

        </td>
        <td>
            <?= $form->field($model, 'town')->hiddenInput(['style' => 'width:100%', 'readonly' => 'readonly'])->label(false); ?>
        </td>
        <td>
            <?= $form->field($model, 'latitude')->hiddenInput()->label(false); ?>
            <?= $form->field($model, 'longitude')->hiddenInput()->label(false); ?>

        </td>
    </tr>
</table>

<!--
<div id='enggsearch-findbtndiv' style="display: none" class="form-group">
    <?= Html::submitButton('Find', ['class' => 'btn btn-primary', 'name' => 'findanengineer-button']) ?>
</div>
-->
<?php ActiveForm::end(); ?>


<?php $map_data_url = Url::to(["findanengineer/allengineersjson"]); ?>



<?= $this->render('engineersonmap', [
    'map_data_url' => $map_data_url,
]) ?>


<?php
$this->registerJs('


$(document).keypress(function(e) {
  if(e.which == 13) {
    // enter pressed
    submitandverifypostcode();
  }
});


function submitandverifypostcode()
{
        pc=$("#findanengineer-postcode" ).val();
        $("#findanengineer-postcode" ).val(pc.toUpperCase());
        pc=pc.replace(/ /g,"");



         if (pc.length>4)
         {
            check_postcode_on_google(pc);
         }else
         {
            
            show_error();
         }

}////end of function submitandverifypostcode()



    $( "#findanengineer-postcode" ).keyup(function() {

       submitandverifypostcode();

    });

    



     $( "#findanengineer-product_type_id" ).change(function() {
           hideproducttypediv();
           showbranddiv();

    });



    $( "#findanengineer-brand_id" ).change(function() {
           hidebranddiv();
           showfindbtndiv();

    });




    function check_postcode_on_google(postcode)
    {


        postcodelookup_url="https://maps.googleapis.com/maps/api/geocode/json?address="+postcode+"&key=' . Yii::$app->params['google_maps_api_key'] . '";

        console.log(postcodelookup_url);

        $.get( postcodelookup_url, function( data ) {
            verify_postcode(data);
        }, "json" )
        .fail(function(data) {
                show_error(data);
         });

    }///end of function verifypostcode(postcode)

    function verify_postcode(google_data)
    {
        if (google_data.status=="OK")
        {
            console.log(google_data.results[0].address_components[0].long_name);
            console.log(google_data.results[0].address_components[3].long_name);

            town=google_data.results[0].address_components[3].long_name;
            lat=google_data.results[0].geometry.location.lat;
            lng=google_data.results[0].geometry.location.lng;

            google_postcode_format=google_data.results[0].address_components[0].long_name;

            postcode_array=google_postcode_format.split(" ");
            $("#findanengineer-postcode_s" ).val(postcode_array[0]);
            $("#findanengineer-postcode_e" ).val(postcode_array[1]);
            $("#findanengineer-town" ).val(town);
            $("#findanengineer-latitude" ).val(lat);
            $("#findanengineer-longitude" ).val(lng);

 
            clear_error();
            showproducttypediv();
            hidepostcodediv();
        }else
        {


            show_error(google_data);
        }

    }///end of function verify_postcode(google_data)


    function show_error(google_data)
    {
       
        //html_error_output="Please Enter a Valid Postcode<br>Error:"+google_data.status;
         html_error_output="Please Enter a Valid Postcode";
         $("#postcode_error" ).html(html_error_output);
         $("#findanengineer-postcode_s" ).val("");
         $("#findanengineer-postcode_e" ).val("");
         $("#findanengineer-town" ).val("");

    }


    function clear_error()
    {
        $("#postcode_error" ).html("");

    }


    function showpostcodediv()
    {
        $("#enggsearch-postcodediv" ).show( "slow" );
    }


    function hidepostcodediv()
    {
        $( "#step-1" ).addClass( "active" );
       
        $("#enggsearch-postcodediv" ).hide( "slow" );
        engg_s_s_p=$("#findanengineer-postcode" ).val();
        $("#enggsearch-selectedpostcode" ).html(engg_s_s_p);

    }





    function showproducttypediv()
    {
        $("#enggsearch-producttypediv" ).show( "slow" );
    }


    function hideproducttypediv()
    {
        $( "#step-2" ).addClass( "active" );
        
        
        $("#enggsearch-producttypediv" ).hide( "slow" );
        engg_search_selected_product_type=$("#findanengineer-product_type_id option:selected" ).text();
        $("#enggsearch-selectedproducttype" ).html(engg_search_selected_product_type);


    }

    function showbranddiv()
    {
        $("#enggsearch-branddiv" ).show( "slow" );
    }


    function hidebranddiv()
    {
         $( "#step-3" ).addClass( "active" );
       
       
        $("#enggsearch-branddiv" ).hide( "slow" );
        engg_search_selected_brand=$("#findanengineer-brand_id option:selected" ).text();
        $("#enggsearch-selectedbrand" ).html(engg_search_selected_brand);
        submitenggsearchform();

    }

    function showfindbtndiv()
    {
        $("#enggsearch-findbtndiv" ).show( "slow" );
    }

    function hidefindbtndiv()
    {
        $("#enggsearch-findbtndiv" ).hide( "slow" );
    }

    function submitenggsearchform()
    {
        $( "#findanengineer-form" ).submit();
    }



 



');

?>

