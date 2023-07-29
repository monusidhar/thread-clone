<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<?= $form->field($model, 'rememberMe')->checkbox() ?>

<!-- <div class="my-1 mx-0" style="color:#999;">
    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
    <br>
    Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
</div> -->

<div class="form-group mb-2">
    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
</div>
<div class="text-center">
    <?= Html::a('Do not have an account Signup', ['/site/signup']) ?>
</div>

<?php ActiveForm::end(); ?>
</div>
