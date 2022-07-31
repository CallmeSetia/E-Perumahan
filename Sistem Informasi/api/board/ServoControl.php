<?php


include_once "../../util/koneksi.php";

//$locker = array(0, 0, 0 ,0);

if (isset($_GET['ServoControl'])) {
    $control = (int) $_GET['ServoControl'];
    $sql = "UPDATE `tbl_servo` SET 
                    `command_servo`='$control' WHERE `id_servo`='1'";
    $res = $koneksi->query($sql);

}