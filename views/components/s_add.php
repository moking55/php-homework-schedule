<?php
$subjects = mysqli_query($dbl, "SELECT subject_id, subject_name FROM `subject`");
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h2>เพิ่มวิชาใหม่</h2>
            <hr>
            <form action="/core/instructor.php?action=add" method="post">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="subject_code">รหัสวิชา</label>
                            <input required type="text" class="form-control" id="subject_code" name="subject_code" placeholder="รหัสวิชา">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="subject_name">ชื่อวิชา</label>
                            <input required type="text" class="form-control" id="subject_name" name="subject_name" placeholder="ชื่อวิชา">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="instructor_name">ชื่อผู้สอน</label>
                            <input type="text" class="form-control" id="instructor_name" name="instructor_name" placeholder="ชื่อผู้สอน">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">คำอธิบาย</label>
                            <textarea class="form-control" id="description" name="description" placeholder="คำอธิบาย"></textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <button class="btn btn-primary" type="submit">เพิ่มวิชาใหม่</button>
                </div>
            </form>
        </div>
    </div>
</div>