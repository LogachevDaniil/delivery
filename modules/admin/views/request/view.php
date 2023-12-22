<?php

use app\models\Category;
use app\models\RequestStatus;
use app\models\User;
use yii\bootstrap5\Html as Bootstrap5Html;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Request $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'title',
                'filter' => false,
                'value' => fn ($model) => Html::encode($model->title)
            ],
            [
                'attribute' => 'description',
                'filter' => false,
                'value' => fn ($model) => Html::encode($model->title)
            ],
            [
                'attribute' => 'category_id',
                'filter' => Category::getAllCategory(),
                'value' => fn ($model) => Html::encode(Category::getCategoryTitle($model->category_id))
            ],
            [
                'attribute' => 'user_id',
                'filter' => false,
                'value' => fn ($model) => Html::encode(User::findById($model->user_id))
            ],
            [
                'attribute' => 'created_at',
                'filter' => false,
                'value' => fn ($model) => date('d.m.Y H:i:s', strtotime($model->created_at)),
            ],
            [
                'attribute' => 'status_id',
                'filter' => false,
                'value' => fn ($model) => RequestStatus::getStatusTitle($model->status_id),
            ],
            [
                'attribute' => 'image',
                'filter' => false,
                "format" => 'html',
                'value' => fn ($model) => Bootstrap5Html::img('/img/' . $model->image, ['class' => 'w-50']),
            ],
            [
                'attribute' => 'image_admin',
                'filter' => false,
                "format" => 'html',
                'visible' => (bool)$model->image_admin,
                'value' => fn ($model) => Bootstrap5Html::img('/img/' . $model->image_admin, ['class' => 'w-50']),
            ],
            [
                'attribute' => 'reason',
                'filter' => false,
                // "format" => 'html',
                'visible' => (bool)$model->reason,
                'value' => fn ($model) => $model->reason,
            ],

        ],
    ]) ?>

</div>