<?php

use app\models\Category;
use app\models\Request;
use app\models\User;
use yii\bootstrap5\Html as Bootstrap5Html;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\modules\account\models\RequestSeach $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'class' => LinkPager::class
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'filter' => false,
                'value' => fn ($model) => Html::encode($model->id)
            ],
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
                'attribute' => 'image',
                'filter' => false,
                "format" => 'html',
                'value' => fn ($model) => Bootstrap5Html::img('/img/' . $model->image, ['class' => 'w-50']),
            ],
            // 'user_id',
            //'created_at',
            //'status_id',
            //'image',
            //'image_admin',
            //'reason:ntext',
            [
                'label' => 'действия',
                'format' => 'html',
                'value' => fn ($model) => Html::a('просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-primary'])
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>