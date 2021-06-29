<?php
    $SERVERNAME = "localhost";
    $USERNAME = "root";
    $PASSWORD = "";
    $DATABASE = "dqtshop";

    $conn = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DATABASE);
    if ($conn->connect_error) {
        die ("Không thể kết nối đến database: " . $conn->connect_error);
    }
?>