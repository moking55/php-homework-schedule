<?php
$subjects = mysqli_query($dbl, "SELECT subject_id, subject_name FROM `subject`");
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h2>เพิ่มงานใหม่</h2>
            <hr>
            <form action="/core/assign_work.php?action=add" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="title">หัวข้องาน</label>
                            <input required type="text" class="form-control" id="title" name="title" placeholder="หัวข้องาน">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="score">คะแนน</label>
                            <input type="number" value="0" class="form-control" id="score" name="score" placeholder="คะแนน">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="due_date">วันที่ส่ง</label>
                            <input required type="date" class="form-control" id="due_date" name="due_date" placeholder="คะแนน">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">คำอธิบาย</label>
                            <textarea class="form-control" id="description" name="description" placeholder="คำอธิบาย"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="subject">รายวิชา</label>
                            <select required class="form-control" id="subject" name="subject">
                                <?php while ($subject = mysqli_fetch_array($subjects)): ?>
                                <option value="<?= $subject['subject_id'] ?>"><?= $subject['subject_name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="attachment">แนบไฟล์</label>
                            <input type="file" class="form-control" id="attachment" name="attachment[]" multiple>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <button class="btn btn-primary" type="submit">สร้างงาน</button>
                </div>
            </form>
        </div>
    </div>
</div>