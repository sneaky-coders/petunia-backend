<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Mentor;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'usn')->textInput(['maxlength' => true]) ?>


   


    <?= $form->field($model, 'level')->dropDownList(['prompt'=>'Select User Type',1=>'Admin',2=>'Faculty',3=>'Student',4=>'Project Committee',5=>'Academic Committe',6=>'Certification Committee']); ?>

   

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
