<?php
/* @var $this DocumentsmanualsController */
/* @var $model Documentsmanuals */
/* @var $form CActiveForm */
?>


<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'documentsmanuals-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>


    <div class="quote contentbox">


        <?php
        if ($model->isNewRecord) {
            $preview_link = "#";
            $blk_display = "none";
        } else {
            $blk_display = "block";
            $preview_link = Yii::app()->request->baseUrl . "/documents_manuals/" . $model->filename;
        }

        ?>

        <table>
            <tr>
                <td colspan="2">
                    <div style="float: right;">
                        <?php echo CHtml::submitButton('Save', array('class' => 'success text-center', 'style' => 'width:100%')); ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="upload_preview" style="display: <?php echo $blk_display; ?>">

                        <div style="font-size:10px;" id="filename_title">
                            <?php echo $model->filename; ?>
                        </div>
                        <embed src='<?php echo $preview_link; ?>' style="width: 100%;"> </embed>
                        <?php
                        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                            'id' => 'preview_dialog',

                            // additional javascript options for the dialog plugin
                            'options' => array(
                                'title' => 'Preview box',
                                'autoOpen' => false,
                                'modal' => true,
                                'show' => 'effect: "blind",duration: 1000',
                                'hide' => 'effect: "explode",duration: 1000',
                                'width' => 800,
                                'height' => 800,

                            ),
                        ));

                        $this->renderPartial('minipreview', array('preview_link' => $preview_link));

                        $this->endWidget('zii.widgets.jui.CJuiDialog');

                        // the link that may open the dialog
                        echo CHtml::link('Preview<br><i class="fa fa-file-text fa-3x" aria-hidden="true"></i>', '#', array(
                            'onclick' => '$("#preview_dialog").dialog("open"); return false;',
                        ));
                        ?>
                    </div>

                </td>
                <td>
                    <div>
                        <?php echo $form->fileField($model, 'upload', array('class' => 'drag_upload', 'style' => 'width: 745px;  height: 420px;')); ?>
                        <?php echo $form->error($model, 'upload'); ?>
                    </div>
                </td>
            </tr>
        </table>


        <table style="width: 100%">
            <tr>
                <th style="width: 33%"></th>
                <th style="width: 33%"></th>
                <th style="width: 33%"></th>
            </tr>
            <tr>
                <td colspan="3">

                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <?php echo $form->labelEx($model, 'name'); ?>
                        <?php echo $form->textField($model, 'name', array('style' => 'width:100%; ')); ?>
                        <?php echo $form->error($model, 'name'); ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="row">
                        <?php echo $form->labelEx($model, 'description'); ?>
                        <?php echo $form->textArea($model, 'description', array('style' => 'width:100%; height: 100px')); ?>
                        <?php echo $form->error($model, 'description'); ?>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="row">
                        <?php
                        if ($model->isNewRecord) {
                            $model->product_type_id = 1000000;
                        }
                        ?>
                        <?php echo $form->labelEx($model, 'product_type_id'); ?>
                        <?php echo $form->dropDownList($model, 'product_type_id', Product::model()->getProductTypes()); ?>
                        <?php echo $form->error($model, 'product_type_id'); ?>

                        <br>
                        <h1>
                            <div id="product-type-icon">
                            <div class="ukwfa ukwfa-threeappliancelogo"></div>
                            <?php if (!$model->isNewRecord): ?>
                                <?php echo Setup::model()->getawesomeapplianceicon($model->product_type->name); ?>
                            <?php endif; ?>
                            </div>
                        </h1>


                    </div>
                </td>

                <td>
                    <div class="row">
                        <?php
                        if ($model->isNewRecord) {
                            $model->brand_id = 1000000;
                        }
                        ?>
                        <?php echo $form->labelEx($model, 'brand_id'); ?>
                        <?php echo $form->dropDownList($model, 'brand_id', Product::model()->getAllBrands()); ?>
                        <?php echo $form->error($model, 'brand_id'); ?>

                        <br>
                        <h1>
                            <div id="brand-icon">
                                <?php if ($model->isNewRecord): ?>
                                    <div class="ukwfa ukwfa-threeappliancelogo"></div>
                                <?php else: ?>
                                    <?php echo Setup::model()->getawesomebrandicon($model->brand->name); ?>
                                <?php endif; ?>
                            </div>

                        </h1>

                    </div>
                </td>

                <td>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'model_nos'); ?>
                        <small>(This can help you while searching)</small>
                        <?php echo $form->textArea($model, 'model_nos', array('rows' => 6, 'cols' => 50)); ?>
                        <?php echo $form->error($model, 'model_nos'); ?>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'filename'); ?>
                        <?php echo $form->textField($model, 'filename', array('rows' => 6, 'cols' => 50)); ?>
                        <?php echo $form->error($model, 'filename'); ?>
                    </div>
                </td>

                <td>

                    <div class="row">

                        <?php echo $form->labelEx($model, 'version'); ?>
                        <?php echo $form->textField($model, 'version', array('rows' => 6, 'cols' => 50)); ?>
                        <?php echo $form->error($model, 'version'); ?>
                    </div>

                </td>

                <td>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'document_type_id'); ?>
                        <?php echo $form->dropDownList($model, 'document_type_id', $model->getAllDocumenttypesforDropdown()); ?>
                        <?php echo $form->error($model, 'document_type_id'); ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <?php
                        if ($model->isNewRecord) {
                            $model->active = 1;
                        }
                        ?>
                        <?php echo $form->labelEx($model, 'active'); ?>
                        <?php //echo $form->textField($model,'active'); ?>
                        <?php echo $form->dropDownList($model,
                            'active',
                            array(0 => 'No', 1 => 'Yes')
                        );
                        ?>
                        <?php echo $form->error($model, 'active'); ?>
                    </div>
                </td>
                <td colspan="2">
                    <div class="row">
                        <?php echo CHtml::submitButton('Save', array('class' => 'success text-center', 'style' => 'width:100%')); ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->


