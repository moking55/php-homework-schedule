<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/core/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    switch ($_GET["action"]) {
        case 'add':
            $stmt = "INSERT INTO subject VALUES(NULL, '" . $_POST["subject_code"] . "','" . $_POST["subject_name"] . "','" . $_POST['description'] . "','" . $_POST['instructor_name'] . "')";
            if (mysqli_query($dbl, $stmt)) {
                $_SESSION['flash_message'] = "Successfully added instructor to your database";
            } else {
                $_SESSION['flash_message'] = "An error occurred while creating the instructor";
            }
            return header("location: /assignments.php");
            break;

        default:
            # code...
            break;
    }
}
