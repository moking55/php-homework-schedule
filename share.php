<?php
include $_SERVER['DOCUMENT_ROOT'] . "/core/config.php";

$query = "SELECT
	attachments.file_name, 
	attachments.file_url, 
	assignments.*, 
	`subject`.subject_name, 
	`subject`.instructor_name, 
	`subject`.subject_code
FROM
	assignments
	LEFT JOIN
	attachments
	ON 
		assignments.assignment_id = attachments.assignment_id
	LEFT JOIN
	`subject`
	ON 
		assignments.`subject` = `subject`.subject_id
WHERE
	assignments.assignment_id = " . $_GET["info"];

$classInformation = mysqli_query($dbl, $query);
$classInformation = mysqli_fetch_array($classInformation);


$query = "SELECT * FROM attachments WHERE assignment_id = " . $_GET["info"];
$getFiles = mysqli_query($dbl, $query);

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
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical">
        <div class="page-wrapper" style="margin-left: 0 !important;">
            <div class="container pt-5" style="min-height: 100vh;max-width: 800px">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-6 col-xs-6 b-r"> <strong>ชื่อวิชา</strong>
                                <br>
                                <p class="text-muted"><?= $classInformation['subject_name'] ?></p>
                            </div>
                            <div class="col-md-3 col-6 col-xs-6 b-r"> <strong>ครูผู้สอน</strong>
                                <br>
                                <p class="text-muted"><?= $classInformation['instructor_name'] ?></p>
                            </div>
                            <div class="col-md-3 col-6 col-xs-6 b-r"> <strong>คะแนนเต็ม</strong>
                                <br>
                                <p class="text-muted"><?= $classInformation['score'] ?></p>
                            </div>
                            <div class="col-md-3 col-6 col-xs-6"> <strong>กำหนดส่ง</strong>
                                <br>
                                <p class="text-muted"><?= $classInformation['due_date'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <h3><?= $classInformation['title'] ?></h3>
                        <p class="text-muted"><?= $classInformation['description'] ?></p>

                        <hr>
                        <h4>ไฟล์แนบ</h4>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($getFiles as $file) : ?>
                                <li class="list-group-item"><a href="#" download="<?= $file['file_url'] ?>"><i class="mdi mdi-file"></i> <?= $file['file_name'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "./views/components/footer.php"); ?>