<script>

    $("#Documentsmanuals_upload").on("change", function () {

        readURL(this);


        var file = this.files[0];

        file_title = file.name;
        formatted_filename = file_title.toLowerCase();
        formatted_filename = formatted_filename.replace(/\s+/g, '');

        var r = confirm("Do you want to import Name and Title");
        if (r == true) {
            extracthefilename(file_title, formatted_filename);
        }
        $("#Documentsmanuals_upload").css("background", "");
        $("#Documentsmanuals_upload").css("width", "");
        $("#Documentsmanuals_upload").css("height", "");


    });


    $("#Documentsmanuals_product_type_id").on("change", function () {

        selected_pt = $("#Documentsmanuals_product_type_id option:selected").text();
        appendfilename(selected_pt);

        fa_pt = selected_pt.toLowerCase();
        fa_pt = fa_pt.replace(/\s+/g, '');

        $("#product-type-icon").html("");
        $("#product-type-icon").removeAttr('class');
        $("#product-type-icon").addClass("ukwfa ukwfa-" + fa_pt + " fa-4x");

    });


    $("#Documentsmanuals_brand_id").on("change", function () {


        selected_bt = $("#Documentsmanuals_brand_id option:selected").text();


        appendfilename(selected_bt);

        fa_bt = selected_bt.toLowerCase();
        fa_bt = fa_bt.replace(/\s+/g, '');


        console.log("Brand changed called" + fa_bt);

        $("#brand-icon").html("");
        $("#brand-icon").removeAttr('class');
        $("#brand-icon").addClass("ukw-logo-fa ukw-logo-fa-" + fa_bt + "");


    });


    function appendfilename(append_text)
    {
        console.log('append file called'+append_text);
        doc_c_name=$("#Documentsmanuals_name").val();

        new_doc_name=doc_c_name+' '+ append_text;

        console.log('append file called'+new_doc_name);

        $("#Documentsmanuals_name").val(new_doc_name);




    }//end of appendfilename

    function readURL(input) {

        $("#upload_preview").show();

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_preview_tag').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    function extracthefilename(f_title, f_filename) {
        $("#Documentsmanuals_name").val(f_title);
        $("#Documentsmanuals_filename").val(f_filename);
        $("#filename_title").html(f_filename);


    }


</script>









