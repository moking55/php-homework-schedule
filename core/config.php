<?php

ini_set("display_errors", 1); // Display errors in development mode only, if you are using a production server change this to false or 0

/* ทั่วไป */
define("WEBSITE_NAME", "มีการบ้านบอกด้วย");

/* ส่วนเข้าสู่ระบบ */
define("ADMIN_USERNAME", "admin");
define("ADMIN_PASSWORD", "admin");

/* ฐานข้อมูล */
define('DB_HOST', "sql305.epizy.com");
define('DB_USERNAME', "epiz_33633754");
define('DB_PASSWORD', "D5xOqbqy4i");
define('DB_NAME', "epiz_33633754_homework");
// Create connection
$dbl = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Check connection
if (mysqli_connect_error($dbl)) {
    die("Connection failed: " . $conn->connect_error);
    exit();
}

/* Discord Webhook */
define('DISCORD_WEBHOOK_URL', "https://discord.com/api/webhooks/1075493859204804678/ykfvCyt0ZVUUXtLcm3KSZOBNoEKJJ6gsza8RVc-hZlI_Gz_6dc3m6PIWDYiaYGodfyAt");
