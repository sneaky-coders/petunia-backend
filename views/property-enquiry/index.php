<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchPropertyEnquiry */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Property Enquiries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-enquiry-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Property Enquiry', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'property_id',
            'name',
            'email:email',
            'phone',
            //'message:ntext',
            //'enquiry_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
