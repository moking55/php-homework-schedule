<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/views/components/header.php");
if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === true) {
    return header('location: /');
}
if (isset($_GET['action']) && $_GET['action'] == 'chk_login') {
    $queryParams = array(
        "username" => $_POST['username'],
        "password" => $_POST['password'],
    );
    $query = "SELECT `password`,`uid` FROM `users` WHERE `username` LIKE '".$queryParams['username']."'";
    $result = mysqli_fetch_array(mysqli_query($dbl, $query));
    var_dump($result['password']);
    if (isset($result['password']) && password_verify($queryParams['password'], $result['password'])) {
        $_SESSION['uid'] = $result['uid'];
        $_SESSION['is_login'] = true;
        return header("location: /");
    } else {
        $_SESSION['error_message'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
    }
}

?>
<style>
    body {
        background: url("assets/images/background/Purple.jpg") no-repeat center;
        background-size: cover;
    }
</style>
<div class="container-fluid" style="height: 100vh;">
    <div class="row h-100 justify-content-center">
        <div class="col-md-4 my-auto d-flex flex-column">
            <div class="card w-100 mb-0 animate__animated animate__fadeIn">
                <div class="card-body">
                    <?php if (isset($_SESSION['error_message'])) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $_SESSION['error_message'] ?>
                        </div>
                    <?php endif ?>
                    <h3 class="text-center my-4">เข้าสู่ระบบ</h3>
                    <form action="?action=chk_login" method="post">
                        <div class="form-group">
                            <label for="username">ชื่อผู้ใช้:</label>
                            <input type="text" class="form-control" name="username" placeholder="ชื่อผู้ใช้" required />
                        </div>
                        <div class="form-group">
                            <label for="password">รหัสผ่าน:</label>
                            <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน" required />
                        </div>
                        <p>ยังไม่มีบัญชี? <a href="/register.php">สมัครสมาชิก</a></p>
                        <div class="text-center">
                            <button type="submit" class="btn btn-default">เข้าสู่ระบบ</button>
                        </div>
                    </form>
                </div>
            </div>
            <small class="text-muted text-center">Mee kanban borkduay v1.0.0</small>
        </div>
    </div>
</div>
<?php
unset($_SESSION['error_message']);
require_once($_SERVER['DOCUMENT_ROOT'] . "./views/components/footer.php"); ?>