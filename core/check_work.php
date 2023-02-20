<?php

session_start();
require_once("core/config.php");

$isFinished = $_GET['is_submitted'];
$info = $_GET["info"];
if ($isFinished == "true") {
    $query = "INSERT INTO submitted (user_id, assignment_id) VALUES (" . $_SESSION['uid'] . ",$info)";
} else {
    $query = "DELETE FROM submitted WHERE user_id = ".$_SESSION['uid']." AND assignment_id = '$info'";
}

$res = mysqli_query($dbl, $query);
//var_dump(mysqli_error($dbl));
header("location: /assignments.php?info=" . $_GET["info"]);
