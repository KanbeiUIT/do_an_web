<?php
    include "connect.php";

    $soluong = $_GET['soluong'];
    $maso = $_GET['maso'];

    $updatesoluong = "UPDATE sanpham_soluong SET soluong = '".$soluong."' WHERE maso = '".$maso."';";

    if ($conn->query($updatesoluong) === TRUE) {
        echo $soluong;
    }
?>