<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \modules\users\models\frontend\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use modules\users\models\frontend\User;
use modules\users\widgets\passfield\Passfield;
use modules\users\Module;

$this->title = Module::t('module', 'Sign Up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-frontend-default-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Module::t('module', 'Please fill in the following fields to sign up'); ?>:</p>

    <div class="row">
        <div class="col-md-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['class' => 'form-control']) ?>

            <?= $form->field($model, 'email')->textInput(['class' => 'form-control']) ?>

            <?= Passfield::widget([
                'form' => $form,
                'model' => $model,
                'attribute' => 'password',
                'options' => [
                    'class' => 'form-control',
                ],
                'config' => [
                    'locale' => mb_substr(Yii::$app->language, 0, strrpos(Yii::$app->language, '-')),
                    'showToggle' => true,
                    'showGenerate' => true,
                    'showWarn' => true,
                    'showTip' => true,
                    'length' => [
                        'min' => User::LENGTH_STRING_PASSWORD_MIN,
                        'max' => User::LENGTH_STRING_PASSWORD_MAX,
                    ]
                ],
            ]); ?>

            <div class="form-group">
                <?= Html::submitButton('<span class="glyphicon glyphicon-ok"></span> ' . Module::t('module', 'Send'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
