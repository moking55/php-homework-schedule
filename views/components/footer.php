
<!-- Javascript ที่นำไปใช้ทุกหน้า -->

<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="//<?= $_SERVER['SERVER_NAME'] ?>/assets/plugins/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="//<?= $_SERVER['SERVER_NAME'] ?>/assets/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="//<?= $_SERVER['SERVER_NAME'] ?>/assets/js/app-style-switcher.js"></script>
<!--Wave Effects -->
<script src="//<?= $_SERVER['SERVER_NAME'] ?>/assets/js/waves.js"></script>
<!--Menu sidebar -->
<script src="//<?= $_SERVER['SERVER_NAME'] ?>/assets/js/sidebarmenu.js"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!-- chartist chart -->
<script src="//<?= $_SERVER['SERVER_NAME'] ?>/assets/plugins/chartist-js/dist/chartist.min.js"></script>
<script src="//<?= $_SERVER['SERVER_NAME'] ?>/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
<!--c3 JavaScript -->
<script src="//<?= $_SERVER['SERVER_NAME'] ?>/assets/plugins/d3/d3.min.js"></script>
<script src="//<?= $_SERVER['SERVER_NAME'] ?>/assets/plugins/c3-master/c3.min.js"></script>
<!--Custom JavaScript -->
<script src="//<?= $_SERVER['SERVER_NAME'] ?>/assets/js/pages/dashboards/dashboard1.js"></script>
<script src="//<?= $_SERVER['SERVER_NAME'] ?>/assets/js/custom.js"></script>

<!-- Javascript นำไปใช้บางหน้าหรือไว้ใช้เฉพาะ -->
<?php

// รับลิ้ง Javascript จากตัวแปร $customJs โดยรับเป็น Array เท่านั้น
if (isset($customJs)) {
    foreach ($customJs as $jsLink) {
        echo "<script src=\"$jsLink\" ></script>";
    }
} ?>
</body>

</html>