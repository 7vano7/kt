<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\modules\users\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'password_hash')->passwordInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'role')->dropDownList($model->getRoles(), ['prompt'=>Yii::t('users', 'Select role')]) ?>
    <?php if(!$model->isNewRecord)
    {
        echo $form->field($model, 'active')->dropDownList($model->getActivate(), ['prompt'=>Yii::t('users', 'Select active')]);
        echo $form->field($model, 'status')->dropDownList($model->getStatuses(), ['prompt'=>Yii::t('users', 'Select status')]);
    }
    ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('admin', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
