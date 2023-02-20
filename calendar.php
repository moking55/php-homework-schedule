<?php
require_once("views/components/header.php");
if ($_SESSION['is_login'] != true || !isset($_SESSION['is_login'])) {
  return header("Location: /login.php");
}
?>
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
  <?php include 'views/components/sidebar.php'; ?>
  <div class="page-wrapper">
    <div class="page-breadcrumb">
      <div class="row align-items-center">
        <div class="col-md-6 col-6 align-self-center">
          <h3 class="page-title mb-0 p-0">ปฏิทินการศึกษา</h3>
          <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">หน้าแรก</a></li>
                <li class="breadcrumb-item active" aria-current="page">ตารางเรียน</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <table class="table table-light table-bordered">
            <tbody class="text-center">
              <tr>
                <td>วัน/เวลา</td>
                <td>07:70 - 08:00</td>
                <td>08:00 - 09:00</td>
                <td>09:00 - 10:00</td>
                <td>10:00 - 11:00</td>
                <td>11:00 - 12:00</td>
                <td>12:00 - 13:00</td>
                <td>13:00 - 14:00</td>
                <td>14:00 - 15:00</td>
                <td>15:20 - 16:20</td>
                <td>16:20 - 17:20</td>
              </tr>
              <tr>
                <td>จันทร์</td>
                <td rowspan="5"></td>
                <td colspan="2">
                  <p class="m-0">30204-2103</p>
                </td>
                <td colspan="2">30200-0015</td>
                <td></td>
                <td colspan="2">30204-2004</td>
                <td>30204-2005</td>
                <td></td>
              </tr>
              <tr>
                <td>อังคาร</td>
                <td colspan="2">30204-2004</td>
                <td colspan="2">30200-0002</td>
                <td></td>
                <td colspan="2">30200-0015</td>
                <td colspan="2">30204-2006</td>
              </tr>
              <tr>
                <td>พุธ</td>
                <td colspan="2">30200-1001</td>
                <td colspan="2">30204-2103</td>
                <td></td>
                <td>30000-1520</td>
                <td colspan="3">30204-2005</td>
              </tr>
              <tr>
                <td>พฤหัสบดี</td>
                <td colspan="2">30001-1002</td>
                <td colspan="2">30000-1502</td>
                <td></td>
                <td>30200-0002</td>
                <td>30200-1001</td>
                <td colspan="2"></td>
              </tr>
              <tr>
                <td>ศุกร์</td>
                <td colspan="2">30001-1002</td>
                <td colspan="2">30204-2006</td>
                <td></td>
                <td colspan="2">30000-2002</td>
                <td colspan="2"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once("views/components/footer.php"); ?>