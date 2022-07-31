<?php

require_once "../util/koneksi.php";
require_once "../util/fungsi.php";


//$ROLE_USER = (string)$_GET['user_role'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: NiceAdmin - v2.2.2
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">

        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">


            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

                    <span class=" d-md-block  ps-2">Penjaga</span>
                </a><!-- End Profile Iamge Icon -->

            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<?php include_once "ui-menu_penjaga.php" ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index-penjaga.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-12 m-1">
                <!--                <h5 class="pagetitle">Rumah Warga Blok A</h5>-->
            </div>

            <?php
            $sqlGet_Warga = "SELECT * FROM tbl_user LEFT JOIN tbl_warga ON tbl_user.id_warga = tbl_warga.id_warga WHERE `role` = 'warga'";
            $res = $koneksi->query($sqlGet_Warga);

            if($res->num_rows > 0) {
                while($data = $res->fetch_assoc()) {
//
                    if ($data['alamat_rumah'] != "" || $data['alamat_rumah'] != NULL ) {
//                       print_r($data);
                        $state = $data['state']; $status_tamu = "";
                        if($state == 1) $status_tamu = "Ada Tamu";
                        else if($state == 0) $status_tamu = "Tidak Ada Tamu";


                        echo '
                        <div class="col-lg-4 col-sm-6 ">';
                        if($state == 1) {
                            echo '<div class="card bg-danger-light text-center m-2 ">';
                        }
                        else if ($state == 0) {
                            echo '<div class="card bg-success-light text-center m-2 ">';
                        }

                        echo '        <div class="card-body">
                                    <h5 class="card-title"> Rumah '. $data['name'] .'</h5>
                                    <p class="card-text">'.$data['alamat_rumah'].'</p> ';
                        if($state == 1) {
                            echo '<a href="#" class="btn btn-danger">Ada Tamu</a>';
                        }
                        else if ($state == 0) {
                            echo '<a href="#" class="btn btn-success">Tidak Ada Tamu</a>';
                        }
                        echo '  </div>
                            </div>
                        </div>
                       
                       ';

                    }
                }
            }

            ?>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
<!--    <div class="credits">-->
<!--        &lt;!&ndash; All the links in the footer should remain intact. &ndash;&gt;-->
<!--        &lt;!&ndash; You can delete the links only if you purchased the pro version. &ndash;&gt;-->
<!--        &lt;!&ndash; Licensing information: https://bootstrapmade.com/license/ &ndash;&gt;-->
<!--        &lt;!&ndash; Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ &ndash;&gt;-->
<!--        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>-->
<!--    </div>-->
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/chart.js/chart.min.js"></script>
<script src="../assets/vendor/echarts/echarts.min.js"></script>
<script src="../assets/vendor/quill/quill.min.js"></script>
<script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>

</body>

</html>