<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SearchUsers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'usn') ?>

    <?php // echo $form->field($model, 'batch') ?>

    <?php // echo $form->field($model, 'ismentor') ?>

    <?php // echo $form->field($model, 'hasMentor') ?>

    <?php // echo $form->field($model, 'xcgpa') ?>

    <?php // echo $form->field($model, 'xiicgpa') ?>

    <?php // echo $form->field($model, 'bachelorcgpa') ?>

    <?php // echo $form->field($model, 'sem1cgpa') ?>

    <?php // echo $form->field($model, 'sem2cgpa') ?>

    <?php // echo $form->field($model, 'sem3cgpa') ?>

    <?php // echo $form->field($model, 'sem4cgpa') ?>

    <?php // echo $form->field($model, 'mentor_id') ?>

    <?php // echo $form->field($model, 'profile') ?>

    <?php // echo $form->field($model, 'level') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
