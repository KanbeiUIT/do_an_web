<?php
    include "connect.php";

    $masp = $_GET['masp'];

    $laymauvaslsql = "SELECT * FROM sanpham_soluong WHERE masp = '".$masp."';";

    $result = $conn->query($laymauvaslsql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            echo "<option value='".$row['maso']."'>".$row['mausac']."</option>";
        }

    }
?>