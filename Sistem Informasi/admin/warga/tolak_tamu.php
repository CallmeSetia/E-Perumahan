<?php
ob_start();
session_start();


require_once "../../util/koneksi.php";
require_once "../../util/fungsi.php";

$id_waiting = $_GET['id_waiting'];

$sqkDeleteTamu = "DELETE FROM `waiting_tamu` WHERE `id_waiting` = '$id_waiting'";
if ($koneksi->query($sqkDeleteTamu) == TRUE) header("location: ../index-warga.php?tolak=1");
else header("location:  ../index-warga.php?tolak=0");
?>