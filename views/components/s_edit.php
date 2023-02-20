<?php
$subjects = mysqli_fetch_array(mysqli_query($dbl, "SELECT * FROM `subject` WHERE `subject`.subject_id = ". $_GET['edit']));
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h2>แก้ไขรายวิชา</h2>
            <hr>
            <form action="/core/instructor.php?action=edit" method="post">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="subject_code">รหัสวิชา</label>
                            <input required type="text" class="form-control" id="subject_code" value="<?= $subjects['subject_code'] ?>" name="subject_code" placeholder="รหัสวิชา">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="subject_name">ชื่อวิชา</label>
                            <input required type="text" class="form-control" id="subject_name" value="<?= $subjects['subject_name'] ?>" name="subject_name" placeholder="ชื่อวิชา">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="instructor_name">ชื่อผู้สอน</label>
                            <input type="text" class="form-control" id="instructor_name" value="<?= $subjects['instructor_name'] ?>" name="instructor_name" placeholder="ชื่อผู้สอน">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">คำอธิบาย</label>
                            <textarea class="form-control" id="description" name="description" value="<?= $subjects['description'] ?>" placeholder="คำอธิบาย"></textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <button class="btn btn-primary" type="submit" name="subject_id" value="<?= $_GET['edit'] ?>">ยืนยันการแก้ไข</button>
                    <button class="btn btn-danger" type="button" onclick="javascript: confirm('ต้องการลบวิชา <?=  $subjects['subject_name'] ?>')? window.location.replace('/core/instructor.php?action=delete&subject_id=<?=  $subjects['subject_id'] ?>') : null">ลบวิชานี้</button>
                    <button class="btn btn-secondary" type="reset">ล้างการแก้ไข</button>
                </div>
            </form>
        </div>
    </div>
</div>