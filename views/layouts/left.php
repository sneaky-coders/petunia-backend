<?php
use yii\helpers\Html;
use dmstr\widgets\Menu;
use yii\web\View;

$this->registerCss("
    /* Base Layout */
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f4f6f9;
        color: #333;
    }

    /* Sidebar Styles */
    .main-sidebar {
        background: linear-gradient(180deg, #6a11cb, #2575fc); /* Gradient background */
        color: #FFFFFF !important; /* White text */
        font-size: 14px;
        width: 250px;
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .main-sidebar a {
        color: #FFFFFF !important;
    }

    .main-sidebar a:hover {
        background-color: #1f58bb !important; /* Darker blue for hover */
        text-decoration: none;
        border-radius: 6px;
    }

    .main-sidebar .sidebar-menu > li.active > a {
        background-color: #1f58bb !important; /* Darker blue for active */
        border-radius: 6px;
    }

    /* Sidebar Menu */
    .sidebar-menu {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .sidebar-menu li {
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    }

    .sidebar-menu > li > a {
        display: block;
        padding: 18px;
        font-size: 16px;
        font-weight: 500;
        color: #ecf0f1 !important;
        transition: background-color 0.3s ease, padding-left 0.3s ease;
    }

    .sidebar-menu > li > a:hover {
        background-color: #1f58bb !important;
        padding-left: 30px; /* Add padding for smooth transition */
        border-radius: 6px;
    }

    .sidebar-menu > li > a .fa {
        margin-right: 10px;
    }

    /* User Profile */
    .user-panel {
        padding: 20px;
        text-align: center;
        background: #4e73df;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .user-panel .info {
        font-size: 16px;
        color: #ffffff;
        font-weight: bold;
    }

    .user-panel .info i {
        color: #00d2d3;
    }

    /* Treeview (submenu) */
    .treeview-menu {
        background-color: #1f58bb !important;
        list-style: none;
        padding-left: 20px;
    }

    .treeview-menu > li > a {
        font-size: 14px;
        padding: 12px;
        color: #ecf0f1 !important;
        transition: background-color 0.3s ease;
    }

    .treeview-menu > li > a:hover {
        background-color: #0d467d !important;
        border-radius: 6px;
    }

    /* Active Submenu */
    .treeview.active > a {
        background-color: #0d467d !important;
        border-radius: 6px;
    }

    /* Animated Active Link */
    .sidebar-menu > li > a {
        transition: all 0.3s ease;
    }
");

$this->registerJs("/* For handling active menu state in the sidebar */");
?>

<aside class="main-sidebar">
    <section class="sidebar">
        <!-- User Panel -->
        <?php 
        if (!Yii::$app->user->isGuest) {
            echo Menu::widget([
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    [
                        'label' => 'Dashboard',
                        'icon' => 'fa fa-tachometer',
                        'url' => ['/site/index'],
                    ],
                    [
                        'label' => 'Users',
                        'icon' => 'fa fa-users',
                        'url' => ['/users/index'],
                    ],
                    [
                        'label' => 'Properties',
                        'icon' => 'fa fa-building',
                        'url' => ['/properties/index'],
                    ],
                    [
                        'label' => 'Categories',
                        'icon' => 'fa fa-list',
                        'url' => ['/categories/index'],
                    ],
                    [
                        'label' => 'Property Enquiry',
                        'icon' => 'fa fa-question-circle',
                        'url' => ['/property-enquiry/index'],
                    ],
                    [
                        'label' => 'Contact Us',
                        'icon' => 'fa fa-envelope',
                        'url' => ['/contact/index'],
                    ],
                    [
                        'label' => 'Settings',
                        'icon' => 'fa fa-cogs',
                        'url' => '#',
                        'items' => [
                            ['label' => 'General', 'icon' => 'fa fa-circle-o', 'url' => ['/settings/general']],
                            ['label' => 'Permissions', 'icon' => 'fa fa-circle-o', 'url' => ['/settings/permissions']],
                        ],
                    ],
                ],
            ]);
        }
        ?>
    </section>
</aside>
