<?php
    session_start();

    $masp = $_GET['masp'];
    $masosp = $_GET['masosp'];
    $slmua = $_GET['slmua'];

    $_SESSION['giohang'][$masp][$masosp] = $slmua;
?>