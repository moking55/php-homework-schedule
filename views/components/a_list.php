<?php
function getAssignments($isSubmitted) {
    global $dbl;
    $query = "SELECT `subject`.subject_name, assignments.assignment_id, assignments.title, assignments.due_date FROM assignments
    INNER JOIN `subject` ON assignments.`subject` = `subject`.subject_id";
    if($isSubmitted) {
        $query .= " WHERE is_submitted = 1";
    } else {
        $query .= " WHERE is_submitted = 0";
    }
    $myAssignments = mysqli_query($dbl, $query);
    return $myAssignments;
}
$submitted = getAssignments(true);
$unsubmitted = getAssignments(false);
?>

<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-md-6 col-6 align-self-center">
            <h3 class="page-title mb-0 p-0">งานของฉัน</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Assignments</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <a href="/assignments.php?add=work" class="btn btn-primary mx-1">เพิ่มงานใหม่</a>
            <a href="/assignments.php?add=instructor" class="btn btn-warning mx-1">เพิ่มผู้สอน</a>
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
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">งานที่ยังไม่ได้ส่ง</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab">งานที่ส่งแล้ว</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel">
                    <div class="card-body">
                        <div class="list-group">
                            <?php while ($assignment = mysqli_fetch_array($unsubmitted)) : ?>
                                <a href="/assignments.php?info=<?= $assignment['assignment_id'] ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1"><?= $assignment['title'] ?></h5>
                                        <small style="font-size: 10pt" class="<?= (strtotime($assignment['due_date']) > time())? "text-muted" : "text-danger"?>"><?= $assignment['due_date'] ?></small>
                                    </div>
                                    <small class="text-muted"><?= $assignment['subject_name'] ?></small>
                                </a>
                            <?php endwhile ?>
                        </div>
                    </div>
                </div>
                <!--second tab-->
                <div class="tab-pane" id="profile" role="tabpanel">
                    <div class="card-body">
                        <div class="list-group">
                            <?php while ($assignment = mysqli_fetch_array($submitted)) : ?>
                                <a href="/assignments.php?info=<?= $assignment['assignment_id'] ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1"><?= $assignment['title'] ?></h5>
                                        <small style="font-size: 10pt" class="text-muted"><?= $assignment['due_date'] ?></small>
                                    </div>
                                    <small class="text-muted"><?= $assignment['subject_name'] ?></small>
                                </a>
                            <?php endwhile ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>