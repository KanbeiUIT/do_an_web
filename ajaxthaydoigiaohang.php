<?php
    include "connect.php";

    $madh = $_GET['madh'];
    $giaohang = $_GET['giaohang'];

    $updatedh = "UPDATE hoadon SET giaohang = '".$giaohang."' WHERE mahoadon = '".$madh."';";
    $conn->query($updatedh);
?>