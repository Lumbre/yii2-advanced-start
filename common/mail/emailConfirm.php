<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['site/email-confirm', 'token' => $user->email_confirm_token]);
?>

<?= Yii::t('app', 'HELLO {username}', ['username' => $user->username]); ?>

<?= Yii::t('app', 'FOLLOW_TO_CONFIRM_EMAIL') ?>

<?= $confirmLink ?>

<?= Yii::t('app', 'IGNORE_IF_DO_NOT_REGISTER') ?>