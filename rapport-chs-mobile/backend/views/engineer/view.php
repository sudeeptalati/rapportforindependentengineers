<?php

use common\models\Engineerpostcodes;
use common\models\Engineerauthorisedbrands;
use common\models\Handyfunctions;
use common\models\postcodes;
use common\models\brand;

use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\Dialog;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

use yii\jui\Draggable;
/* @var $this yii\web\View */
/* @var $model common\models\Engineer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Engineers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<h1><?= Html::encode($this->title) ?></h1>

<div style="float: right;cursor:move">

    <?php Draggable::begin([
        'clientOptions' => ['grid' => [50, 20]],
        'options'=>['style'=>'position:fixed;top:100px; width:200px',]
    ]);
    ?>

    <div  class="bg-primary alert">

        <h4>
            <i style="color:white;" class="fa fa-line-chart"></i>&nbsp;
            <a style="color:white;" href="#stats-view">Stats</a>
        </h4>
        <h4>
            <i style="color:white;" class="ukwfa ukwfa-cookeroven"></i>&nbsp;
            <a style="color:white;" href="#appliances-view">Appliances</a>
        </h4>
        <h4>
            <i style="color:white;" class="fa fa-industry" aria-hidden="true"></i>&nbsp;
            <a style="color:white;" href="#brands-view">Brands</a>
        </h4>
        <h4>
            <i style="color:white;" class="fa fa-certificate" aria-hidden="true"></i>&nbsp;
            <a style="color:white;" href="#authorised-brands-view">Authorised</a>
        </h4>


        <h4>
            <i style="color:white;" class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;
            <a style="color:white;" href="#postcodes-view">Postcodes</a>
        </h4>

        <h4 class="bg">
            <i style="color:white;" class="fa fa-cog" aria-hidden="true"></i>&nbsp;
            <a style="color:white;" href="#accounts-view">My Accout</a>
            <div style="float:right">
                <?= Html::a('<i class="fa fa-pencil-square-o" ></i>', ['update', 'id' => $model->id], ['class' => 'bg-primary']) ?>
            </div>
        </h4>

        <h4>
            <i style="color:white;" class="fa fa-user" aria-hidden="true"></i>&nbsp;
            <a style="color:white;" href="#user-view">User</a>
        </h4>

    </div>

    <?php Draggable::end();?>
</div>





<div id="stats-view" style="margin-bottom: 100px"></div>

<table style="width: 100%">
    <tr>
        <td class="text-center" title="Phone Clicks">
            <i class="fa fa-hand-pointer-o fa-4x" aria-hidden="true"></i>
            <i class="fa fa-phone fa-4x" aria-hidden="true"></i>
            <h2>
                <?php echo $model->phoneclicks; ?>
            </h2>
        </td>
        <td class="text-center" title="Enquiry Clicks">
            <i class="fa fa-hand-pointer-o fa-4x" aria-hidden="true"></i>
            <i class="fa fa-envelope-o fa-4x" aria-hidden="true"></i>
            <h2>
                <?php echo $model->enquiryclicks; ?>
            </h2>
        </td>
        <td class="text-center" title="Impressions (No of times listed in search results)">
            <i class="fa fa-paperclip fa-4x" aria-hidden="true"></i>
            <i class="fa fa-desktop fa-4x" aria-hidden="true"></i>
            <h2>
                <?php echo $model->impressions; ?>
            </h2>

        </td>
    </tr>
</table>



<div class="engineer-view">




    <div id="appliances-view" style="padding-top:50px"></div>

    <table style="width: 100%">
        <tr>
            <td style="text-align: left;">



                <?= Html::a('<h4>Add All Appliances <i class="fa fa-stack-overflow" aria-hidden="true"></i> </h4>', ['engineer/addallproducts', 'engineer_id' => $model->id], [
                    'class' => 'btn btn-info',
                    'data' => [
                        'confirm' => 'Are you sure you want to add all appliances ?',
                        'method' => 'post',
                    ],
                ]) ?>
                <span class="appliancebrandpostcodeheading">Appliances</span>
                <span title="Total number of Appliance you do">
                        (<?php echo count($model->engineerproducttypes); ?>)
                </span>






            </td>

            <td>
                <div id="show-hide-appliances-we-reapir"><a id="appliances-onoffbtn" class="fa fa-toggle-on fa-4x"
                                                            aria-hidden="true"
                                                            style="cursor: pointer; float: right;"> </a></div>
            </td>
        </tr>
    </table>

    <div class="appliancebrandpostcodecontainer" id="appliance-we-repair" style="display: block;">
        <table style="width:100%">
            <tr>
                <th style="width:250px;"></th>
                <th style="width:250px;"></th>
                <th style="width:250px;"></th>
                <th style="width:250px;"></th>
            </tr>
            <tr>
                <?php
                $allengineerproducttypes = $model->engineerproducttypes;

                usort($allengineerproducttypes, 'my_producttype_object_sort_function');
                function my_producttype_object_sort_function($a, $b)
                {
                    return $a->productnames->product_type > $b->productnames->product_type;
                }

                //var_dump($allenggbrands );
                ?>


                <?php $trcout = 0; ?>
                <?php //foreach ($model->engineerproducttypes as $producttype): ?>
                <?php foreach ($allengineerproducttypes as $producttype): ?>
                    <td title="<?php echo $producttype->productnames->product_type; ?>">


                        <h1>
                            <?php echo Handyfunctions::getawesomeapplianceicon($producttype->productnames->product_type); ?>
                        </h1>
                        <h4>
                            <?php echo $producttype->productnames->product_type; ?>
                        </h4>
                        <?php $delete_product_type_url = $url = Url::to(['engineer/deleteproduct', 'product_id' => $producttype->product_id, 'engineer_id' => $model->id]); ?>
                        <a href="<?php echo $delete_product_type_url; ?>">

                            <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                        </a>

                    </td>
                    <?php $trcout++; ?>
                    <?php if ($trcout == 4) {
                        echo "</tr><tr>";
                        $trcout = 0;
                    } ?>

                <?php endforeach; ?>
            </tr>
        </table>
    </div><!-- End of id="appliance-we-repair" -->

    <hr>
    <div id="brands-view" style="padding-top:50px"></div>

    <table style="width: 100%">
        <tr>
            <td>

                <?= Html::a('<h4>Add All Brands <i class="fa fa-stack-overflow" aria-hidden="true"></i> </h4>', ['engineer/addallbrands', 'engineer_id' => $model->id], [
                    'class' => 'btn btn-info',
                    'data' => [
                        'confirm' => 'Are you sure you want to add all Brands ?',
                        'method' => 'post',
                    ],
                ]) ?>



                <span class="appliancebrandpostcodeheading">Brands</span>
                <span title="Total number of brands you do">
                        (<?php echo count($model->engineerbrands); ?>)
                </span>
            </td>
            <td>

            </td>

            <td>
                <div id="show-hide-brands-we-reapir"><a id="brands-onoffbtn" class="fa fa-toggle-on fa-4x"
                                                        aria-hidden="true"
                                                        style="cursor: pointer; float: right;"> </a></div>
            </td>
        </tr>
    </table>


    <div class="appliancebrandpostcodecontainer" id="brands-we-repair">
        <table>
            <tr>
                <th style="width:250px;"></th>
                <th style="width:250px;"></th>
                <th style="width:250px;"></th>
                <th style="width:250px;"></th>
                <th style="width:250px;"></th>
            </tr>
            <tr>

                <?php
                $allenggbrands = $model->engineerbrands;

                usort($allenggbrands, 'my_brand_object_sort_function');
                function my_brand_object_sort_function($a, $b)
                {
                    return $a->brandname->manufacturer > $b->brandname->manufacturer;
                }

                //var_dump($allenggbrands );
                ?>
                <?php $trcout = 0; ?>
                <?php foreach ($allenggbrands as $brands): ?>
                    <td title="<?php echo $brands->brandname->manufacturer; ?>">


                        <h1>
                            <?php echo Handyfunctions::getawesomebrandicon($brands->brandname->manufacturer); ?>
                        </h1>
                        <h4>
                            <?php echo $brands->brandname->manufacturer; ?>
                        </h4>

                        <?php $delete_brand_url = Url::to(['engineer/deletebrand', 'brand_id' => $brands->manufacturer_id, 'engineer_id' => $model->id]); ?>
                        <a href="<?php echo $delete_brand_url; ?>">

                            <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                        </a>


                    </td>
                    <?php $trcout++; ?>
                    <?php if ($trcout == 5) {
                        echo "</tr><tr>";
                        $trcout = 0;
                    } ?>

                <?php endforeach; ?>
            </tr>


        </table>

    </div><!-- End of id="brands-we-repair" -->

    <hr>
    <div id="postcodes-view" style="padding-top:50px"></div>


    <table style="width: 100%">
        <tr>
            <td>
                <i class="fa fa-map-marker fa-3x" aria-hidden="true"></i>
                <span class="appliancebrandpostcodeheading">Postcodes</span>
            </td>
            <td>

            </td>

            <td>
                <div id="show-hide-postcodes-we-cover"><a id="postcodes-we-cover-onoffbtn" class="fa fa-toggle-on fa-4x"
                                                          aria-hidden="true"
                                                          style="cursor: pointer; float: right;"> </a></div>
            </td>
        </tr>
    </table>


    <!-- add div postcodess-->
    <div id="multiselectpostcode-div"
         style="float: left;padding: 18px;background: #e2e2e2;border-radius: 10px;margin-right: 7px;">

        <?php
        $all_postcodes = Postcodes::find()->all();
        $all_postcodes_array = ArrayHelper::map($all_postcodes, 'postcode_id', 'postcode_s');

        $engineer_postcodes = Engineerpostcodes::find()->where(['technician_id' => $model->id])->all();

        ///we do not want to show postcodes in the dropdown which are already used
        foreach ($engineer_postcodes as $ep) {
            //echo " ".$ep->postcode_id;
            unset($all_postcodes_array[$ep->postcode_id]);
        }


        ///////////////////////////
        ?>

        <?php
        /* parameterized initialization */
        $form = ActiveForm::begin();
        $form->id = 'add_selected_postcodes';
        $form->action = Url::to(['engineer/addselectedpostcodes', 'engineer_id' => $model->id]);
        $form->method = 'post';

        ?>


        <?= Html::dropDownList('postcodes', null, $all_postcodes_array, ['multiple' => 'multiple', 'style' => 'height:289px;width:100px;']) ?>
        <br>

        <?= Html::submitButton('Add', ['class' => 'btn btn-success', 'style' => 'width:100%']) ?>

        <?php ActiveForm::end(); ?>


    </div><!-- end aof add div postcodess-->


    <div class="appliancebrandpostcodecontainer" id="postcodes-we-cover">


        <table>
            <tr>
                <th style="width:250px;"></th>
                <th style="width:250px;"></th>
                <th style="width:250px;"></th>
                <th style="width:250px;"></th>
                <th style="width:250px;"></th>
            </tr>
            <tr>

                <?php
                $allenggpostcodes = $model->engineerpostcodes;


                usort($allenggpostcodes, 'my_postcode_object_sort_function');
                function my_postcode_object_sort_function($a, $b)
                {
                    return $a->postcodename->postcode_s > $b->postcodename->postcode_s;
                }

                ?>
                <?php $trcout = 0; ?>
                <?php foreach ($allenggpostcodes as $postcodes): ?>
                    <td title="<?php echo $postcodes->postcodename->postcode_s; ?>">
                        <h4>
                            <?php echo $postcodes->postcodename->postcode_s; ?>
                        </h4>
                        <?php $delete_postcode_url = $url = Url::to(['engineer/deletepostcode', 'postcode_id' => $postcodes->postcodename->postcode_id, 'engineer_id' => $model->id]); ?>
                        <a href="<?php echo $delete_postcode_url; ?>">

                            <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                        </a>

                    </td>
                    <?php $trcout++; ?>
                    <?php if ($trcout == 5) {
                        echo "</tr><tr>";
                        $trcout = 0;
                    } ?>

                <?php endforeach; ?>
            </tr>


        </table>

    </div><!-- End of id="postcodes-we-cover" -->
    <hr>


    <div id="user-view" style="padding-top:50px"></div>


    <!-- Link Users-->
    <table style="width: 100%">
        <tr>
            <td>
                <i class="fa fa-user fa-3x" aria-hidden="true"></i>
                <span class="appliancebrandpostcodeheading">User</span>
            </td>
            <td>

            </td>

            <td>
                <div id="show-hide-user">
                    <a id="user-onoffbtn" class="fa fa-toggle-on fa-4x"
                       aria-hidden="true"
                       style="cursor: pointer; float: right;"> </a>
                </div>
            </td>
        </tr>
    </table>

    <div class="appliancebrandpostcodecontainer" id="user-div">

        <?php //echo $model->email; ?>
        <?php $user = User::findByEmail($model->email); ?>

        <?php if ($user): ?>
            <table style="width: 100%   ">
                <tr>
                    <th>Name</th>
                    <td><h4><?php echo $user->name; ?></h4></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><h4><?php echo $user->username; ?></h4></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><h4><?php echo $user->email; ?></h4></td>
                </tr>
            </table>

            <?= Html::a('<h3><i class="fa fa-user fa-3x" ></i>&nbsp;&nbsp;@</h3>', ['#', 'id' => $model->id], ['onclick' => '$("#update_engineer_email_dialog").dialog("open"); return false;', 'title' => 'Update User Email for Engineer', 'class' => 'btn btn-warning']) ?>

            <?php $password_reset_url=  Yii::$app->params['frontend_url'].'/site/request-password-reset'; ?>

            <a target='_blank' title='Send Password reset link' class='btn btn-success' href="<?php echo $password_reset_url;?>">
                <h3><i class="fa fa-key fa-3x" ></i>&nbsp;&nbsp;@</h3>
            </a>
            <?php


            Dialog::begin([
                'id' => 'update_engineer_email_dialog',
                'clientOptions' => [
                    'modal' => true,
                    'title' => 'Update Email',
                    'autoOpen' => false,
                    'width' => '600px',
                ],
            ]);

            echo $this->render('updateengineeremail', [
                'user' => $user,
                'engineer' => $model,
            ]);

            Dialog::end();
            ?>
        <?php else: ?>
            <?= Html::a('<h3><i class="fa fa-user fa-3x" ></i>&nbsp;&nbsp;@</h3>', ['createuserforengineer', 'engineer_id' => $model->id], ['title' => 'Create User for Engineer', 'class' => 'btn btn-success']) ?>
        <?php endif; ?>

        <br>
        <br>
        <div class="bg-warning container">
            <ul></ul>
            <ul>
                There is only one single <b>email</b>, which is used for login, password reset and contact form
            </ul>
        </div>

    </div> <!-- Link Users-->

    <hr>

    <div id="authorised-brands-view" style="padding-top:50px"></div>






    <table style="width: 100%">
        <tr>
            <td style="text-align: left;">
                <!--
                <?= Html::a('<h4>Add All Authorised Brands <i class="fa fa-stack-overflow" aria-hidden="true"></i> </h4>', ['engineer/addallauthorisedbrands', 'engineer_id' => $model->id], [
                    'class' => 'btn btn-info',
                    'data' => [
                        'confirm' => 'Are you sure you authorised to work on all brands?',
                        'method' => 'get',
                    ],
                ]) ?>
                -->

                <i class="fa fa-certificate fa-3x" aria-hidden="true"></i>
                <span class="appliancebrandpostcodeheading">Authorised Brands</span>
                <span title="Total number of brands you do">
                        (<?php echo count($model->engineerauthorisedbrands); ?>)
                </span>

            </td>

            <td>
                <div id="show-hide-authorisedbrands"><a id="authorisedbrands-onoffbtn" class="fa fa-toggle-on fa-4x"
                                                        aria-hidden="true"
                                                        style="cursor: pointer; float: right;"> </a></div>
            </td>
        </tr>
    </table>


    <div class="appliancebrandpostcodecontainer" id="engineer-authorised-brands" style="display: block;">
        <!-- add div postcodess-->

        <div id="authorised-brand-select-div" >
            <?php
            $all_brands = Brand::find()->all();
            $all_brands_array = ArrayHelper::map($all_brands, 'manufacturer_id', 'manufacturer');

            $engineer_authorised_brands = Engineerauthorisedbrands::find()->where(['technician_id' => $model->id])->all();

            ///we do not want to show postcodes in the dropdown which are already used
            foreach ($engineer_authorised_brands as $e_a_b) {
                //echo " ".$ep->postcode_id;
                unset($all_brands_array[$e_a_b->manufacturer_id]);
            }

            asort($all_brands_array);


            ///////////////////////////
            ?>

            <?php
            /* parameterized initialization */
            $form = ActiveForm::begin();
            $form->id = 'add_selected_brand_as_authorised_brand';
            $form->action = Url::to(['engineer/addselectedauthorisedbrand', 'engineer_id' => $model->id]);
            $form->method = 'post';

            ?>

            <table>
                <tr>
                    <td>
                        <?= Html::dropDownList('authorised_brand_id','',$all_brands_array,['class' => 'form-control'])?>
                    </td>
                    <td>
                        <?= Html::submitButton('Add', ['class' => 'btn btn-success', 'style' => 'width:100%']) ?>
                    </td>
                </tr>
            </table>




            <?php ActiveForm::end(); ?>


        </div><!-- end aof add div authorised-brand-select-div-->
        <table style="width:100%">
            <tr>
                <th style="width:250px;"></th>
                <th style="width:250px;"></th>
                <th style="width:250px;"></th>
                <th style="width:250px;"></th>
            </tr>
            <tr>
                <td colspan="4">


                </td>
            </tr>
            <tr>
                <?php
                $engineerauthorisedbrands = $model->engineerauthorisedbrands;

                usort($engineerauthorisedbrands, 'my_authorised_brands_object_sort_function');
                function my_authorised_brands_object_sort_function($a, $b)
                {
                    return $a->brandname->manufacturer > $b->brandname->manufacturer;
                }

                //var_dump($allenggbrands );
                ?>


                <?php $trcout = 0; ?>
                <?php //foreach ($model->engineerproducttypes as $producttype): ?>
                <?php foreach ($engineerauthorisedbrands as $authorised_brand): ?>
                    <td title="<?php echo $authorised_brand->brandname->manufacturer; ?>">


                        <h1>
                            <?php echo Handyfunctions::getawesomebrandicon($authorised_brand->brandname->manufacturer); ?>
                        </h1>
                        <h4>
                            <?php echo $authorised_brand->brandname->manufacturer; ?>
                        </h4>
                        <?php $delete_authorised_brand_url = $url = Url::to(['engineer/deleteauthorisedbrand', 'authorised_brand_id' => $authorised_brand->manufacturer_id, 'engineer_id' => $model->id]); ?>
                        <a href="<?php echo $delete_authorised_brand_url; ?>">

                            <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                        </a>

                    </td>
                    <?php $trcout++; ?>
                    <?php if ($trcout == 4) {
                        echo "</tr><tr>";
                        $trcout = 0;
                    } ?>

                <?php endforeach; ?>
            </tr>
        </table>
    </div><!-- End of id="engineer-authorised-brand" -->

    <hr>

    <div id="accounts-view" style="padding-top:50px"></div>





    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'user_id',
            //'company_type_id',

            [                      // the owner name of the model
                'label' => 'Company Type',
                'value' => $model->companytype->company_type,
            ],


            'wta_member',
            'wta_associate_member',
            'wta_membership_number:ntext',
            'wta_membership_expiry_date',
            'line_1',
            'line_2',
            'line_3',
            'town',
            'county',
            'postcode_s',
            'postcode_e',
            'latitude',
            'longitude',
            'weight',
            'email:email',
            'phone',
            'cell',
            'fax',
            'on_holiday',
            'blurb',
            'published',
            'ordering',
            'web_site',
            'unverified_email:email',
            'comments:ntext',
            'business_principle:ntext',
            'staffted_office',
            'total_employees',
            'total_engineers',
            'average_response_time',
            'average_turnover',
            'company_reg_number',
            'vat_number',
            'working_premises',
            'accept_contracts',
            'accept_spot_contracts',
            'accounts_contact_person',
            'accounts_contact_address:ntext',
            'accounts_telephone',
            'accounts_email:email',
            'created',
            'modified',
            'phoneclicks',
            'enquiryclicks',
            'impressions',
        ],
    ]) ?>

