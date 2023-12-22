<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var ActiveForm $form */
?>
<div class="site-register">

    <?php $form = ActiveForm::begin([
    'id' => 'registration-form',
]); ?>

        <?= $form->field($model, 'full_name') ?>
        <?= $form->field($model, 'login', ['enableAjaxValidation' => true]) ?>
        <?= $form->field($model, 'password') ?>
        <?= $form->field($model, 'password_repeat') ?>
        <?= $form->field($model, 'email', ['enableAjaxValidation' => true]) ?>
        <?= $form->field($model, 'phone') ?>
        <?= $form->field($model, 'agree')->checkbox() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-register -->
