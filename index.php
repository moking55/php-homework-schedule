<?php
require_once("views/components/header.php");
if ($_SESSION['is_login'] != true || !isset($_SESSION['is_login'])) {
    return header("Location: /login.php");
}

// Get the current submission
$query = "SELECT
(
SELECT
    COUNT( * ) 
FROM
    assignments
    LEFT JOIN submitted ON assignments.assignment_id = submitted.assignment_id 
WHERE
    submitted.submit_id <> '' 
AND submitted.user_id = " . $_SESSION['uid'] . "
) AS `submitted`,
(SELECT COUNT(*) FROM assignments) as `total`";

$total = mysqli_fetch_array(mysqli_query($dbl, $query));


// Activity
$query = "SELECT
`subject`.subject_name, 
assignments.title
FROM
assignments
INNER JOIN
`subject`
ON 
    assignments.`subject` = `subject`.subject_id
ORDER BY
assignments.assignment_id ASC";
$activity = mysqli_query($dbl, $query);
?>

<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <?php include 'views/components/sidebar.php'; ?>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-md-12 col-12 align-self-center">
                    <h3 class="page-title mb-0 p-0">หน้าหลัก</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">หน้าแรก</a></li>
                                <li class="breadcrumb-item active" aria-current="page">สรุปผล</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div style="background: #F55050" class="card text-light shadow">
                        <div class="card-body">
                            <div class="row g-0">
                                <div class="col-3 px-2"><i style="font-size: 50px" class="m-0 mdi mdi-file-outline"></i></div>
                                <div class="col-auto text-left">
                                    <h3>ยังไม่ได้ส่ง</h3>
                                    <h1 class="m-0" id="unsubmit" data-unsubmit="<?= $total['total'] - $total['submitted'] ?>"><?= $total['total'] - $total['submitted'] ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="background: #14C38E" class="card text-light shadow">
                        <div class="card-body">
                            <div class="row g-0">
                                <div class="col-3 px-2"><i style="font-size: 50px" class="m-0 mdi mdi-checkbox-marked-outline"></i></div>
                                <div class="col-auto text-left">
                                    <h3>ส่งแล้ว</h3>
                                    <h1 class="m-0" id="submitted" data-submitted="<?= $total['submitted'] ?>"><?= $total['submitted'] ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="background: #73777B" class="card text-light shadow">
                        <div class="card-body">
                            <div class="row g-0">
                                <div class="col-3 px-2"><i style="font-size: 50px" class="m-0 mdi mdi-book"></i></div>
                                <div class="col-auto text-left">
                                    <h3>รวมทั้งหมด</h3>
                                    <h1 class="m-0"><?= $total['total'] ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Column -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="card-title">กิจกรรมล่าสุด</h3>
                                    <h6 class="card-subtitle">กิจกรรมล่าสุดของชั้นเรียนจะปรากฏที่นี่</h6>
                                </div>
                                <div class="my-auto">
                                    <a href="/assignments.php?add=work" class="btn btn-primary">
                                        เพิ่มงานใหม่
                                    </a>
                                </div>
                            </div>
                            <div class="profiletimeline border-start-0">
                                <?php while ($item = mysqli_fetch_array($activity)) : ?>
                                    <div class="sl-item">
                                        <div class="sl-left"> <img src="assets/images/users/backpack.png" alt="user" class="img-circle"> </div>
                                        <div class="sl-right">
                                            <div><a href="#" class="link">Assignments</a> <small class="badge bg-primary">Bot</small>
                                                <blockquote class="mt-2">
                                                    เพิ่มงาน <i class="mdi mdi-arrow-right-bold"></i> <a href=""><?= $item['title'] ?></a> วิชา <a href=""><?= $item['subject_name'] ?></a>
                                                </blockquote>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">สถิติของฉัน</h3>
                            <h6 class="card-subtitle">งานที่ฉันทำทั้งหมดจะปรากฏที่นี่</h6>
                            <div id="visitor" style="height: 290px; width: 100%; max-height: 290px; position: relative;" class="c3">
                                <div class="c3-tooltip-container" style="position: absolute; pointer-events: none; display: none;">
                                </div>
                            </div>
                        </div>
                        <div>
                            <hr class="mt-0 mb-0">
                        </div>
                        <div class="card-body text-center ">
                            <ul class="list-inline d-flex justify-content-center align-items-center mb-0">
                                <li class="me-4">
                                    <h6 style="color: #14C38E"><i class="fa fa-circle font-10 me-2 "></i>ส่งแล้ว</h6>
                                </li>
                                <li class="me-4">
                                    <h6 style="color: #999"><i class="fa fa-circle font-10 me-2 "></i>ยังไม่ได้ส่ง</h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once("views/components/footer.php"); ?>