<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchProperties */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Properties';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="properties-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Properties', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'category_id',
            'title',
            'description:ntext',
            'price',
            //'area',
            //'pincode',
            //'state',
            //'region',
            //'taluka',
            //'district',
            //'city',
            //'address_line1',
            //'address_line2',
            //'created_at',
            //'updated_at',
            //'image1',
            //'image2',
            //'image3',
            //'image4',
            //'image5',
            //'bedroom',
            //'bathroom',
            //'year_built',
            //'furnishing',
            //'kitchen',
            //'floor',
            //'video_link',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
