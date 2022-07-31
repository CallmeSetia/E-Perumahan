<?php

require_once "../../util/koneksi.php";
require_once "../../util/fungsi.php";

//$response = array();
if (isset($_GET['username']) && isset($_GET['password'])) {
    $username = (string) $_GET['username'];
    $password = (string) $_GET['password'];

    $sqlLogin = "SELECT * FROM `tbl_user` WHERE `username` = '$username' AND `password` = '$password'";
    $res = $koneksi->query($sqlLogin);
    if ($res->num_rows > 0) {
        $data = $res->fetch_assoc();
        echo json_encode($data);
//        print_r($response);
    }

}


?>
