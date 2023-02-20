<?php
session_start();
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    switch ($_GET["action"]) {
        case 'add':
            $stmt = "INSERT INTO subject VALUES(NULL, '" . $_POST["subject_code"] . "','" . $_POST["subject_name"] . "','" . $_POST['description'] . "','" . $_POST['instructor_name'] . "')";
            if (mysqli_query($dbl, $stmt)) {
                $_SESSION['flash_message'] = "เพิ่มรายวิชาเข้าฐานข้อมูลแล้ว";
            } else {
                $_SESSION['flash_message'] = "An error occurred while creating the instructor";
            }
            return header("location: /subjects.php");
            break;
        case 'edit':
            $query = "UPDATE `subject` SET ";
            $query .= "`subject_code` = '" . $_POST['subject_code'] . "',";
            $query .= "`subject_name` = '" . $_POST['subject_name'] . "',";
            $query .= "`instructor_name` = '" . $_POST['instructor_name'] . "',";
            $query .= "`description` = '" . $_POST['description'] . "' ";
            $query .= "WHERE subject_id = " . $_POST['subject_id'];
            $_SESSION['flash_message'] = "แก้ไขรายวิชาแล้ว";
            mysqli_query($dbl, $query);
            header("Location: /subjects.php");
            break;
        default:
            echo "Error";
            break;
    }
}

if ($_GET["action"] == 'delete') {
    $query = "DELETE FROM `subject` WHERE `subject_id` = " . $_GET['subject_id'];
    $_SESSION['flash_message'] = "ลบรายวิชาแล้ว";
    mysqli_query($dbl, $query);
    var_dump(mysqli_error($dbl));
    header("Location: /subjects.php");
}
