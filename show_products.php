<div class="container">

<?php
    include "connect.php";

    $sql = "SELECT * FROM products;";
    $result = $conn->query($sql);

    if (!function_exists('currency_format')) {
        function currency_format($number, $suffix = 'đ') {
            if (!empty($number)) {
                return number_format($number, 0, ',', '.') . "{$suffix}";
            }
        }
    }

    $xuonghang=4;
    if ($result->num_rows > 0) {
        echo "<div class='row'>";
        while($row = $result->fetch_assoc()) {
            echo "<div class='col-3'>";
            echo "<div class='card container' style='width:300px;'>";
            echo "<img class='card-img-top' src='".$row['image']."' alt=''>";
            echo "<div class='card-body'>";
            echo "<p style='font-size:14px;'><b>".$row['tensp']."<b>|Chính hãng VN/A</p>";

            echo "<p style='color:red; font-size:17px;'><span style='text-decoration: line-through; color:grey; font-size:13px;'>".currency_format(32990000)."</span><br>".currency_format($row['giaban'])."</p>";

            echo "<p style='color:grey; font-size:12px;'>";
            echo "<i class='bi bi-cpu-fill'></i>".$row['cpu']." | ";
            echo "<i class='fas fa-microchip'></i>".$row['ram']." | ";
            echo "<i class='fas fa-hdd'></i>".$row['bonhotrong'];
            echo "</p>";

            echo "<a href='#' class='btn btn-danger btn-block'>Mua</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            $xuonghang ++;
        }
        echo "</div>";
    }
?>

</div>