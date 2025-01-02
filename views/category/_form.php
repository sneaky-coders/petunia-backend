<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form container mt-5 p-4 bg-white shadow rounded">
    <h2 class="mb-4 text-center text-dark">Manage Category</h2>

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'needs-validation', 'novalidate' => true],
    ]); ?>

    <div class="mb-3">
        <?= $form->field($model, 'name', [
            'inputOptions' => [
                'class' => 'form-control border-secondary shadow-sm rounded-pill',
                'placeholder' => 'Enter category name',
            ],
        ])->label('Category Name', ['class' => 'form-label text-muted fw-bold']) ?>
    </div>

    <div class="text-center">
        <?= Html::submitButton('<i class="bi bi-save2"></i> Save', [
            'class' => 'btn btn-primary px-4 py-2 rounded-pill shadow-sm',
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<style>
    /* General container styles */
    .category-form {
        max-width: 500px;
        margin: auto;
        border: 1px solid #f1f1f1;
    }

    /* Form label styles */
    .form-label {
        font-size: 1rem;
        color: #6c757d;
    }

    /* Input styles */
    .form-control {
        transition: box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .form-control:focus {
        box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
        border-color: #0d6efd;
    }

    .form-control::placeholder {
        color: #adb5bd;
        font-style: italic;
    }

    /* Button hover effect */
    .btn-primary:hover {
        background-color: #0056b3 !important;
        border-color: #004085 !important;
    }

    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
</style>
