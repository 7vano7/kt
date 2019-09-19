<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \app\models\SignupForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

?>

<div class="site-login">

    <div class="title">
        <h1><?php echo Html::encode(Yii::t('site', 'Signup')) ?></h1>
    </div>
    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

    <?= $form->field($model, 'username', ['template' => ' <div class="input-group">{input}<span class="input-group-addon">
    <span class="glyphicon glyphicon-user"></span></span></div>{error}'])->textInput(['autofocus' => true, 'placeholder' => Yii::t('site', 'Username')]) ?>

    <?= $form->field($model, 'email', ['template' => ' <div class="input-group">{input}<span class="input-group-addon">
    <span class="glyphicon glyphicon-envelope"></span></span></div>{error}'])->textInput(['autofocus' => true, 'placeholder' => Yii::t('site', 'Email')]) ?>

    <?= $form->field($model, 'password_hash', ['template' => ' <div class="input-group">{input}<span class="input-group-addon">
    <span class="glyphicon glyphicon-lock"></span></span></div>{error}'])->passwordInput(['placeholder' => Yii::t('site', 'Password')]) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('site', 'Signup'), ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>