</div>


<?php
$this->registerJs("

     $('#show-hide-appliances-we-reapir').click(function(){
        $('#appliance-we-repair').toggle();

        var classnm=$('#appliances-onoffbtn').attr('class');
        if (classnm=='fa fa-toggle-on fa-4x')
            $('#appliances-onoffbtn').removeClass('fa fa-toggle-on fa-4x').addClass('fa fa-toggle-off fa-4x');
        else
            $('#appliances-onoffbtn').removeClass('fa fa-toggle-off fa-4x').addClass('fa fa-toggle-on fa-4x');
    });


     $('#show-hide-brands-we-reapir').click(function(){
        $('#brands-we-repair').toggle();

        var classnm=$('#brands-onoffbtn').attr('class');
        if (classnm=='fa fa-toggle-on fa-4x')
            $('#brands-onoffbtn').removeClass('fa fa-toggle-on fa-4x').addClass('fa fa-toggle-off fa-4x');
        else
            $('#brands-onoffbtn').removeClass('fa fa-toggle-off fa-4x').addClass('fa fa-toggle-on fa-4x');
    });


     $('#show-hide-postcodes-we-cover').click(function(){
        $('#postcodes-we-cover').toggle();
        $('#multiselectpostcode-div').toggle();


        var classnm=$('#postcodes-we-cover-onoffbtn').attr('class');
        if (classnm=='fa fa-toggle-on fa-4x')
            $('#postcodes-we-cover-onoffbtn').removeClass('fa fa-toggle-on fa-4x').addClass('fa fa-toggle-off fa-4x');
        else
            $('#postcodes-we-cover-onoffbtn').removeClass('fa fa-toggle-off fa-4x').addClass('fa fa-toggle-on fa-4x');
    });


     $('#show-hide-user').click(function(){
        $('#user-div').toggle();

        var classnm=$('#user-onoffbtn').attr('class');
        if (classnm=='fa fa-toggle-on fa-4x')
            $('#user-onoffbtn').removeClass('fa fa-toggle-on fa-4x').addClass('fa fa-toggle-off fa-4x');
        else
            $('#user-onoffbtn').removeClass('fa fa-toggle-off fa-4x').addClass('fa fa-toggle-on fa-4x');
    });


     $('#show-hide-authorisedbrands').click(function(){
        $('#engineer-authorised-brands').toggle();

        var classnm=$('#authorisedbrands-onoffbtn').attr('class');
        if (classnm=='fa fa-toggle-on fa-4x')
            $('#authorisedbrands-onoffbtn').removeClass('fa fa-toggle-on fa-4x').addClass('fa fa-toggle-off fa-4x');
        else
            $('#authorisedbrands-onoffbtn').removeClass('fa fa-toggle-off fa-4x').addClass('fa fa-toggle-on fa-4x');
    });

");


?>


<div style="float: right; ">
    <?= Html::a('<i class="fa fa-trash" aria-hidden="true"></i> Delete', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'title' => 'Delete this Engineer',

        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) ?>
</div>

<div class="rt-social-buttons">
    <span class="boldfont largepaddingright">Follow Me</span>

    <a href="http://www.twitter.com/robyn_watt11">
        <span class="fa fa-twitter fa-2x">&nbsp;&nbsp;</span>
    </a>

    <a href="http://www.twitter.com/robyn_watt11">
        <span class="fa fa-instagram fa-2x">&nbsp;&nbsp;</span>
    </a>

    <a href="http://www.twitter.com/robyn_watt11">
        <span class="fa fa-pinterest fa-2x">&nbsp;&nbsp;</span>
    </a>

</div>
<p> </p>



