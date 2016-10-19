/**
 * Created by sudeeptalati on 21/09/2016.
 */
frontend_url=document.getElementById('frontend_url').value;

function zoommaptopostcode(lat,lng)
{
    var zoomlevel=4;
    console.log('zoomlevel'+zoomlevel+' ');
    engineeersmap.setZoom(12);
    var myce = new google.maps.LatLng(lat,lng);
    engineeersmap.setCenter(myce);
    engineeersmap.setOptions({ minZoom: 5, maxZoom: 15 });
}


function recordenquiryclick(engineer_id)
{
    enquiryclickurl="index.php?r=findanengineer/enquiryclick&engineer_id="+engineer_id;
    console.log(enquiryclickurl);
    $.post(enquiryclickurl, function(data, status){
        console.log("Data: " + data + "\nStatus: " + status);
    });
}

function recordphoneclick(engineer_id)
{
    phoneclickurl="index.php?r=findanengineer/phoneclick&engineer_id="+engineer_id;
    console.log(phoneclickurl);
    $.post(phoneclickurl, function(data, status){
        console.log("Data: " + data + "\nStatus: " + status);
    });
}


function recordmapclick(engineer_id)
{
    mapclickurl=frontend_url+"/findanengineer/mapclick?engineer_id="+engineer_id;
    console.log(mapclickurl);
    $.post(mapclickurl, function(data, status){
        console.log("Data: " + data + "\nStatus: " + status);
    });
}

function display_engineers_map(all_engg_json_data)
{
//        for (var i = 0; i < all_engg_json_data.length; i++)
    for (var i = 0; i < 10; i++)
    {
        console.log(all_engg_json_data[0]);
        console.log(all_engg_json_data[0].latitude);
        console.log(all_engg_json_data[0].longitude);

    }
    console.log('display_engineers_map  map initialized');
    initialize_google_map_for_all_engineers(all_engg_json_data);
}//

function initialize_google_map_for_all_engineers(all_engg_json_data) {

    console.log('Google  map initialized');
    var center = new google.maps.LatLng(54.44419, -2.0);

    engineeersmap = new google.maps.Map(document.getElementById('engineersmap'), {
        zoom: 5,
        center: center,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    engineeersmap.setOptions({ minZoom: 5, maxZoom: 10 });


    var markers = [];
    for (var i = 0; i < all_engg_json_data.length; i++) {
        var engineer =all_engg_json_data[i];


        engg_url='http://www.ukwhitegoods.co.uk/images/findanengineer/technician.png';
        wta_member_url='http://www.ukwhitegoods.co.uk/images/findanengineer/wta_member.png';


        var latLng = new google.maps.LatLng(engineer.latitude,
            engineer.longitude);

        ///We will display info of only WTA members
        if (engineer.wta_member==1)
        {
            var marker = new google.maps.Marker({
                position: latLng,
                icon: wta_member_url,
            });



            sendenquiry_url=frontend_url+'/findanengineer/sendenquiry?engineer_id='+engineer.id;
            console.log('frontend_url ' +sendenquiry_url);

            var contentString='<h1 title="Member of Whitegoods Trade Assciation"><i class="fa fa-star" aria-hidden="true"></i> <i class="ukw-logo-fa ukw-logo-fa-wta"></i></h1><h2>'+engineer.name+'</h2><h4>'+engineer.line_1+' '+engineer.line_2+'</h4>';
            contentString=contentString+'<h4>'+engineer.town+', '+engineer.postcode_s+' '+engineer.postcode_e+'</h4>';
            contentString=contentString+'<a target="_blank" href="'+sendenquiry_url+'" >'
            contentString=contentString+'<button onclick="recordmapclick('+engineer.id+')" class="btn btn-info" >Send Enquiry</button>';
            contentString=contentString+'</a>'


            google.maps.event.addListener(marker, 'click', getEngineerInfoCallback(engineeersmap, contentString));
        }
        else
        {
            var marker = new google.maps.Marker({
                position: latLng,
                icon: engg_url,
            });

        }

        markers.push(marker);
    }

    var markerCluster = new MarkerClusterer(engineeersmap, markers, {imagePath: 'http://www.ukwhitegoods.co.uk/images/findanengineer/markercluster/m'})
    console.log(window.location.hostname );
}
//google.maps.event.addDomListener(window, 'load', initialize);

function getEngineerInfoCallback(map, content) {
    var enggInfowindow = new google.maps.InfoWindow({content: content});
    return function() {
        enggInfowindow.setContent(content);
        enggInfowindow.open(map, this);
    };
}

