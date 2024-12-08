<?php

use yii\helpers\Html;
use app\models\Users;
use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\BootstrapPluginAsset;

/* @var $this \yii\web\View */
/* @var $content string */

$user = Yii::$app->user->identity;

// Register Bootstrap assets
BootstrapAsset::register($this);
BootstrapPluginAsset::register($this);

?>

<header class="main-header">
    <!-- Logo -->
    <?= Html::a('<span class="logo-mini">AP</span><span class="logo-lg">Petunia</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: Dropdown -->
                <?php if (Yii::$app->user->isGuest): ?>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user-circle"></i> <span class="hidden-xs">Login</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-body">
                                <div class="pull-right">
                                    <?= Html::a('Login', ['/site/login'], ['data-method' => 'post', 'class' => 'btn btn-primary btn-flat']) ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                <?php else: 
                    $user = Users::find()->where(['user_id' => Yii::$app->user->id])->one(); ?>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user-circle"></i> <span class="hidden-xs">Hello, <?= Html::encode($user->username) ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header bg-primary text-white">
                                <p>
                                    Welcome, <?= Html::encode($user->username) ?>
                                    <small>Member since <?= Yii::$app->formatter->asDate($user->created_at, 'long') ?></small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <?= Html::a('Update Password', ['/users/change-password'], ['class' => 'btn btn-warning btn-flat']) ?>
                                </div>
                                <div class="pull-right">
                                    <?= Html::a('Sign Out', ['/site/logout'], ['data-method' => 'post', 'class' => 'btn btn-danger btn-flat']) ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>

<?php
// Custom CSS to give the header a modern feel
$this->registerCss("
    /* Main Header Styles */
    .main-header {
        background-color: linear-gradient(180deg, #6a11cb, #2575fc); /* Deep Blue Background */
        color: #ffffff;
    }

    .main-header .logo {
        font-size: 22px;
        font-weight: bold;
        color: #ffffff;
        background-color: #003366;
        padding: 10px 15px;
    }

    .navbar {
        background-color: #ffffff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .navbar-custom-menu .dropdown-menu {
        border-radius: 8px;
        min-width: 250px;
        background-color: #f4f4f4;
    }

    .navbar-nav > li > a {
        color: #003366;
        padding: 10px 15px;
    }

    .navbar-nav > li > a:hover {
        background-color: #e0e0e0;
    }

    .dropdown-menu > .user-header {
        background-color: #003366;
        color: white;
        padding: 20px;
        border-radius: 8px 8px 0 0;
    }

    .dropdown-menu > .user-footer {
        padding: 15px;
        border-top: 1px solid #ddd;
    }

    .dropdown-menu .user-footer .btn {
        width: 100%;
    }

    .dropdown-menu .user-footer .btn-flat {
        border-radius: 5px;
    }

    .dropdown-toggle .fa {
        font-size: 18px;
        margin-right: 10px;
    }

    /* Hover effects for the navbar items */
    .navbar-nav > li > a:hover {
        background-color: #e0e0e0;
        color: #003366;
    }

    /* For a smooth effect when switching between Login and User details */
    .navbar-nav > li > .dropdown-menu {
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
");
?>
