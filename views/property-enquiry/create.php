<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PropertyEnquiry */

$this->title = 'Create Property Enquiry';
$this->params['breadcrumbs'][] = ['label' => 'Property Enquiries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-enquiry-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
