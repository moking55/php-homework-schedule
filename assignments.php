<?php
require_once("views/components/header.php");
if (empty($_SESSION['is_login'])) {
    if (!empty($_GET['info'])) {
        header("Location: /share.php?info=".$_GET['info']);
    } else if ($_SESSION['is_login'] != true) {
        header("Location: /login.php");
    }
}
?>
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <?php include "views/components/sidebar.php"; ?>
    <div class="page-wrapper">
        <?php
        if (!empty($_GET['info'])) {
            include "views/components/a_info.php";
        } else if (!empty($_GET['edit'])) {
            include "views/components/a_edit.php";
        } else if (!empty($_GET['add'])) {
            switch ($_GET['add']) {
                case 'work':
                    include "views/components/a_add.php";
                    break;
                case 'instructor':
                    include "views/components/s_add.php";
                    break;

                default:
                include "views/components/a_list.php";
                    break;
            }
        } else {
            include "views/components/a_list.php";
        }
        ?>
    </div>
</div>
<?php
if (isset($_SESSION['flash_message'])) {
    unset($_SESSION['flash_message']);
}
require_once("views/components/footer.php");
?>