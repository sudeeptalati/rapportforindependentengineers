<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 22/09/2016
 * Time: 10:23
 */

use yii\helpers\Url;
use frontend\assets\LocateAsset;

LocateAsset::register($this);

?>

<?php
$this->registerJs('

    ////////initialise map

    //var map_data_url="http://192.168.1.150/findmydead_region/advanced/frontend/web/index.php?r=findandead_region/alldead_regionsjson";
    var map_data_url="'.Url::to(["deadregions/pullallinjson"]).'";
    console.log(map_data_url);
    $.get( map_data_url, function( data ) {
            display_dead_regions_map(data);
        }, "json" )
        .fail(function(data) {
                show_error(data);
         });




');

?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBIaCQadjRJ4vszXyxmn89lOqOadquzIgs"></script>

<table style="width: 100%">
    <tr>
        <td style="width:80%">
            <div id="map-container"><div id="dead_regions_map"></div></div>
        </td>
        <td style="width:20%;"  >
            <div id="dead-list-in-cluster" class="appliancebrandpostcodecontainer" style="height: 600px;">
                ok
            </div>
        </td>
    </tr>
</table>

