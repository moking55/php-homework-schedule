<?php

/* ทั่วไป */
define("WEBSITE_NAME", "มีการบ้านบอกด้วย");

/* ส่วนเข้าสู่ระบบ */
define("ADMIN_USERNAME", "admin");
define("ADMIN_PASSWORD", "admin");

/* ฐานข้อมูล */
define('DB_HOST', "localhost");
define('DB_USERNAME', "root");
define('DB_PASSWORD', "");
define('DB_NAME', "homework_schedule");
// Create connection
$dbl = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Check connection
if (mysqli_connect_error($dbl)) {
    die("Connection failed: " . $conn->connect_error);
    exit();
} 