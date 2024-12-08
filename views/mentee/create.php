<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mentee */

$this->title = 'Create Mentee';
$this->params['breadcrumbs'][] = ['label' => 'Mentees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mentee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
