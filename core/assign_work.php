<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/core/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    switch ($_GET["action"]) {
        case 'add':
            $stmt = "INSERT INTO assignments VALUES(NULL, '" . $_POST["title"] . "','" . $_POST["description"] . "','" . $_POST['score'] . "','" . $_POST['due_date'] . "','" . $_POST['subject'] . "', 0)";
            if ($lastID = mysqli_query($dbl, $stmt)) {
                // First, you need to get the file data from the form submission.
                $files = $_FILES['attachment'];

                // Create an array to store the paths of the uploaded files.
                $file_paths = array();

                $lastID = mysqli_insert_id($dbl);

                // Loop through each file in the array.
                foreach ($files['name'] as $key => $value) {

                    // Get the temp file path.
                    $tmpFilePath = $files['tmp_name'][$key];
                    // Make sure we have a file path.
                    if ($tmpFilePath != "") {

                        // Setup our new file path. 
                        // You can change this to any filename or directory you want. 
                        $newFilePath = $_SERVER['DOCUMENT_ROOT'] . "uploads/" . $files['name'][$key];

                        // Upload the file into the temp dir.
                        if (move_uploaded_file($tmpFilePath, $newFilePath)) {

                            // Save the path of the uploaded file in an array. 
                            array_push($file_paths, array("path" => $newFilePath, "name" => $files['name'][$key]));
                        } else {

                            $_SESSION['flash_message'] = "There was an error uploading the file, please try again!";
                        }
                    }
                }

                // Save file name to database
                foreach ($file_paths as $file_path) {
                    $query = "INSERT INTO attachments VALUES (NULL, '" . $lastID . "', '" . $file_path['name'] . "', '" . $file_path['path'] . "')";
                    mysqli_query($dbl, $query);
                }
                $_SESSION['flash_message'] = "เพิ่มงานไปยังฐานข้อมูลสำเร็จ";
            } else {
                $_SESSION['flash_message'] = "เกิดข้อผิดพลาดในการเพิ่มงาน" ;
            }
            return header("location: /assignments.php");
            break;

        default:
            # code...
            break;
    }
}
