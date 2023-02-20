<?php
$query = "SELECT
`subject`.subject_id, 
`subject`.subject_name, 
assignments.*
FROM
assignments
INNER JOIN
`subject`
ON 
    assignments.`subject` = `subject`.subject_id
WHERE assignments.assignment_id = " . $_GET['edit'];
// $subjects = mysqli_query($dbl, "SELECT subject_id, subject_name FROM `subject`");

$assignmentInfo = mysqli_fetch_array(mysqli_query($dbl, $query));
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h2>แก้ไขงาน</h2>
            <hr>
            <form action="/core/assign_work.php?action=edit" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="title">หัวข้องาน</label>
                            <input required type="text" class="form-control" value="<?= $assignmentInfo['title'] ?>" id="title" name="title" placeholder="หัวข้องาน">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="score">คะแนน</label>
                            <input type="number" value="0" class="form-control" value="<?= $assignmentInfo['score'] ?>" id="score" name="score" placeholder="คะแนน">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="due_date">วันที่ส่ง</label>
                            <input required type="date" class="form-control" value="<?= $assignmentInfo['due_date'] ?>" id="due_date" name="due_date" placeholder="คะแนน">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">คำอธิบาย</label>
                            <textarea class="form-control" id="description" value="<?= $assignmentInfo['description'] ?>" name="description" placeholder="คำอธิบาย"></textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <button class="btn btn-warning" type="submit" name="assignment_id" value="<?= $assignmentInfo['assignment_id'] ?>">แก้ไขงาน</button>
                </div>
            </form>
        </div>
    </div>
</div>