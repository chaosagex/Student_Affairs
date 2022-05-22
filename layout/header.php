<?php
if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
$current_page = 'home';
if (str_contains($_SERVER['REQUEST_URI'], '/Add.php')) $current_page = 'Add';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

    <title>Student Affairs</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= BASE_URL ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/fontawesome.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/templatemo-stand-blog.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/owl.css">

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <!-- Header -->
    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <h2>Students Affairs<em>.</em></h2>
                    
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item <?= ($current_page == 'home' ? "active" : "") ?>">
                        
                            <a class="nav-link" href="<?= BASE_URL . '/' ?>">Home </a>
                                <?= ($current_page == 'home' ? "<span class='sr-only'>(current)</span>" : "") ?>
                           
                        </li>
                        <li class="nav-item <?= ($current_page == 'Add' ? "active" : "") ?>">
                            <a class="nav-link" href="<?= BASE_URL . '/Add.php' ?>">Add</a>
                            <?= ($current_page == 'Add' ? "<span class='sr-only'>(current)</span>" : "") ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>