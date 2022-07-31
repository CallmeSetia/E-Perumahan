<?php

require_once "../../util/koneksi.php";
require_once "../../util/fungsi.php";

if (isset($_GET['board']) ) {
    $board_id = $_GET['board'];
    $sqlAmbilBoardMode = "SELECT * FROM `mode_board` WHERE `id_board` = '$board_id'";
    $res = $koneksi->query($sqlAmbilBoardMode);
    $row = $res->fetch_assoc();
    $mode_board = $row['mode_board'];

    $sqlMaxIdFingger = "SELECT MAX(`id_finger`) FROM `tbl_finger` WHERE 1";
    $res = $koneksi->query($sqlMaxIdFingger);
    $row = $res->fetch_array();
//    print_r($row);
    $idFingger = $row[0];
    $idFingger += 1;
    echo $mode_board."#".$idFingger;
}
if (isset($_GET['board']) && $_GET['board'] == "12") echo "12";