<?php
require_once "../../util/koneksi.php";
require_once "../../util/fungsi.php";

//$ROLE_USER = (string)$_GET['user_role'];
$ID_USER = (string)$_GET['id_user'];

$ID_WARGA_NOW = 0;

$sqlSelectUser = "SELECT * FROM `tbl_user` 
                    LEFT JOIN tbl_warga ON tbl_warga.id_warga = tbl_user.id_warga
                    LEFT JOIN tbl_finger ON tbl_finger.id_finger = tbl_user.id_finger
                    WHERE id_user = '$ID_USER'";

$hasil = $koneksi->query($sqlSelectUser);
$row = $hasil->fetch_assoc();

print_r($row);

if (isset($_GET['edit_warga'])) {
    changeBoardMode(0);
    $id_user = $_GET['id_user'];
    $nama_warga = $_GET['nama_warga'];
    $alamat_warga = $_GET['alamat_warga'];
    $username_warga = $_GET['username_warga'];
    $password_warga = $_GET['password_warga'];

    $id_warga = $_GET['id_warga'];
    $id_finger = $_GET['id_finger'];

    $idFingger1_warga = $_GET['idFingger1_warga'];
    $idFingger1_warga = $_GET['idFingger2_warga'];
    $role_warga = $_GET['user_role'];

    $sqlUpdate = "UPDATE `tbl_user` SET `username`='$username_warga',`password`='$password_warga',
                      `name`='$nama_warga',`role`='$role_warga', `id_warga`='$id_warga',`id_finger`='$id_finger' 
                        WHERE `id_user`='$id_user' ";

    if ($koneksi->query($sqlUpdate) == TRUE) header("location: list-user.php?user_role=warga");


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
                <li class="breadcrumb-item active">Edit USer</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="pagetitle">Edit User</h4>
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <form class="row g-3 needs-validation" action="" method="get">

                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">Nama Warga</label>
                                    <div class="input-group has-validation">
                                        <input type="text" name="nama_warga" class="form-control"
                                               id="yourUsername" value="<?= $row['name'] ?>">
                                        <div class="invalid-feedback">Masukan nama Valid.</div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">Alamat Warga</label>
                                    <div class="input-group has-validation">
                                        <textarea type="text" name="alamat_warga" class="form-control"
                                                  id="yourUsername" required> <?= $row['alamat_rumah'] ?> </textarea>
                                        <div class="invalid-feedback">Masukan Alamat Valid.</div>
                                    </div>
                                </div>
                                <hr>

                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Username Warga</label>
                                    <input type="text" name="username_warga" class="form-control"
                                           id="yourPassword" value="<?= $row['username'] ?> ">
                                    <div class="invalid-feedback">Masukan Username Valid!</div>
                                </div>
                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Password Warga</label>
                                    <input type="text" name="password_warga" class="form-control"
                                           id="yourPassword" value="<?= $row['password'] ?>">
                                    <div class="invalid-feedback">Masukan Password Valid!</div>
                                </div>
                                <hr>
                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">ID FINGGER 1 Warga</label>
                                    <input type="text" value="<?= $row['fingger_1'] ?>" name="idFingger1_warga"
                                           class="form-control idFingger1_IN"
                                           id="yourPassword" required>
                                    <div class="invalid-feedback">Masukan Password Valid!</div>
                                </div>
                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">ID FINGGER 2 Warga</label>
                                    <input type="text" value="<?= $row['fingger_2'] ?>" name="idFingger2_warga"
                                           class="form-control idFingger2_IN"
                                           id="yourPassword" required>
                                    <div class="invalid-feedback">Masukan Password Valid!</div>
                                </div>
                                <input type="hidden" name="edit_warga" value="1">
                                <input type="hidden" name="user_role" value="<?= $row['role'] ?>">
                                <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
                                <input type="hidden" name="id_warga" value="<?= $row['id_warga'] ?>">
                                <input type="hidden" name="id_finger" value="<?= $row['id_finger'] ?>">
                               <!-- <input type="hidden" name="id_user" value="<?= $row['id_finger'] ?>"> -->

                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Edit Data</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
<a class="back-to-top d-flex align-items-center justify-content-center" href="#"><i
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>

</script>
</body>
</html>
