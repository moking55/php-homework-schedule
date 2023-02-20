<?php
session_start();
require_once("core/config.php");

function sendWebhook($dueDate, $score, $title, $shareID)
{
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/share.php?info=" . $shareID;
    $timestamp = date("c", strtotime("now"));
    $json_data = json_encode([
        "content" => "ประกาศงานใหม่! คลิ๊กที่ลิ้งเพื่อดูข้อมูลเพิ่มเติม",
        "embeds" => [
            [
                "title" => "$title",
                "type" => "rich",
                "url" => "$url",
                "timestamp" => "$timestamp",
                "color" => hexdec("3366ff"),
                "fields" => [
                    [
                        "name" => "คะแนนเต็ม",
                        "value" => "$score",
                        "inline" => true
                    ],
                    [
                        "name" => "กำหนดส่ง",
                        "value" => "$dueDate",
                        "inline" => true
                    ]
                ]
            ]
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    $ch = curl_init(DISCORD_WEBHOOK_URL);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($ch);
    // If you need to debug, or find out why you can't send message uncomment line below, and execute script.
    // echo $response;
    // var_dump($response);
    curl_close($ch);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    switch ($_GET["action"]) {
        case "add":
            $stmt = "INSERT INTO assignments VALUES(NULL, '" . $_POST["title"] . "','" . $_POST["description"] . "','" . $_POST['score'] . "','" . $_POST['due_date'] . "','" . $_POST['subject'] . "')";
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
                        $newFilePath = "uploads/" . $files['name'][$key];

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
                    $query = "INSERT INTO attachments (assignment_id, file_name,file_url,  user_id) VALUES ('" . $lastID . "', '" . $file_path['name'] . "', '" . $file_path['path'] . "', '" . $_SESSION['uid'] . "')";
                    mysqli_query($dbl, $query);
                }
                sendWebhook($_POST['due_date'], $_POST['score'], $_POST['title'], $lastID);
                $_SESSION['flash_message'] = "เพิ่มงานไปยังฐานข้อมูลสำเร็จ";
            } else {
                $_SESSION['flash_message'] = "เกิดข้อผิดพลาดในการเพิ่มงาน";
            }
            header("location: /assignments.php");
            break;

        case "edit":
            $query = "UPDATE assignments SET ";
            $query .= "`title` = '" . $_POST['title'] . "',";
            $query .= "`score` = " . $_POST['score'] . ",";
            $query .= "`due_date` = '" . $_POST['due_date'] . "',";
            $query .= "`description` = '" . $_POST['description'] . "' ";
            $query .= "WHERE assignment_id = " . $_POST['assignment_id'] . "";
            mysqli_query($dbl, $query);
            $_SESSION['flash_message'] = "แก้ไขงานแล้ว";
            header("Location: /assignments.php");
            break;

        default:
            # code...
            break;
    }
}
