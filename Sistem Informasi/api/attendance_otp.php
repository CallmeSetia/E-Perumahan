<?php
require_once "../util/koneksi.php";
require_once "../util/fungsi.php";

if (isset($_GET['otp'])) {
    $otp = $_GET['otp'];

    $sqlSelectTamu_Masuk = "SELECT * FROM `waiting_tamu` WHERE  `otp_masuk` = '$otp' ";
    $res = $koneksi->query($sqlSelectTamu_Masuk);
    if ($res->num_rows > 0) { // Ada di waiting
        $data = $res->fetch_assoc();
        $id_waiting = $data['id_waiting'];
        $nama_tamu = $data['nama_tamu'];
        $tujuan_tamu = $data['tujuan_tamu'];
        $otp_masuk = $data['otp_masuk'];
        $otp_keluar = $data['otp_keluar'];
        $jam_masuk = time();

        $sqlInsertHistoryTamu = "INSERT INTO `history_tamu`(`id_his_tamu`, `nama_tamu`, `tujuan_tamu`, 
                                                    `otp_masuk`, `otp_keluar`, `jam_masuk`, `jam_keluar`) 
                                    VALUES ('NULL','$nama_tamu','$tujuan_tamu','$otp_masuk',
                                            '$otp_keluar','$jam_masuk','0')";
        if ($koneksi->query($sqlInsertHistoryTamu) == TRUE) {
            $sqlStausRumahWargaAdaTamu = "UPDATE `tbl_warga` SET `state`='1' WHERE `id_warga`='$tujuan_tamu'";
            if ($koneksi->query($sqlStausRumahWargaAdaTamu) == TRUE) {
                $sqlHapusWaiting = "DELETE FROM `waiting_tamu` WHERE `id_waiting` = '$id_waiting'";
                if ($koneksi->query($sqlHapusWaiting)) echo 1;
                else echo 0;
            }
            else echo 0;
        }
        else echo 0;
    }
    else { // OTP KELUAR
        $sqlSelectTamu_Keluar = "SELECT * FROM `history_tamu` WHERE  `otp_keluar` = '$otp'";
        $res =  $koneksi->query($sqlSelectTamu_Keluar);
        if ($res->num_rows > 0) {
            $data  = $res->fetch_assoc();
            $jam_keluar = time();
            $id_history = $data['id_his_tamu'];
            $tujuan_tamu = $data['tujuan_tamu'];
            $sqlStausRumahWargaAdaTamu = "UPDATE `tbl_warga` SET `state`='0' WHERE `id_warga`='$tujuan_tamu'";
            if ($koneksi->query($sqlStausRumahWargaAdaTamu) == TRUE) {
                $sqlUpdateJamKeluar= "  UPDATE `history_tamu` SET `jam_keluar` = '$jam_keluar' 
                                                WHERE `history_tamu`.`id_his_tamu` = '$id_history'";
                if ($koneksi->query($sqlUpdateJamKeluar))  echo 1;
                else echo 0;
            }
            else echo 0;
        }
        else echo 0;
    }
}