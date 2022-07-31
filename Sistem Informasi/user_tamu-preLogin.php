<?php
require_once "util/koneksi.php";
require_once "util/fungsi.php";

session_start();

//$ROLE_USER = (string)$_GET['user_role'];
if (isset($_GET['hid'])) {
    $nama = $_GET['nama_tamu'];
    $alamat = $_GET['alamat'];

    $_SESSION['nama_tamu'] = $nama;
    $_SESSION['tujuan_tamu'] = $alamat;

    header("location: user_tamu-login.php?ok=0");


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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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
                    <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center text-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <span>Prototype Sistem Keamanan Portal Perumahan Cluster Menggunakan Fingerprint dan One Time Password Berbasis Internet of Thing. </span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Masuk Sistem Sebagai <b>Tamu</b></h5>
                                    <!--                                    <p class="text-center small">Enter your username & password to login</p>-->
                                </div>

                                <div class="row g-3 mt-1 text-center">
                                    <form class="row g-3 needs-validation" method="get" action="">

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Nama Tamu</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="nama_tamu" class="form-control"
                                                       id="yourUsername" required>
                                                <div class="invalid-feedback">Masukan nama Valid.</div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="hid" value="1">

                                        <div class="col-12">
                                            <?php if(isset($_GET['error'])) echo '<div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
               <i class="bi bi-exclamation-octagon me-1"></i>
                Alamat Tidak Boleh Kosong
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>' ?>
                                            <label for="yourPassword" class="form-label">Pilih Alamat</label>
                                            <select class="form-select" name="alamat" aria-label="Default select example">
                                                <option selected=""  disabled selected value>Pilih Rumah Warga</option>
                                                <?php
                                                    $sqlGet_Warga = "SELECT * FROM tbl_user LEFT JOIN tbl_warga ON tbl_user.id_warga = tbl_warga.id_warga WHERE `role` = 'warga'";
                                                    $res = $koneksi->query($sqlGet_Warga);

                                                    if($res->num_rows > 0) {
                                                        while($data = $res->fetch_assoc()) {

                                                            if ($data['alamat_rumah'] != "" || $data['alamat_rumah'] != NULL ) {
                                                                // echo '<option value="'. $data["name"] . ' - ' . $data["alamat_rumah"].'">' . $data["name"] . ' - ' . $data["alamat_rumah"]  . '</option>';
                                                                  echo '<option value="'. $data["id_warga"] .'">' . $data["name"] . ' - ' . $data["alamat_rumah"]  . '</option>';

                                                            }
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>


                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Tamu</button>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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

</body>

</html>