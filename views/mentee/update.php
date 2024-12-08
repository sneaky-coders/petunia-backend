<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mentee */

$this->title = 'Update Mentee: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mentees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->mentee_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mentee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
