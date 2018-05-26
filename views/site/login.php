<?php

/* @var $this aabc\web\View */
/* @var $form aabc\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use aabc\helpers\Html;
use aabc\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<style type="text/css">
html, body {
    background: #d4d7e0;
}

h3 {
    text-transform: uppercase;
    font-size: 14px;
    text-align: center;
}

p {
        color: #0fa0e2;
    font-style: italic;
    float: right;
    text-align: right;
    width: calc(100%);
}

    .site-login {
       width: 350px;
    position: fixed;
    top: calc((100%/2) - 200px);
    left: calc((100% - 350px)/2);
}
fieldset {
    border: 1px solid #2499ce;
        background: #FFF;
    padding: 10px;
}

button.btn.btn-success {
    border-radius: 0;
    height: 32px;
}

.ri {
    width: 100%;
}

.form-control {
    height: 36px;
}

.site-login .has-error .form-control {
    border-color: #ccc !important;
}

.site-login .has-error .form-control:focus{
    border-color: #66afe9 !important;
}
.site-login .form-control-feedback {
    color: #437e96 !important;
}

.img-login{
        position: absolute;
    top: 0;
    width: 60px;
}

.help-block {
    display: none;
}
.counterror.haserror{
    display: none;
}
</style>

<div class="site-login">
    <fieldset>                  
        <div class="row">
            <div class="col-md-12">
                <img class="img-login" src="/ad/image/login.jpg" />
                <h3>Đăng nhập hệ thống</h3>
                <p>Vui lòng điền tên đăng nhập và mật khẩu:</p>
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

<?php 
    $fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

?>

 <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => 'Tên đăng nhập']) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => 'Mật khẩu']) ?>


                  

                    <div class="clearfix"></div>

                    <div class="form-group text-right">
                        <?= Html::submitButton('Đăng nhập', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </fieldset>
</div>
