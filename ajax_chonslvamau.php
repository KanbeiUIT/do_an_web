<?php
    include "connect.php";

    $masp = $_GET['masp'];
    $maso = $_GET['maso'];

    $sql = "SELECT sp_sl.soluong FROM sanpham_soluong AS sp_sl, sanpham AS sp WHERE sp_sl.masp = sp.masp AND sp_sl.masp = '$masp' AND sp_sl.maso = '$maso';";
    // echo $sql;

    $soluong = $conn->query($sql);

    if ($soluong->num_rows > 0) {
        $row = $soluong->fetch_assoc();
        echo $row['soluong'];
    }
?>