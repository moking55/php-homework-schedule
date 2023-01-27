<?php

session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/core/config.php");

$query = "UPDATE assignments SET is_submitted = ";
$query .= ($_GET["is_submitted"] == 'true')? "1" : "0";
$query .= " WHERE assignments.assignment_id = " . $_GET["info"];

$res = mysqli_query($dbl, $query);
header("location: /assignments.php?info=" . $_GET["info"]);