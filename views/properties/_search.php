<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SearchProperties */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="properties-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'pincode') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'region') ?>

    <?php // echo $form->field($model, 'taluka') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'address_line1') ?>

    <?php // echo $form->field($model, 'address_line2') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'image1') ?>

    <?php // echo $form->field($model, 'image2') ?>

    <?php // echo $form->field($model, 'image3') ?>

    <?php // echo $form->field($model, 'image4') ?>

    <?php // echo $form->field($model, 'image5') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
