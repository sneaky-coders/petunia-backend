<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchUsers */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php 
    if (Yii::$app->user->identity->level == 1) {
        echo Html::a('Create Users', ['create'], ['class' => 'btn btn-success']);
    }
    ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'user_id',
            'username',
            'password',
            'email:email',
            'contact',
            [
                'attribute' => 'level',
                'value' => function ($model) {
                    return ($model->level == 1) ? 'Admin' : (($model->level == 2) ? 'Faculty' : 'Student');
                }
            ],
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update}{view}{delete}'],
        ],
    ]); ?>
</div>
