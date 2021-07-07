<?php
    include "connect.php";

    $maso = $_GET['maso'];
    $masp = $_GET['masp'];

    $laysoluong = "SELECT * FROM sanpham_soluong WHERE maso = '".$maso."' AND masp = '".$masp."';";

    $result = $conn->query($laysoluong);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo $row['soluong'];
    }

?>