<div class="container bg-dark text-white">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="?brand=all">Tất cả</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?brand=apple"><i class='fab fa-apple'></i> iPhone</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?brand=samsung"><img style="width:30px;" src="assets\icons\samsung-xxl.png"> Samsung</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?brand=xiaomi"><img style="width:30px;" src="assets\icons\cb53d70c-1145-11e6-861f-fb23ad0b07aa.png"> Xiaomi</a>
        </li>
    </ul>
</div>

<div class="container">

<?php
    # Ham dinh dang gia tien
    if (!function_exists('currency_format')) {
        function currency_format($number, $suffix = 'đ') {
            if (!empty($number)) {
                return number_format($number, 0, ',', '.') . "{$suffix}";
            }
        }
    }

    # cac bien cho viec phan trang
    $sosanphamtrong1trang = 8;
    $tranghientai = !empty($_GET['page'])?$_GET['page']:1;
    $offset = ($tranghientai - 1) * $sosanphamtrong1trang;

    # lay cac san pham theo LIMIT - OFFSET!

    // kiem tra co truyen brand hay khong
    // co: -> brand = brand truyen theo
    // khong: -> brand = all | khong lay theo brand
    if (isset($_GET['brand'])) {
        if ($_GET['brand'] != 'all') {
            $whereBrand = "WHERE brand = '" . $_GET['brand']."'";
        } else {
            // brand = all
            $whereBrand = "";
        }
    } else {
        $whereBrand = "";
    }



    // lay so trang theo all brand
    $laytongsosanphamSQL = "SELECT * FROM sanpham";
    $laytongsosanpham = $conn->query($laytongsosanphamSQL);

    $tongsosanpham = $laytongsosanpham->num_rows;
    $tongsotrang = ceil($tongsosanpham/$sosanphamtrong1trang);


    // lay danh sach san pham theo whereBrand
    $laysanpham = "SELECT * FROM sanpham ".$whereBrand." ORDER BY id ASC LIMIT $sosanphamtrong1trang OFFSET $offset;";
    $danhsachsanpham = $conn->query($laysanpham);


    if ($danhsachsanpham->num_rows > 0) {
        echo "<div class='row'>";
        while($row = $danhsachsanpham->fetch_assoc()) {
            echo "<div class='card container col-3' style='width:280px; height:460px;'>";
            echo "<a href='detail.php?masp=".$row['masp']."'><img class='card-img-top' src='".$row['image']."' alt=''></a>";

            echo "<div class='card-body'>";

            echo "<span style='font-size:13px;'><b>".$row['tensp']."</span><br>";
            if (strlen($row['tensp']) < 25) { echo "<br>";}

            echo "<span style='font-size:10px;'>Chính hãng VN/A</span><br>";

            echo "<span style='color:red; font-size:17px;'><span style='text-decoration: line-through; color:grey; font-size:13px;'>".currency_format($row['giagoc'])."</span><br>".currency_format($row['giaban'])."</span><br>";

            echo "<p style='color:grey; font-size:9px;'>";
            echo "<i class='bi bi-cpu-fill'></i>".$row['cpu']." | ";
            echo "<i class='fas fa-microchip'></i>".$row['ram']." | ";
            echo "<i class='fas fa-hdd'></i>".$row['bonhotrong'];
            echo "</p>";

            echo "<a href='detail.php?masp=".$row['masp']."' class='btn btn-danger btn-block'>Mua ngay</a>";
            echo "</div>";

            echo "</div>";
        }
        echo "</div>";
    }



    #--------- Danh so trang ------------
    echo "<ul class='pagination justify-content-center' style='margin:20px 0'>";


    if ($tranghientai > 3) {
        echo "<li class='page-item'><a class='page-link' href='?page=1'> << </a></li>";
    }
    if ($tranghientai > 2) {
        $previouspage = $tranghientai - 1;
        echo "<li class='page-item'><a class='page-link' href='?page=".$previouspage."'> < </a></li>";
    }
    for ($num = 1; $num <= $tongsotrang; $num++) {
        if ($num != $tranghientai) {
            if ($num > $tranghientai -3 && $num < $tranghientai + 3) {
                echo "<li class='page-item'><a class='page-link' href='?page=".$num."'>".$num."</a></li>";
            }
        } else {
            echo "<li class='page-item active'><a class='page-link' href='?page=".$num."'>".$num."</a></li>";
        }
    }
    if ($tranghientai < $tongsotrang -1) {
        $nextpage = $tranghientai + 1;
        echo "<li class='page-item'><a class='page-link' href='?page=".$nextpage."'> > </a></li>";
    }
    if ($tranghientai < $tongsotrang - 3) {
        echo "<li class='page-item'><a class='page-link' href='?page=".$tongsotrang."'> >> </a></li>";
    }

    
    echo "</ul>";
?>

</div>