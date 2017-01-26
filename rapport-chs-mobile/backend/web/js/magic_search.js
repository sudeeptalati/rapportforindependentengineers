$("#magic_search_box").focus();


$( "#magic_search_box" ).keyup(function() {

    start_global_search();
    
});


function start_global_search()
{
    var keyword= $( "#magic_search_box" ).val();

    if (keyword.length<3)
    {
        $('#searchresultdata').html("").show();
    }

    if (keyword.length>3){
        call_ajax_search(keyword);

    }else///end of if (keyword.length>3){
   {
        console.log("Enter more ");
    }///end of     else (keyword.length>3){


}///end of function start_global_search()


function call_ajax_search(keyword)
{
    var baseurl=$( "#baseUrl" ).val();



    search_url=baseurl+"/servicecall/freesearch";

    dataString= 'keyword='+ keyword;

    console.log("Enter search_url "+search_url);
    console.log("Enter dataString "+dataString);


    $.ajax({
        type: "GET",
        url: search_url,
        data:dataString,
        success: function(server_response)
        {

            $('#searchresultdata').html(server_response).show();




            highlight_the_keyword(keyword, server_response);


        }//end of success
    });//end of $.ajax

}//end of {function call_ajax_search(keyword)



function highlight_the_keyword(keyword, full_data)
{

    console.log("highlight_the_keyword");
    var src_str =full_data;
    var term = keyword;

    term=term.trim();
    term = term.replace(/(\s+)/,"(<[^>]+>)*$1(<[^>]+>)*");
    var pattern = new RegExp("("+term+")", "gi");

    src_str = src_str.replace(pattern, "<highlight>$1</highlight>");
    src_str = src_str.replace(/(<highlight>[^<>]*)((<[^>]+>)+)([^<>]*<\/highlight>)/,"$1</highlight>$2<highlight>$4");

    $('#searchresultdata').html(src_str).show();

    $("highlight").fadeOut("slow");
    $("highlight").fadeIn("slow");


}