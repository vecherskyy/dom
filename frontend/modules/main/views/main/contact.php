<?
use yii\widgets\ActiveForm;
use yii\bootstrap\Html;
use yii\captcha\Captcha;
use yii\helpers\Url;
?>
<div class="row contact">
    <div class="col-lg-6 col-sm-6 ">
        <? $form = ActiveForm::begin(['class' => 'form-control'])?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'subject') ?>
        <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(),[
            'template' => '<dic class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            'captchaAction' => Url::to(['main/captcha'])
        ]) ?>
        <?= Html::submitButton('Send Message', ['class' => 'btn btn-success', 'name' => 'Submit']) ?>
        <? $form = ActiveForm::end(); ?>

    </div>