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
/** @var app\modules\admin\models\RequestSeach $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('категории', './admin/category', ['class' => 'btn btn-success']) ?>
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
                'value' => fn ($model) => Bootstrap5Html::img('/img/' . $model->image, ['class' => 'w-25']),
            ],
            [
                'label' => 'действия',
                'format' => 'html',
                'value' => fn ($model) => '<div class="d-flex">' . Html::a('просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-primary  mx-1'])
                    . ($model->status_id == 1 ? Html::a('принять', ['apply', 'id' => $model->id], ['class' => 'btn btn-success  mx-1'])
                        : '')
                    . ($model->status_id == 1 ? Html::a('отклонить', ['cancel', 'id' => $model->id], ['class' => 'btn btn-danger  mx-1'])
                        : '')
                        .'</div>'
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>