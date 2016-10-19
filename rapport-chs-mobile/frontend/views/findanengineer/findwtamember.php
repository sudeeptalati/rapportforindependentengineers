<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 24/09/2016
 * Time: 08:51
 */

use frontend\assets\LocateAsset;
use yii\helpers\Html;
use yii\helpers\Url;

LocateAsset::register($this);

?>

        <table style="width: 100%">
            <tr>
                <td>
                    <a href="http://www.whitegoodstradeassociation.org/" target="_blank">

                    <h1>
                        <i class="ukw-logo-fa ukw-logo-fa-wta"></i>
                    </h1>
                    </a>
                </td>
                <td>
                    <h1 style="float: right;">
                        Whitegoods Trade Association

                    </h1>
                </td>
            </tr>
        </table>


    <h6 style="text-align:right;">
        <?= Html::a('<i class="fa fa-repeat" aria-hidden="true"></i> Start Over',['/findanengineer/findwtamember'], ['class'=>'btn btn-primary'])?>

    </h6>

<h2>
    <i class="fa fa-location-arrow" aria-hidden="true"></i>

    <a href="http://www.whitegoodstradeassociation.org/" target="_blank">
        WTA</a>

    members near you</h2>



<?= Html::beginForm(['/findanengineer/wtamemberresult'], 'post'); ?>

<?= Html::textInput('Findanengineer[postcode]','', ['class'=>'form-control','placeholder'=>'Please enter your postcode', 'id'=>'findanengineer-postcode']) ?>


<?= Html::hiddenInput('Findanengineer[postcode_s]','', ['class'=>'form-control','id'=>'findanengineer-postcode_s', 'readonly'=>'readonly']) ?>

<?= Html::hiddenInput('Findanengineer[postcode_e]','', ['class'=>'form-control','id'=>'findanengineer-postcode_e', 'readonly'=>'readonly']) ?>

<?= Html::hiddenInput('Findanengineer[town]','', ['class'=>'form-control','id'=>'findanengineer-town', 'readonly'=>'readonly']) ?>

<!--
<?= Html::button('Find ',['id'=>'findnearestwta-btn', 'class'=>'btn btn-info']); ?>

<?= Html::submitButton('Find', ['class' => 'btn btn-link']);?>

-->

<?= Html::endForm() ?>

<br>




<?php $map_data_url=Url::to(["findanengineer/wtamembersjson"]); ?>

<?= $this->render('engineersonmap', [
    'map_data_url' => $map_data_url,
]) ?>


<?php
$this->registerJs('
 
    
    

 $( "#findanengineer-postcode" ).keyup(function() {
        pc=$("#findanengineer-postcode" ).val();
        $("#findanengineer-postcode" ).val(pc.toUpperCase());

        check_postcode_on_google(pc);

    });


    function check_postcode_on_google(postcode)
    {
        postcode=postcode.replace(/ /g,"")

        postcodelookup_url="https://maps.googleapis.com/maps/api/geocode/json?address="+postcode+"&key='.Yii::$app->params['google_maps_api_key'].'";

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


            zoommaptopostcode(lat,lng);
            

            clear_error();
        }else
        {
            show_error(google_data);
        }

    }///end of function verify_postcode(google_data)


    function show_error(google_data)
    {
        html_error_output="Please Enter a Valid Postcode<br>Error:"+google_data.status;
        $("#postcode_error" ).html(html_error_output);
         $("#findanengineer-postcode_s" ).val("");
         $("#findanengineer-postcode_e" ).val("");
         $("#findanengineer-town" ).val("");

    }

    function clear_error()
    {
        $("#postcode_error" ).html("");

    }


');

?>