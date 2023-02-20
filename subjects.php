<?php
require_once("views/components/header.php");
if ($_SESSION['is_login'] != true || !isset($_SESSION['is_login'])) {
    return header("Location: /login.php");
}

$query = "SELECT * FROM subject";
$getClassInfo = mysqli_query($dbl, $query);
?>
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <?php include 'views/components/sidebar.php'; ?>
    <div class="page-wrapper">
        <?php
        if (isset($_GET['edit'])) :
            include "./views/components/s_edit.php";
        else :
        ?>
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-6 align-self-center">
                        <h3 class="page-title mb-0 p-0">รายวิชาทั้งหมด</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">หน้าแรก</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">รายวิชาทั้งหมด</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <a href="/assignments.php?add=instructor" class="btn btn-warning mx-1">เพิ่มรายวิชา</a>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="col-md-12">
                    <?php if (isset($_SESSION['flash_message'])) : ?>
                        <div class="alert alert-info" role="alert">
                            <?= $_SESSION['flash_message'] ?>
                        </div>
                    <?php endif ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="mt-3">รายวิชาทั้งหมด</h4>
                                    <hr>
                                    <ul class="list-group list-group-flush">
                                        <?php while ($classInfo = mysqli_fetch_array($getClassInfo)) : ?>
                                            <li class="list-group-item"><a href="/subjects.php?edit=<?= $classInfo['subject_id'] ?>"><span>[ <?= $classInfo['subject_code'] ?> ]</span> <?= $classInfo['subject_name'] ?></a> <small>(<?= $classInfo['instructor_name'] ?>)</small></li>
                                        <?php endwhile; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

</div>
<?php
if (isset($_SESSION['flash_message'])) {
    unset($_SESSION['flash_message']);
}
require_once("views/components/footer.php");
?>