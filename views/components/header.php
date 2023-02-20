<?php
session_start();
include "core/config.php";
if (!empty($_GET['logout'])) {
    session_destroy();
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ?: WEBSITE_NAME ?></title>
    <!-- chartist CSS -->
    <link href="//<?= $_SERVER['SERVER_NAME'] ?>/assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="//<?= $_SERVER['SERVER_NAME'] ?>/assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="//<?= $_SERVER['SERVER_NAME'] ?>/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="//<?= $_SERVER['SERVER_NAME'] ?>/assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="//<?= $_SERVER['SERVER_NAME'] ?>/assets/css/animate.min.css" rel="stylesheet">
    <link href="//<?= $_SERVER['SERVER_NAME'] ?>/assets/css/style.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@200;300;400;500&display=swap');
        body {
            font-family: 'Noto Sans Thai', sans-serif;
        }
    </style>
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>