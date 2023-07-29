<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            

            <?= $form->field($model, 'first_name') ?>
            
            <?= $form->field($model, 'last_name') ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group mb-2">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <div class="text-center">
                <?= Html::a('Already have an account. Login', ['/site/login']) ?>
            </div>
        <?php ActiveForm::end(); ?>
</div>
