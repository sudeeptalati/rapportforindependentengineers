/**
 * Created by sudeeptalati on 22/09/2016.
 */

function display_dead_regions_map(dead_regions)
{
//        for (var i = 0; i < dead_regions.length; i++)
    for (var i = 0; i < 10; i++)
    {
        console.log(dead_regions[0]);
        console.log(dead_regions[0].latitude);
        console.log(dead_regions[0].longitude);

    }
    initialize_dead_regions_map(dead_regions);
}//







function initialize_dead_regions_map(dead_regions) {
    var center = new google.maps.LatLng(54.44419, -2.0);
    //var center = new google.maps.LatLng(52.0542684, 1.1231652);

    var map = new google.maps.Map(document.getElementById('dead_regions_map'), {
        zoom: 5,
        center: center,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });




    var markers = [];
    for (var i = 0; i < dead_regions.length; i++) {
        var dead_region =dead_regions[i];

        var contentString='<h3>'+dead_region.postcode+'</h3>'+'<i class="fa fa-industry" aria-hidden="true"></i> '+dead_region.brand_name+'<br>'+'<i class="ukwfa ukwfa-threeappliancelogo" aria-hidden="true"></i> '+dead_region.product_type_name;


        var latLng = new google.maps.LatLng(dead_region.latitude,
            dead_region.longitude);
        var marker = new google.maps.Marker({
            position: latLng,
            icon: 'images/dead_location_map_pointer.png',
            title:contentString
        });

        google.maps.event.addListener(marker, 'click', getInfoCallback(map, contentString));


        markers.push(marker);
    }///end of for

    var markerCluster = new MarkerClusterer(map, markers, {imagePath: 'images/markercluster/m'});

    // onClick OVERRIDE
    markerCluster.onClick = function(clickedClusterIcon) {
        return multiChoice(clickedClusterIcon.cluster_);
    }

}///end of function     function initialize(dead_regions) {


function getInfoCallback(map, content) {

    document.getElementById('dead-list-in-cluster').style.display='none';
    var infowindow = new google.maps.InfoWindow({content: content});
    return function() {
        infowindow.setContent(content);
        infowindow.open(map, this);
    };
}///end of function getInfoCallback(map, content) {


function multiChoice(clickedCluster) {
    if (clickedCluster.getMarkers().length > 1)
    {
        // var markers = clickedCluster.getMarkers();
        // do something creative!
        clusterinfo='';
        for(var x=0;x<clickedCluster.getMarkers().length;x++)
        {
            mark=clickedCluster.getMarkers()[x];
            console.log(mark.title);
            clusterinfo=clusterinfo+'<hr>'+mark.title
        }
        document.getElementById('dead-list-in-cluster').innerHTML='';
        document.getElementById('dead-list-in-cluster').innerHTML=clusterinfo;

        document.getElementById('dead-list-in-cluster').style.display='block';


        return false;
    }
    return true;
};

