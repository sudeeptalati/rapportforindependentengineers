<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 11/10/2016
 * Time: 09:15
 */
?>

<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 27/07/2016
 * Time: 15:52
 */

$searchurl = $this->createUrl('documentsmanuals/search_docs_manuals');
$linkurl = $this->createUrl('documentsmanuals/linkdocumenttoservicecall');

$keyword = "madam";
$service_id = $_GET['id'];///this is when called from servicecall page
?>







<h2>
    <div class="fa fa-paperclip"></div>
    Link attachments

    <div style="float:right;">
        <a href="" target="_blank">
            <h4>
                <?php echo CHtml::link('<i class="fa fa-plus-circle"></i>UPLOAD',array('documentsmanuals/create'), array(
                    'target'=>'_blank',
                    //'onclick'=>'window.open("","menubar=no, toolbar=no");'

                )); ?>
            </h4>
        </a>
    </div>
</h2>

<div class="contentbox">
    <input id="searchterm_for_docs_manuals" placeholder="Search by Document Name or Model No or Brand or Product Type" class="note"
           style="width:80%;height: 25px; border-radius: 10px;"/>
</div>
<table id='docs_manuals_table' border="2">

</table>
<div class="result" id="result">

</div>


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
    }

</style>

<script>

    $("#searchterm_for_docs_manuals").keyup(function () {
        searchwithkeyword_for_docs_manuals();
    });


    function searchwithkeyword_for_docs_manuals() {
        searchterm_for_docs_manuals = $("#searchterm_for_docs_manuals").attr('value');

        url = "<?php echo $searchurl; ?>";
        url = url + "&keyword=" + searchterm_for_docs_manuals;

        console.log(url);
        $.get(url, function (data) {
            //$( ".result" ).html( data );
            display_docs_manuals_results(data)
        });
    }///end of function searchwithkeyword()


    function display_docs_manuals_results(stringdata) {
        $('#docs_manuals_table').empty();

        $('#docs_manuals_table').append('<tr><th>File Name</th><th>Model Nos</th><th>Description</th><th></th></tr>');


        response = $.parseJSON(stringdata);

        $(function () {
            $.each(response, function (i, item) {
                console.log(item);


                $('#docs_manuals_table').append('<tr id="rowno' + i + '" class="mytr" >' +
                    '<td onclick="select_document_or_manual('+item.id+')" ><span style="color:#0088cc" >' + formatvalue(item.name) + '</span></td>' +
                    '<td> ' + formatvalue(item.model_nos) + ' </td>' +
                    '<td> ' + item.description + ' </td>' +
                    '<td style="color:#0088cc" onclick="show_result_doc_preview( ' + '\'' + item.filename + '\'' + ' ) " > <i class="fa fa-search-plus fa-2x"></i> </td>' +


                    '</tr>');


            });
        });
    }///end of  function displayoutput(stringdata)



    function select_document_or_manual(doc_id)
    {
        servicecall_id='<?php echo $service_id;?>';
        console.log('Doc id : '+doc_id);
        console.log('service_id id : '+servicecall_id);
        linkurl='<?php echo $linkurl; ?>';

        var jqxhr = $.post( linkurl, { service_id: servicecall_id, document_id: doc_id } ,  function(data) {

            if (data=='1')
            {
                alert( "Document Linked");
                location.reload();
            }
            else
            {
                error_text=$(data).text();///since it is in form of HTML
                alert(error_text);
            }



        })
            .done(function() {
                console.log( "second success" );
                //

            })
            .fail(function() {
                alert( "error: Could not link document" );
            })
            .always(function() {
                console.log( "finished" );
            });


    }////end of function select_document_or_manual()



///////Preview////////////
    function show_result_doc_preview(filename) {
        console.log("Show cdoc " + filename);

        var src = "<?php echo Yii::app()->request->baseUrl; ?>/documents_manuals/" + filename;

        $("#img_preview_tag").attr("src", src);
        $("#new_window_link").attr("href", src);


        console.log("Show cdoc " + src);

        $("#preview_dialog").dialog("open");


    }


    $(function () {
        $("#preview_dialog").dialog({


            width: "800px",
            //height: "800px",

            modal: true,
            autoOpen: false,
            show: {
                effect: "blind",
                duration: 1000
            },
            hide: {
                effect: "explode",
                duration: 1000
            }
        });


    });


</script>


<div id="preview_dialog" title="Preview" style="width: 800px;height: 800px;">
    <?php
    $preview_link = '#';
    $this->renderPartial('/documentsmanuals/minipreview', array('preview_link' => $preview_link));

    ?>
</div>




