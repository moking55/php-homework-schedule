<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/views/components/header.php");
if ($_SESSION['is_login'] != true || !isset($_SESSION['is_login'])) {
    return header("Location: /login.php");
}

$query = "SELECT * FROM attachments WHERE user_id = " . $_SESSION['uid'];
$getFiles = mysqli_query($dbl, $query);
?>
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/views/components/sidebar.php'; ?>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-md-6 col-6 align-self-center">
                    <h3 class="page-title mb-0 p-0">ไฟล์ทั้งหมด</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">หน้าแรก</a></li>
                                <li class="breadcrumb-item active" aria-current="page">ไฟล์</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="mt-3">ไฟล์ทั้งหมด</h4>
                                <hr>
                                <ul class="list-group list-group-flush">
                                    <?php while ($file = mysqli_fetch_array($getFiles)) : ?>
                                        <li class="list-group-item"><a href="#" download="<?= $file['file_url'] ?>"><i class="mdi mdi-file"></i> <?= $file['file_name'] ?></a></li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . "./views/components/footer.php"); ?>