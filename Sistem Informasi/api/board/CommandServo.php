<?php

include_once "../../util/koneksi.php";

//$locker = array(0, 0, 0 ,0);

if (isset($_GET['ServoControl'])) {
    $control = (int) $_GET['ServoControl'];
    $sql = "UPDATE `tbl_servo` SET 
                    `command_servo`='1' WHERE `id_servo`='1'";
    $res = $koneksi->query($sql);

}


else {
     $sql = "SELECT * FROM `tbl_servo`  WHERE  `id_servo` = '1' ";
     $res = $koneksi->query($sql);
     $data = $res->fetch_assoc();
//     print_r($data);
     echo $data['command_servo'];
}




//echo "0#0#0#0#";
?>