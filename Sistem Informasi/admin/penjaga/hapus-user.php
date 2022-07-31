<?php

require_once "../../util/koneksi.php";
require_once "../../util/fungsi.php";


if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];
    $sqlDelete = "DELETE FROM `tbl_user` WHERE `id_user` = '$id_user'";
    if ($koneksi->query($sqlDelete) == TRUE) header("location: list-user.php?user_role=warga&delete=1");
    else header("location: list-user.php?user_role=warga&delete=-1");

}