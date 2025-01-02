<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchCategory */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Include Bootstrap 5 CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

<div class="category-index container mt-5">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary"><?= Html::encode($this->title) ?></h1>
        <?= Html::a('<i class="bi bi-plus-circle"></i> Create Category', ['create'], [
            'class' => 'btn btn-success rounded-pill px-4 py-2 shadow',
        ]) ?>
    </div>

    <!-- Table Section -->
    <div class="card shadow">
        <div class="card-body p-4">
            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table table-bordered table-hover align-middle'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        [
                            'attribute' => 'id',
                            'headerOptions' => ['class' => 'text-primary text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                        ],
                        [
                            'attribute' => 'name',
                            'headerOptions' => ['class' => 'text-primary'],
                        ],
                        [
                            'attribute' => 'created_at',
                            'format' => ['date', 'php:Y-m-d'],
                            'headerOptions' => ['class' => 'text-primary'],
                        ],
                        [
                            'attribute' => 'updated_at',
                            'format' => ['date', 'php:Y-m-d'],
                            'headerOptions' => ['class' => 'text-primary'],
                        ],

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Actions',
                            'headerOptions' => ['class' => 'text-primary text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                            'template' => '{view} {update} {delete}',
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a('<i class="bi bi-eye"></i>', $url, [
                                        'class' => 'btn btn-outline-primary btn-sm rounded-circle mx-1',
                                        'title' => 'View',
                                    ]);
                                },
                                'update' => function ($url, $model) {
                                    return Html::a('<i class="bi bi-pencil"></i>', $url, [
                                        'class' => 'btn btn-outline-warning btn-sm rounded-circle mx-1',
                                        'title' => 'Update',
                                    ]);
                                },
                                'delete' => function ($url, $model) {
                                    return Html::a('<i class="bi bi-trash"></i>', $url, [
                                        'class' => 'btn btn-outline-danger btn-sm rounded-circle mx-1',
                                        'title' => 'Delete',
                                        'data-confirm' => 'Are you sure you want to delete this item?',
                                        'data-method' => 'post',
                                    ]);
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap 5 JS -->

