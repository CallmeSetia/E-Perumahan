<?php
$random1 = array("957667", "431542", "515052", "348948", "232799", "818261", "738824", "145792", "784946", "965654", "689457", "182411", "850864", "254015", "425744", "830540", "554402", "163118", "416981", "677094", "377931", "281766", "446804", "432169", "201567", "445723", "345007", "174636", "655978");
$random2 = array("080878", "636221", "678177", "756900", "694686", "749899", "709893", "340690", "057376", "533314", "106986", "138759", "439920", "776913", "999443", "364546", "373625", "477868", "858016", "367403", "543005");

session_start();

require_once 'util/koneksi.php';
require_once 'util/fungsi.php';
$SHOW_LOADING = 1;

if (isset($_GET['ok'])) {
    if ($_SESSION['tujuan_tamu'] == NULL) header("location: user_tamu-preLogin.php?error=1");
    else if (isset($_SESSION['nama_tamu'])) {

        $otp1 = $random1[rand(0, 20)];
        $otp2 = $random2[rand(0, 20)];

        $otp = $_GET['ok'];
        $nama = $_SESSION['nama_tamu'];
        $tujuan = (int)$_SESSION['tujuan_tamu'];

        $jam_masuk = time();
//        echo $tujuan;

        $sqlInsertTamu = "INSERT INTO `waiting_tamu`(`id_waiting`, `nama_tamu`, `tujuan_tamu`, `otp_masuk`, `otp_keluar`, `jam_masuk`, `acc_warga`)
                            VALUES ('NULL','$nama','$tujuan','$otp1','$otp2','$jam_masuk','0')";

        if ($koneksi->query($sqlInsertTamu) == TRUE) {
            $_SESSION['id_waiting'] = $koneksi->insert_id;
            header("Refresh:0; user_tamu-login.php?tamu=0");
//            header("location : user_tamu-login.php?tamu=0 ");
        }

//        $sqlInsertTamu = "INSERT INTO `history_tamu`(`id_his_tamu`, `nama_tamu`, `rumah_tujuan`, `otp_masuk`, `otp_keluar`)
//                            VALUES (NULL,'$nama','$tujuan','$otp1','$otp2')";
//
//        $res = $koneksi->query($sqlInsertTamu);

    }
}

if (isset($_GET['tamu'])) {
    if ((int)$_GET['tamu'] == 0 && isset($_SESSION['nama_tamu']) && $_SESSION['tujuan_tamu']) {
//        $nama_tamu = (string) $_SESSION['tamu'];
        $tujuan_tamu = (string)$_SESSION['tujuan_tamu'];
        $id_waiting = (int)$_SESSION['id_waiting'];

        $sqlCekTamu = "SELECT * FROM `waiting_tamu` WHERE `id_waiting` = '$id_waiting'";
        $res = $koneksi->query($sqlCekTamu);
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            if ($row['acc_warga'] == 0) {
                $SHOW_LOADING = 1;
            } else {
                $otp1 = $row['otp_masuk'];
                $otp2 = $row['otp_keluar'];
                $SHOW_LOADING = 0;
            }
        } else {
            $SHOW_LOADING = -1;
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login Ke Sistem</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: NiceAdmin - v2.2.2
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center text-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <!--                <span>Judul Skripsi/Laporan Akhir</span>-->
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Masuk Sistem Sebagai <b>Tamu</b></h5>
                                    <!--                                    <p class="text-center small">Enter your username & password to login</p>-->
                                </div>

                                <div class="row g-3 mt-1 text-center  justify-content-center">
                                    <div id="load">
                                        <div class="spinner-grow text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <p class="small">Menunggu Persetujuaan Pemilik Rumah</p>
                                        <p class="small text-danger">Jangan Close Aplikasi Ini</p>
                                    </div>


                                    <div id="myDiv" style="display: none" class="ilang">
                                        <i class="bi bi-check text-primary" style="font-size: 50px"></i>

                                        <h2>Kode OTP Masuk</h2>
                                        <h4 class="text-success"><?= $otp1 ?></h4>
                                        <h2>Kode OTP Keluar</h2>
                                        <h4 class="text-danger"><?= $otp2 ?></h4>
                                    </div>


                                    <div id="tolak" style="display: none" class="ilang">
                                        <i class="bi bi-x text-danger" style="font-size: 50px"></i>

                                        <h2>Ditolak Oleh Warga Untuk Masuk</h2>

                                    </div>

                                    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                                                class="bi bi-arrow-up-short"></i></a>

                                    <!-- Vendor JS Files -->
                                    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
                                    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                                    <script src="assets/vendor/chart.js/chart.min.js"></script>
                                    <script src="assets/vendor/echarts/echarts.min.js"></script>
                                    <script src="assets/vendor/quill/quill.min.js"></script>
                                    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
                                    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
                                    <script src="assets/vendor/php-email-form/validate.js"></script>

                                    <!-- Template Main JS File -->
                                    <script src="assets/js/main.js"></script>
                                    <script>
                                        var element = document.getElementById("myDiv");
                                        element.style.display = "none";
                                        var element = document.getElementById("load");
                                        element.style.display = "block";
                                        var element = document.getElementById("tolak");
                                        element.style.display = "none";
                                        <?php
                                        if ( $SHOW_LOADING == 0) { ?>
                                        setTimeout(function () {
                                            var element = document.getElementById("load");
                                            element.style.display = "none";
                                            var element = document.getElementById("tolak");
                                            element.style.display = "none";
                                            var element = document.getElementById("myDiv");
                                            element.style.display = "block";
                                        }, 1000);
                                        <?php    }
                                        elseif ( $SHOW_LOADING == -1) { ?>
                                        setTimeout(function () {
                                            var element = document.getElementById("load");
                                            element.style.display = "none";
                                            var element = document.getElementById("myDiv");
                                            element.style.display = "none";
                                            var element = document.getElementById("tolak");
                                            element.style.display = "block";
                                        }, 1000);
                                        <?php }
                                        else { ?>
                                        setInterval(function () {
                                            window.location.reload();
                                        }, 2000);
                                        <?php }
                                        ?>
                                    </script>
</body>
</html>