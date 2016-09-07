<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 04/07/2016
 * Time: 10:24
 */
?>
<?php $google_maps_api_key=Yii::app()->params['google_maps_api_key'];?>

<?php //echo 'https://www.google.com/maps/embed/v1/place?key='.$google_maps_api_key.'&q='.$postcode; ?>

<iframe
    width="400"
    height="200"
    frameborder="1" style="border:0"
    src="https://www.google.com/maps/embed/v1/place?key=<?php echo $google_maps_api_key;?>&q=<?php echo $postcode;?>" allowfullscreen>
</iframe>


