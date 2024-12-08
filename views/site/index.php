<?php
use yii\helpers\Html;
use yii\bootstrap4\Card;
use yii\web\JsExpression;

$this->title = 'Futuristic Dashboard';
$this->registerCss("
    /* Global Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: #111;
        color: #fff;
        font-family: 'Arial', sans-serif;
    }

    /* Container */
    .container-fluid {
        margin-top: 30px;
        padding: 0 20px;
    }

    /* Header */
    h3 {
        font-size: 36px;
        font-weight: 600;
        color: #00eaff;
        text-shadow: 0 0 10px rgba(0, 234, 255, 0.8);
        margin-bottom: 15px;
    }

    p {
        font-size: 18px;
        color: #aaa;
    }

    /* Glassmorphism Widget Styles */
    .widget, .card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    .widget:hover, .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 255, 255, 0.4);
    }

    /* Stats Cards */
    .stats-card {
        position: relative;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.4);
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 255, 255, 0.6);
    }

    .stats-card-header {
        background-color: rgba(0, 234, 255, 0.5);
        padding: 10px;
        text-align: center;
        color: #fff;
        font-size: 22px;
        font-weight: bold;
    }

    .stats-card-body {
        padding: 20px;
        text-align: center;
        color: #fff;
    }

    .stats-card-footer {
        position: absolute;
        bottom: 10px;
        width: 100%;
        font-size: 14px;
        color: #aaa;
        text-align: center;
    }

    /* Graphs */
    .chart-container {
        margin-top: 30px;
        background-color: rgba(255, 255, 255, 0.1);
        padding: 20px;
        border-radius: 15px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .col-lg-6 {
            margin-bottom: 20px;
        }
    }
");

$this->registerJs("
    // Initialize charts with Chart.js

    var ctx1 = document.getElementById('chart1').getContext('2d');
    var ctx2 = document.getElementById('chart2').getContext('2d');

    // Sales Chart (Line Chart)
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Monthly Sales',
                data: [120, 200, 150, 300, 250, 400],
                borderColor: '#00eaff',
                backgroundColor: 'rgba(0, 234, 255, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    ticks: {
                        color: '#fff'
                    }
                },
                y: {
                    ticks: {
                        color: '#fff'
                    }
                }
            }
        }
    });

    // Performance Chart (Bar Chart)
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Q1', 'Q2', 'Q3', 'Q4'],
            datasets: [{
                label: 'Performance',
                data: [60, 85, 90, 75],
                backgroundColor: '#FF5733',
                borderColor: '#FF5733',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    ticks: {
                        color: '#fff'
                    }
                },
                y: {
                    ticks: {
                        color: '#fff'
                    }
                }
            }
        }
    });
");

?>

<div class="container-fluid">
    <!-- Welcome Section -->
  

    <!-- Stats Cards Section -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="stats-card">
                <div class="stats-card-header">Bookings</div>
                <div class="stats-card-body">
                    <h3>1200</h3>
                    <p>+5% (30 Days)</p>
                </div>
                <div class="stats-card-footer">Updated 1 hour ago</div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stats-card">
                <div class="stats-card-header">Meetings</div>
                <div class="stats-card-body">
                    <h3>320</h3>
                    <p>+10% (30 Days)</p>
                </div>
                <div class="stats-card-footer">Updated 1 hour ago</div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stats-card">
                <div class="stats-card-header">Clients</div>
                <div class="stats-card-body">
                    <h3>430</h3>
                    <p>+3% (30 Days)</p>
                </div>
                <div class="stats-card-footer">Updated 1 hour ago</div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stats-card">
                <div class="stats-card-header">Revenue</div>
                <div class="stats-card-body">
                    <h3>$12,500</h3>
                    <p>+7% (30 Days)</p>
                </div>
                <div class="stats-card-footer">Updated 1 hour ago</div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row">
        <div class="col-lg-6">
            <div class="chart-container">
                <canvas id="chart1" width="400" height="200"></canvas>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="chart-container">
                <canvas id="chart2" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

</div>
