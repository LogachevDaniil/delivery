<?php

use app\models\order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\OrderSeach $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ordered_at',
            'address',
            // 'count',
            // 'cost',
            //'time_delivery',
            //'user_id',
            //'courier_id',
            [
                'attribute' => 'status_id',
                'label' => 'Status',
                'value' => fn ($model) => $status[$model->status_id],
                'filter' => $status,
            ],
            [
                'label' => 'Действие',
                'format' => 'html',
                'value' => function ($model) {
                    return '<div>' . Html::a('принять', ['set-status', 'id' => $model->id, 'status' => 1], ['class' => 'btn btn-outline-success']) . '<div>'
                        . '<div>' . Html::a('принять', ['set-status', 'id' => $model->id, 'status' => 2], ['class' => 'btn btn-outline-danger']) . '<div>';
                },
            ],
            'status_id',
            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, order $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>