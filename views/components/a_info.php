<?php

$query = "SELECT
count(*) AS is_submitted, 
assignments.*, 
`subject`.subject_name,
`subject`.instructor_name
FROM
assignments
INNER JOIN
submitted
ON 
    assignments.assignment_id = submitted.assignment_id
INNER JOIN
`subject`
ON 
    assignments.`subject` = `subject`.subject_id
WHERE
submitted.user_id = " . $_SESSION['uid'] . " AND
submitted.assignment_id = " . $_GET["info"];

$classInformation = mysqli_query($dbl, $query);
$classInformation = mysqli_fetch_array($classInformation);


$query = "SELECT * FROM attachments WHERE assignment_id = " . $_GET["info"];
$getFiles = mysqli_query($dbl, $query);
?>
<div class="container-fluid">
    <?php if ($classInformation['is_submitted'] == 1) : ?>
        <div class="alert alert-success" role="alert">
            <i class="mdi mdi-check" style="font-size: 12pt;"></i> ทำเสร็จแล้ว #เก่งมากๆ
        </div>
    <?php endif ?>
    <div class="card p-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 col-6 col-xs-6 b-r"> <strong>ชื่อวิชา</strong>
                    <br>
                    <p class="text-muted"><?= $classInformation['subject_name'] ?></p>
                </div>
                <div class="col-md-3 col-6 col-xs-6 b-r"> <strong>ครูผู้สอน</strong>
                    <br>
                    <p class="text-muted"><?= $classInformation['instructor_name'] ?></p>
                </div>
                <div class="col-md-3 col-6 col-xs-6 b-r"> <strong>คะแนนเต็ม</strong>
                    <br>
                    <p class="text-muted"><?= $classInformation['score'] ?></p>
                </div>
                <div class="col-md-3 col-6 col-xs-6"> <strong>กำหนดส่ง</strong>
                    <br>
                    <p class="text-muted"><?= $classInformation['due_date'] ?></p>
                </div>
            </div>
            <hr>
            <h3><?= $classInformation['title'] ?></h3>
            <p class="text-muted"><?= $classInformation['description'] ?></p>

            <hr>
            <div class="row">
                <div class="col-md-8">
                    <h4>ไฟล์แนบ</h4>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($getFiles as $file) : ?>
                            <li class="list-group-item"><a href="#" download="<?= $file['file_url'] ?>"><i class="mdi mdi-file"></i> <?= $file['file_name'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>ดำเนินการ</h4>
                    <div class="btn-group-vertical w-100" role="group" aria-label="Vertical button group">
                        <?php if ($classInformation['is_submitted'] == 1) : ?>
                            <a class="btn btn-outline-danger" href="/core/check_work.php?info=<?= $_GET['info'] ?>&is_submitted=false" type="button">ทำเครื่องหมายว่ายังไม่เสร็จ</a>
                        <?php else : ?>
                            <a class="btn btn-outline-success" href="/core/check_work.php?info=<?= $_GET['info'] ?>&is_submitted=true" type="button">ทำเครื่องหมายว่าส่งแล้ว</a>
                            <!-- <button class="btn btn-outline-warning" type="button">แก้ไขงาน</button> -->
                        <?php endif ?>
                        <a href="/assignments.php?edit=<?= $_GET['info'] ?>" class="btn btn-outline-warning">แก้ไขงาน</a>
                        <button onclick="if(confirm('แน่ใจหรือไม่ว่าจะลบงานนี้?')) {location.replace('/core/del_work.php?id=<?= $_GET['info'] ?>')}" class="btn btn-outline-danger" type="button">ลบงาน</button>
                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">แชร์ให้เพื่อน</button>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">แชร์ลิ้งนี้ให้กับเพื่อน</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>คัดลอกลิ้งนี้และส่งไปให้เพื่อน</p>
                                <?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>