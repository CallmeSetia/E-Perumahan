<?php
require_once "../../util/koneksi.php";
require_once "../../util/fungsi.php";


// WARGA => mode=12&idFingger1=5&idFingger2=3
if (isset($_GET['mode']) && $_GET['mode'] == 12) {
    if (isset( $_GET['idFingger1'])) {
        $idFingger1 = $_GET['idFingger1'];
        $sqlBoard1 = "UPDATE `mode_board` SET `mode_board` = '0', `data_finger` = '$idFingger1', `fingger_oke` = '1'  WHERE `mode_board`.`id_board` = 1";
        $hasil = $koneksi->query($sqlBoard1);
        if ($hasil) echo 1; // Response OK
        else echo 0; // Response FALSE
    }
    if(isset( $_GET['idFingger2'])){
        $idFingger2 = $_GET['idFingger2'];
        $sqlBoard2 = "UPDATE `mode_board` SET  `mode_board` = '0', `data_finger` = '$idFingger2', `fingger_oke` = '1'  WHERE `mode_board`.`id_board` = 2";
        $hasi2 = $koneksi->query($sqlBoard2);
        if ($hasi2) echo 1; // Response OK
        else echo 0; // Response FALSE
    }


}

if (isset($_GET['mode']) && $_GET['mode'] == "GET") {
    // Ged Data Finger From Board
    $sqlGetFingger1 = "SELECT `data_finger` FROM `mode_board` WHERE `id_board` = 1";
    $hasil = $koneksi->query($sqlGetFingger1);
    $row = $hasil->fetch_array();
    $ID_FINGGER1 = $row[0];

    $sqlGetFingger2 = "SELECT `data_finger` FROM `mode_board` WHERE `id_board` = 2";
    $hasil = $koneksi->query($sqlGetFingger2);
    $row = $hasil->fetch_array();
    $ID_FINGGER2 = $row[0];

    $response = array();
    $response["status"]= "OKE";
    $response["data"]=array();

    $data["idFingger1"] = $ID_FINGGER1;
    $data["idFingger2"] = $ID_FINGGER2;


    array_push($response['data'], $data);
    echo json_encode($response);
//    echo "Diterima".$_GET['UID'];

}




?>