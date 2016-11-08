<?php
/**
 * Created by PhpStorm.
 * User: sudeeptalati
 * Date: 19/10/2016
 * Time: 16:42
 */

use yii\widgets\ActiveForm;

use common\models\Product;
use common\models\Handyfunctions;

use yii\helpers\Html;

?>

<?php $product_model=Product::findOne($product_id);?>




<div class="product-form">

    <?php $form = ActiveForm::begin([
        'action' =>['product/updateeditproductonly','product_id'=>$product_id, 'servicecall_id'=>$servicecall_id, 'enggdiary_id' => $enggdiary_id, ],
        'id' => 'edit_product',
        'method' => 'post',

    ]);
    ?>

    <div class="form-group text-center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?= $form->field($product_model, 'id')->hiddenInput()->label(false); ?>

    <hr>
    <div>
        <h2 class="text-center">
            <i class="ukwfa ukwfa-threeappliancelogo  fa-2x"></i>
        </h2>
        <table class="responsive-stacked-table">
            <tr>
                <td><?= $form->field($product_model, 'brand_id')->dropDownList(Handyfunctions::get_all_brands_for_drop_down()); ?></td>
                <td><?= $form->field($product_model, 'product_type_id')->dropDownList(Handyfunctions::get_all_product_types_for_drop_down()); ?></td>
                <td><?= $form->field($product_model, 'serial_number')->textInput(); ?></td>


            </tr>

            <tr>
                <td><?= $form->field($product_model, 'model_number')->textInput(); ?></td>
                <td><?= $form->field($product_model, 'enr_number')->textInput(); ?></td>
                <td><?= $form->field($product_model, 'fnr_number')->textInput(); ?></td>
            </tr>




        </table>
    </div>
    <?= $form->field($product_model, 'production_code')->textInput(); ?> 
    <?= $form->field($product_model, 'notes')->textarea(['rows' => 6]) ?>

    <div class="form-group text-center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
