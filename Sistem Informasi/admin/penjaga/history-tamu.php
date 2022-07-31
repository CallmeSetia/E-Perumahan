<?php

require_once "../../util/koneksi.php";
require_once "../../util/fungsi.php";


$ROLE_USER ="tamu";
date_default_timezone_set("Asia/Jakarta");
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
    <link href="../../assets/img/favicon.png" rel="icon">
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
          rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../assets/css/style.css" rel="stylesheet">

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
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">User</li>
                <li class="breadcrumb-item active"><?= strtoupper($ROLE_USER) ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12 text-end">
                <?php if ($ROLE_USER == "warga") echo '<a href="register-user.php?user_role='.$ROLE_USER.'"> <span class="btn btn-success mb-2">Tambah User</span></a> <br>'?>
                <div class="card">
                    <div class="card-body">
                        <!-- Table with stripped rows -->
                        <table class="table datatable text-start">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <?php if ($ROLE_USER == "tamu") {?>
                                    <th scope="col">Alamat Tujuan</th>
                                    <th scope="col">OTP Masuk</th>
                                    <th scope="col">OTP Keluar</th>
                                    <th scope="col">Date Masuk</th>
                                    <th scope="col">Date Keluar</th>
                                <?php } else { ?>

                                    <th scope="col">Username</th>
                                    <th scope="col">Password</th>

                                    <th scope="col">Role</th>
                                    <th scope="col">Aksi</th>
                                <?php  }?>

                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            if ($ROLE_USER == "tamu") $sql = "SELECT * FROM `history_tamu` 
                                                                LEFT JOIN  tbl_user ON tbl_user.id_warga = history_tamu.tujuan_tamu
                                                                LEFT JOIN  tbl_warga ON tbl_warga.id_warga = history_tamu.tujuan_tamu
                                                                ";
                            else $sql = "SELECT * FROM tbl_user WHERE role = '$ROLE_USER'";
                            $hasil = $koneksi->query($sql);
                            $no = 1;
                            if ($hasil->num_rows > 0) {
                                while ($row = $hasil->fetch_assoc()) {
//                                    print_r($row);
                                    if ($ROLE_USER != "tamu")
                                        echo '
                                            <tr>
                                                <th scope="row">'.$no++.'</th>
                                                <td>'.$row["name"].'</td>
                                                <td>'.$row["username"].'</td>
                                                <td>'.$row["password"].'</td>
                                                <td>'.strtoupper($row["role"]).'</td>
                                                <td><i class="bi bi-pen text-danger"></i><i class="bi bi-trash text-danger"></i></td>
                                            </tr>
                                        ';
                                    else {
//                                        $epoch1 =  $row["jam_masuk"];
//                                        $epoch2 =  $row["jam_keluar"];
//
//                                        $dt1 = new DateTime("@$epoch1");  // convert UNIX timestamp to PHP DateTime
//                                        $dt2 = new DateTime("@$epoch2");  // convert UNIX timestamp to PHP DateTime
//
//                                        echo $dt1->format('Y-m-d H:i:s');
//                                            print_r($row);
                                        echo '
                                            <tr>
                                                <th scope="row">'.$no++.'</th>
                                                <td>'.$row["nama_tamu"].'</td>
                                                <td>'.$row['name'].' - '.$row["alamat_rumah"].'</td>
                                                <td>'.$row["otp_masuk"].'</td>
                                                <td>'.$row["otp_keluar"].'</td>
                                                <td>'.date('Y-m-d H:i:s ', $row["jam_masuk"]).'</td>
                                                <td>'.date('Y-m-d H:i:s ', $row["jam_keluar"]).'</td>
                                            </tr>
                                            ';
                                    }
                                }
                            }
                            else {
                                echo "NO DATA";
                            }
                            ?>



                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>

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

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/vendor/chart.js/chart.min.js"></script>
<script src="../../assets/vendor/echarts/echarts.min.js"></script>
<script src="../../assets/vendor/quill/quill.min.js"></script>
<script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../../assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../../assets/js/main.js"></script>

</body>

</html>