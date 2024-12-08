<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$this->registerJsFile("https://cdn.jsdelivr.net/npm/chart.js", ['position' => yii\web\View::POS_END]);

if (Yii::$app->controller->action->id === 'login') { 
    // Code for the login page
    echo $this->render('main-login', ['content' => $content]);
} else {
    // Code for other pages
    
    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        
        <?php $this->head() ?>
        <style>
            /* Customize the color scheme here */
            body {
                background-color: #f8f9fa; /* Set the background color */
                font-family: 'Dosis', sans-serif;
            }

            /* Example: Change the main header background color */
            .skin-blue .main-header .navbar {
                background-color: #007bff; /* Change to your preferred color */
            }

            /* Example: Change the logo background color */
            .skin-blue .main-header .logo {
                background-color: #0056b3; /* Change to your preferred color */
                color: #fff; /* Change the text color */
                border-bottom: 0 solid transparent;
            }

            /* Example: Change the content wrapper background color */
            .content-wrapper {
                min-height: calc(100vh - 101px);
                background-color: #ffffff; /* Change to your preferred color */
                z-index: 800;
            }

            /* Example: Change the sidebar background color */
            .skin-blue .main-sidebar {
                background-color: #343a40; /* Change to your preferred color */
            }

            /* Example: Change the sidebar link color */
            .skin-blue .main-sidebar a {
                color: #c2c7d0; /* Change to your preferred color */
            }

            /* Add or modify other styles as needed */

            
        </style>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">
        <!-- Include header, left sidebar, and content sections -->
        <?= $this->render('header.php', ['directoryAsset' => $directoryAsset]) ?>
        <?= $this->render('left.php', ['directoryAsset' => $directoryAsset]) ?>
        <?= $this->render('content.php', ['content' => $content, 'directoryAsset' => $directoryAsset]) ?>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
