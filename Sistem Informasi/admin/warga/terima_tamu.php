<?php
ob_start();
session_start();


require_once "../../util/koneksi.php";
require_once "../../util/fungsi.php";

$id_waiting = $_GET['id_waiting'];

$sqlUpdateAccWarga = "UPDATE `waiting_tamu` SET `acc_warga`='1' WHERE `id_waiting` = '$id_waiting'";
if ($koneksi->query($sqlUpdateAccWarga) == TRUE) header("location: ../index-warga.php?acc=1");
else header("location:  ../index-warga.php?acc=0");
?>