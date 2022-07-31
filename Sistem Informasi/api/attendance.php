<?php
// idFinger1 == MASYK
// idFingger2 == KELUAR

require_once "../util/koneksi.php";
require_once "../util/fungsi.php";

if (isset($_GET['idFingger1']) && $_GET['idFingger1'] != NULL) {
    $idFingger = (int)$_GET['idFingger1'];
    $sqlCekFingger = "SELECT * FROM `tbl_user` 
                        LEFT JOIN tbl_finger ON tbl_finger.id_finger = tbl_user.id_finger
                        WHERE tbl_finger.fingger_1 = '$idFingger'";
    $hasil = $koneksi->query($sqlCekFingger);
    if ($hasil->num_rows > 0) { // ADA DATA FINGER USER KETEMU
        $data = $hasil->fetch_assoc();
        $nama = $data['name'];
        $id_warga = $data['id_warga'];
        if ($data['role'] == "warga") { // Cek Fingger ROle PENJAGA ATAU WARGA

            $jamMasuk = time();

            $sqlInsertJamMasuk = "INSERT INTO `history_warga`(`id_history_warga`,`id_warga`, `nama_warga`, `jam`, `status`) 
                                    VALUES ('NULL','$id_warga','$nama','$jamMasuk','MASUK')";
            if($koneksi->query($sqlInsertJamMasuk) == TRUE) {    // IF WARGA INSERT JAM MASUK
                changeBoardMode(0);    // MODE BOARD 0
                // SERVO OPEN
                $sqlOpenServo = "UPDATE `tbl_servo`
                                        SET `command_servo`='1' WHERE `id_servo`='1'";
                if ($koneksi->query($sqlOpenServo) == TRUE) {
                    echo "1";
                }
            }
        }
        if ($data['role'] == "penjaga") {  // IF PENJAGA
            changeBoardMode(0);
            $sqlOpenServo = "UPDATE `tbl_servo`
                                        SET `command_servo`='1' WHERE `id_servo`='1'"; // MODE BOARD 0

            if ($koneksi->query($sqlOpenServo) == TRUE) {  // SERVO OPEN
                echo "2";
            }
        }
    }
}



if (isset($_GET['idFingger2']) && $_GET['idFingger2'] != NULL) {
    $idFingger = (int)$_GET['idFingger2'];
    $sqlCekFingger = "SELECT * FROM `tbl_user` 
                        LEFT JOIN tbl_finger ON tbl_finger.id_finger = tbl_user.id_finger
                        WHERE tbl_finger.fingger_1 = '$idFingger'";
    $hasil = $koneksi->query($sqlCekFingger);
    if ($hasil->num_rows > 0) { // ADA DATA FINGER USER KETEMU
        $data = $hasil->fetch_assoc();
        $nama = $data['name'];
        $id_warga = $data['id_warga'];
        if ($data['role'] == "warga") { // Cek Fingger ROle PENJAGA ATAU WARGA
            $jamMasuk = time();
            $sqlInsertJamMasuk = "INSERT INTO `history_warga`(`id_history_warga`,`id_warga`, `nama_warga`, `jam`, `status`) 
                                    VALUES ('NULL','$id_warga','$nama','$jamMasuk','KELUAR')";
            if($koneksi->query($sqlInsertJamMasuk) == TRUE) {    // IF WARGA INSERT JAM MASUK
                changeBoardMode(0);    // MODE BOARD 0
                // SERVO OPEN
                $sqlOpenServo = "UPDATE `tbl_servo`
                                        SET `command_servo`='1' WHERE `id_servo`='1'";
                if ($koneksi->query($sqlOpenServo) == TRUE) {
                    echo "1";
                }
            }
        }

        if ($data['role'] == "penjaga") {  // IF PENJAGA
            changeBoardMode(0);
            $sqlOpenServo = "UPDATE `tbl_servo`
                                        SET `command_servo`='1' WHERE `id_servo`='1'"; // MODE BOARD 0

            if ($koneksi->query($sqlOpenServo) == TRUE) {  // SERVO OPEN
                echo "2";
            }
        }
    }

}