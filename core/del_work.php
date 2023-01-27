<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/core/config.php");

$query = "DELETE FROM assignments WHERE assignments.assignment_id = " . $_GET["id"];

$res = mysqli_query($dbl, $query);
print(mysqli_error($dbl));
$_SESSION['flash_message'] = "ลบงานออกแล้ว!";
header("location: /assignments.php");
