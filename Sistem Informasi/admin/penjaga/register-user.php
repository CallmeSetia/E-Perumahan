<?php
require_once "../../util/koneksi.php";
require_once "../../util/fungsi.php";

$ROLE_USER = (string)$_GET['user_role'];

$ID_WARGA_NOW = 0;

$sqlCekIDWarga = "SELECT COUNT(role) FROM `tbl_user` WHERE role = 'warga'";
$hasil = $koneksi->query($sqlCekIDWarga);
$row= $hasil->fetch_array();
$ID_WARGA_NOW = $row[0];
$ID_WARGA_NOW += 1;

$FLAG_SUCCSESS_REGISTER = -1;


if (isset($_GET['register_warga'])) {
    changeBoardMode(0);
    $nama_warga = $_GET['nama_warga'];
    $alamat_warga = $_GET['alamat_warga'];
    $user_role = $_GET['user_role'];
    $username_warga = $_GET['username_warga'];
    $password_warga = $_GET['password_warga'];

    $idFingger1_warga = $_GET['idFingger1_warga'];
    $idFingger2_warga = $_GET['idFingger2_warga'];

    $lastID_Fingger = 0;
    $lastID_Warga = 0;

    $sql_InsertFingger = "INSERT INTO `tbl_finger`(`id_finger`, `fingger_1`, `fingger_2`) VALUES ('NULL','$idFingger1_warga','$idFingger2_warga')";
    if ($koneksi->query($sql_InsertFingger) === TRUE) $lastID_Fingger = $koneksi->insert_id;


    $sql_InsertWarga = "INSERT INTO `tbl_warga`(`id_warga`, `alamat_rumah`, `state`) VALUES ('NULL','$alamat_warga','0')";
    if ($koneksi->query($sql_InsertWarga) === TRUE) $lastID_Warga = $koneksi->insert_id;



    $sql_InsertUser = "INSERT INTO `tbl_user`(`id_user`, `username`, `password`, `name`, `role`, `id_warga`, `id_finger`)
                        VALUES ('NULL','$username_warga','$password_warga','$nama_warga','$user_role','$lastID_Warga','$lastID_Fingger')";
    if ($koneksi->query($sql_InsertUser) === TRUE) header("location: list-user.php?user_role=warga&register=1");
    else header("location: list-user.php?user_role=warga&register=-1");
}

else {

// UPDATE BOARD MODE => FINGGER ID WARGA
    changeBoardMode(12);

// Ged Data Finger From Board
    $sqlGetFingger1 = "SELECT `data_finger` FROM `mode_board` WHERE `id_board` = 1";
    $hasil = $koneksi->query($sqlGetFingger1);
    $row = $hasil->fetch_array();
    $ID_FINGGER1 = $row[0];

    $sqlGetFingger2 = "SELECT `data_finger` FROM `mode_board` WHERE `id_board` = 2";
    $hasil = $koneksi->query($sqlGetFingger2);
    $row = $hasil->fetch_array();
    $ID_FINGGER2 = $row[0];
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
                <li class="breadcrumb-item active">Register</li>
                <li class="breadcrumb-item active"><?= strtoupper($ROLE_USER) ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="pagetitle">Register User, <b><?= strtoupper($ROLE_USER) ?></b></h4>
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <form class="row g-3 needs-validation" action="" method="get">

                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">Nama Warga</label>
                                    <div class="input-group has-validation">
                                        <input type="text" name="nama_warga" class="form-control"
                                               id="yourUsername" required>
                                        <div class="invalid-feedback">Masukan nama Valid.</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">Alamat Warga</label>
                                    <div class="input-group has-validation">
                                        <textarea type="text" name="alamat_warga" class="form-control"
                                                  id="yourUsername" required> </textarea>
                                        <div class="invalid-feedback">Masukan Alamat Valid.</div>
                                    </div>
                                </div>
                                <hr>

                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Username Warga</label>
                                    <input type="text" disabled name="username_warga" class="form-control"
                                           id="yourPassword" value="warga0<?=$ID_WARGA_NOW?>" required>
                                    <input type="hidden" name="username_warga"  value="warga0<?=$ID_WARGA_NOW?>"  >
                                    <div class="invalid-feedback">Masukan Username Valid!</div>
                                </div>
                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Password Warga</label>
                                    <input type="text" disabled  class="form-control"
                                           id="yourPassword" required value="warga0<?=$ID_WARGA_NOW?>" >

                                    <input type="hidden" name="password_warga"    value="warga0<?=$ID_WARGA_NOW?>"   >
                                    <div class="invalid-feedback">Masukan Password Valid!</div>
                                </div>
                                <hr>
                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">ID FINGGER 1 Warga</label>
                                    <input type="text" disabled value="<?= $ID_FINGGER1?>"  name="idFingger1_warga" class="form-control idFingger1_IN"
                                           id="yourPassword" required>
                                    <input type="hidden" value="<?= $ID_FINGGER1?>"  name="idFingger1_warga"   class="form-control idFingger1_IN">
                                    <div class="invalid-feedback" >Masukan Password Valid!</div>
                                </div>
                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">ID FINGGER 2 Warga</label>
                                    <input type="text" disabled value="<?= $ID_FINGGER2?>" name="idFingger2_warga" class="form-control idFingger2_IN"
                                           id="yourPassword" required>
                                    <input type="hidden" value="<?= $ID_FINGGER1?>"   name="idFingger2_warga"  class="form-control idFingger2_IN">
                                    <div class="invalid-feedback">Masukan Password Valid!</div>
                                </div>
                                <input type="hidden" name="register_warga" value="1">
                                <input type="hidden" name="user_role" value="<?=$ROLE_USER ?>">
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Register</button>
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

    var refInterval = window.setInterval('update()', 1000); // 30 seconds

    var update = function() {
        $.ajax({
            type : 'GET',
            url : '../../api/register/warga.php?mode=GET',
            success : function(data){
                var dataJson = jQuery.parseJSON(data);
                // var json = $.parseJSON(j);
                $(dataJson["data"]).each(function(i,val){
                    $.each(val,function(k,v){
                        console.log(k+" : "+ v);
                        if (k == "idFingger1") $('.idFingger1_IN').val(v);
                        if (k == "idFingger2") $('.idFingger2_IN').val(v);
                    });
                });
            },
        });
    };
    update();
</script>
</body>
</html>
