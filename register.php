<?php
require_once("./views/components/header.php");
if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === true) {
    return header('location: /');
}
if (isset($_GET['action']) && $_GET['action'] == 'chk_register') {
    $queryParams = array(
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'email' => $_POST['email'],
    );
    $query = "SELECT COUNT(CASE WHEN users.username LIKE '" . $queryParams['username'] . "' THEN 1 END) AS `isUsernameUsed`,";
    $query .= " COUNT(CASE WHEN users.email LIKE '" . $queryParams['email'] . "' THEN 1 END) as `isEmailUsed` FROM users";
    $result = mysqli_fetch_array(mysqli_query($dbl, $query));
    if ($result['isUsernameUsed'] > 0) {
        $_SESSION['error_message'] = "ชื่อผู้ใช้ถูกใช้ไปแล้ว";
    } else if ($result['isEmailUsed'] > 0) {
        $_SESSION['error_message'] = "อีเมล์ถูกใช้ไปแล้ว";
    } else if ($result['isEmailUsed'] == 0 && $result['isUsernameUsed'] == 0) {
        $query = "INSERT INTO users (`username`,`email`,`password`) VALUES
        ('" . $queryParams['username'] . "','" . $queryParams['email'] . "','" . password_hash($queryParams['password'], PASSWORD_BCRYPT) . "')";
        mysqli_query($dbl, $query);
        return header("location: /login.php");
    } else {
        $_SESSION['error_message'] = "มีบางอย่างผิดปกติ";
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
                    <h3 class="text-center my-4">สมัครสมาชิก</h3>
                    <form action="?action=chk_register" method="post">
                        <div class="form-group">
                            <label for="username">อีเมล์:</label>
                            <input type="text" class="form-control" name="email" placeholder="อีเมล์" required />
                        </div>
                        <div class="form-group">
                            <label for="username">ชื่อผู้ใช้:</label>
                            <input type="text" class="form-control" name="username" placeholder="ชื่อผู้ใช้" required />
                        </div>
                        <div class="form-group">
                            <label for="password">รหัสผ่าน:</label>
                            <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน" required />
                        </div>
                        <p>มีบัญชีอยู่แล้ว? <a href="/login.php">เข้าสู่ระบบ</a></p>
                        <div class="text-center">
                            <button type="submit" class="btn btn-default">Submit</button>
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
require_once("./views/components/footer.php"); ?>