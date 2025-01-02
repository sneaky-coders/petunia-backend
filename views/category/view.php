<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<!-- Include Bootstrap 5 CDN -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

<div class="category-view container mt-5">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary"><?= Html::encode($this->title) ?></h1>
        <div>
            <?= Html::a('<i class="bi bi-pencil"></i> Update', ['update', 'id' => $model->id], [
                'class' => 'btn btn-warning rounded-pill px-4 py-2 me-2',
            ]) ?>
            <?= Html::a('<i class="bi bi-trash"></i> Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger rounded-pill px-4 py-2',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>

    <!-- Detail View Section -->
    <div class="card shadow-lg">
        <div class="card-body p-4">
            <?= DetailView::widget([
                'model' => $model,
                'options' => ['class' => 'table table-bordered table-striped align-middle mb-0'],
                'attributes' => [
                    [
                        'attribute' => 'id',
                        'label' => 'Category ID',
                        'contentOptions' => ['class' => 'fw-bold'],
                    ],
                    'name',
                    [
                        'attribute' => 'created_at',
                        'format' => ['date', 'php:Y-m-d H:i:s'],
                        'label' => 'Created At',
                    ],
                    [
                        'attribute' => 'updated_at',
                        'format' => ['date', 'php:Y-m-d H:i:s'],
                        'label' => 'Last Updated',
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>

<!-- Include Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
