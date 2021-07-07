<?php
    include "header.php";

    # Ham dinh dang gia tien
    if (!function_exists('currency_format')) {
        function currency_format($number, $suffix = 'đ') {
            if (!empty($number)) {
                return number_format($number, 0, ',', '.') . "{$suffix}";
            }
        }
    }

    // xoa san pham

    if (isset($_GET['action'])) {
        if ($_GET['action'] == "xoa") {
            $masp = $_GET['masp'];

            $xoaspsql = "DELETE FROM sanpham WHERE masp = '".$masp."';";

            if ($conn->query($xoaspsql) === TRUE) {
            }
        }
    }

    # cac bien cho viec phan trang
    $sosanphamtrong1trang = 10;
    $tranghientai = !empty($_GET['page'])?$_GET['page']:1;
    $offset = ($tranghientai - 1) * $sosanphamtrong1trang;

    $laysanpham = "SELECT * FROM sanpham ORDER BY id ASC LIMIT $sosanphamtrong1trang OFFSET $offset;";
    $danhsachsanpham = $conn->query($laysanpham);
?>

<div class="container-fluid">

    <div class="row">

        <div class="col-2">

            <ul class="nav flex-column bg-dark rounded">

                <li style="margin-top:10px; margin-bottom: 10px;" class="nav-item">
                    <a class="nav-link disabled btn btn-dark btn-block text-white" href="#"><b>Danh sách sản phẩm</b></a>
                </li>

                <li style="margin-top:10px; margin-bottom: 10px;" class="nav-item">
                    <a class="nav-link btn btn-dark" href="admin_themsanpham.php"><b>Thêm sản phẩm</b></a>
                </li>

                <li style="margin-top:10px; margin-bottom: 10px;" class="nav-item">
                    <a class="nav-link btn btn-dark" href="admin_quanlyslsp.php"><b>Quản lý số lượng</b></a>
                </li>

            </ul>

        </div>

        <div class="col-10">

            <h3><b>Danh sách sản phẩm:</b></h3>

            <table style="font-size:12px;" class="table table-hover">

                <thead class="thead-dark">
                    <tr>
                        <th>STT</th>
                        <th>Mã</th>
                        <th>Tên</th>
                        <th>Hãng</th>
                        <th>Hình ảnh</th>
                        <th>Giá bán</th>
                        <th>Màn hình</th>
                        <th>RAM</th>
                        <th>Bộ nhớ</th>
                        <th>Cam trước</th>
                        <th>Cam sau</th>
                        <th>CPU</th>
                        <th>GPU</th>
                        <th>Pin</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    
                    <?php
                        // $laythongtinsanphamsql = "SELECT * FROM sanpham;";
                        // $laythongtinsanpham = $conn->query($laythongtinsanphamsql);

                        if ($danhsachsanpham->num_rows > 0) {

                            while($row = $danhsachsanpham->fetch_assoc()) {
                                
                                echo "<tr>";

                                echo "<td><b>".$row['id']."</b></td>";
                                echo "<td><b>".$row['masp']."</b></td>";
                                echo "<td><b>".$row['tensp']."</b></td>";
                                echo "<td><b>".$row['brand']."</b></td>";
                                echo "<td><img style='width: 50px;' src='".$row['image']."'></td>";
                                echo "<td><b style='color: red;'>".currency_format($row['giaban'])."</b></td>";
                                echo "<td><b>".$row['manhinh']."</b></td>";
                                echo "<td><b>".$row['ram']."</b></td>";
                                echo "<td><b>".$row['bonhotrong']."</b></td>";
                                echo "<td><b>".$row['camtruoc']."</b></td>";
                                echo "<td><b>".$row['camsau']."</b></td>";
                                echo "<td><b>".$row['cpu']."</b></td>";
                                echo "<td><b>".$row['gpu']."</b></td>";
                                echo "<td><b>".$row['dlpin']."</b></td>";

                                echo "<td class=''><a href='admin_suathongtinsp.php?masp=".$row['masp']."' class='btn btn-info'>Chỉnh sửa</a><a href='?action=xoa&masp=".$row['masp']."' class='btn btn-danger'>Xóa</a></td>";

                                echo "</tr>";
                            }
                        }
                    ?>

                </tbody>

            </table>

            <?php

                // lay so trang theo all brand
                $laytongsosanphamSQL = "SELECT * FROM sanpham";
                $laytongsosanpham = $conn->query($laytongsosanphamSQL);

                $tongsosanpham = $laytongsosanpham->num_rows;
                $tongsotrang = ceil($tongsosanpham/$sosanphamtrong1trang);

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

    </div>

</div>

<?php include "footer.php"; ?>