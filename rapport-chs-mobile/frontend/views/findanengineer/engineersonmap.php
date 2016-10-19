<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 23/09/2016
 * Time: 18:32
 */
?>

<?php $google_maps_api_key=Yii::$app->params['google_maps_api_key']; ?>


<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_maps_api_key;?>"></script>
<div id="engineersmap-container"><div id="engineersmap"></div></div>


<?php
$this->registerJs('

    ////////initialise map///////////

    //var map_data_url="http://192.168.1.150/findmyengineer/advanced/frontend/web/index.php?r=findanengineer/allengineersjson";
    var map_data_url="'.$map_data_url.'";

    $.get( map_data_url, function( data ) {
            display_engineers_map(data);
        }, "json" )
        .fail(function(data) {
                show_error(data);
         });



');

?>