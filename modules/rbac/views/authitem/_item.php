<?php

use aabc\helpers\Html;

/* @var $this aabc\web\View */
/* @var $model backend\modules\rbac\models\Authitem */
/* @var $form aabc\widgets\ActiveForm */
?>

<div class="authitem-item">
   

name: <?= $model->name?> type: <?= $model->type?> description: <?= $model->description?> rule_name: <?= $model->rule_name?> data: <?= $model->data?> created_at: <?= $model->created_at?> updated_at: <?= $model->updated_at?>    


</div>

