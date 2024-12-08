<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';
?>

<div class="login-wrapper">
    <div class="login-box">
        <div class="login-logo">
            <h1>Petunia</h1>
        </div>
        <div class="login-box-body">
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

            <div class="input-group">
                <?= $form->field($model, 'username')->textInput([
                    'placeholder' => 'Enter your username',
                    'class' => 'form-control modern-input'
                ])->label(false) ?>
            </div>

            <div class="input-group">
                <?= $form->field($model, 'password')->passwordInput([
                    'placeholder' => 'Enter your password',
                    'class' => 'form-control modern-input'
                ])->label(false) ?>
            </div>

            <div class="form-actions">
                <div class="remember-me">
                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'class' => 'custom-checkbox',
                        'template' => '<label>{input} Remember Me</label>'
                    ]) ?>
                </div>
                <div class="submit-btn">
                    <?= Html::submitButton('Sign In', [
                        'class' => 'btn btn-primary modern-btn',
                        'name' => 'login-button'
                    ]) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!-- Add CSS for modern design -->
<style>
/* Body Styling */
body {
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    font-family: 'Poppins', sans-serif;
}

/* Login Wrapper */
.login-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    padding: 20px;
}

/* Login Box */
.login-box {
    background: #fff;
    border-radius: 12px;
    padding: 40px 30px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.8s ease;
}

.login-logo {
    text-align: center;
    margin-bottom: 20px;
}

.login-logo h1 {
    font-size: 24px;
    font-weight: bold;
    color: #333;
}

/* Input Fields */
.input-group {
    margin-bottom: 20px;
}

.modern-input {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 8px;
    transition: all 0.3s;
}

.modern-input:focus {
    border-color: #6a11cb;
    box-shadow: 0 0 10px rgba(106, 17, 203, 0.2);
    outline: none;
}

/* Buttons */
.modern-btn {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    width: 100%;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s;
}

.modern-btn:hover {
    background: linear-gradient(135deg, #2575fc, #6a11cb);
}

/* Form Actions */
.form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
}

.remember-me {
    font-size: 14px;
    color: #333;
}

.custom-checkbox {
    display: inline-block;
    margin-right: 5px;
    accent-color: #6a11cb;
}

/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 480px) {
    .login-box {
        padding: 20px;
    }

    .modern-input {
        font-size: 14px;
    }

    .modern-btn {
        font-size: 14px;
    }
}
</style>
