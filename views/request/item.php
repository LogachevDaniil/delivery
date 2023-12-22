<?php

use app\models\Category;
use yii\bootstrap5\Html;
?>
<div class="card m-3" style="width: 18rem;">
  <?= Html::img('/img/' . $model->image, ['class' => '']) ?>
  <div class="card-body">
    <h5 class="card-title">
      <?= Html::encode($model->title) ?>
    </h5>
    <p class="card-text">описание :<?= Html::encode($model->description) ?></p>
    <p class="card-text">категория :<?= Html::encode(Category::getCategoryTitle($model->category_id)) ?></p>
    <?=Html::a('просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-primary'])?>
  </div>
</div>