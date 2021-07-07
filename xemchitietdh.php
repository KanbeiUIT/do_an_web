<?php
    include "header.php";

    $mahd = $_GET['mahd'];

    # Ham dinh dang gia tien
    if (!function_exists('currency_format')) {
        function currency_format($number, $suffix = 'đ') {
            if (!empty($number)) {
                return number_format($number, 0, ',', '.') . "{$suffix}";
            }
        }
    }

    // cau lenh lay chi tiet hoa don co ma la $ma (id).
    $laychitiethd = "SELECT * FROM hoadon_ct WHERE hoadon_id='".$mahd."';";

    $result = $conn->query($laychitiethd);
?>

<div class='container'>
    <h3><b>Chi tiết hóa đơn</b> <span style='text-decoration: underline; text-decoration: underline;'>(mã <?php echo $mahd; ?></span>)</h3>

    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Tên sản phẩm</th>
                <th>Màu sắc</th>
                <th>Số lượng</th>
                <th>Giá bán</th>
            </tr>
        </thead>

        <tbody>
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        
                        $laytenvagiaspsql = "SELECT * FROM sanpham WHERE masp = '".$row['masp']."';";
                        $laytenvagiasp = $conn->query($laytenvagiaspsql);
                        $tenvagiasp = $laytenvagiasp->fetch_assoc();

                        echo "<td><b>".$tenvagiasp['tensp']."</b></td>";

                        $laychitietspsql = "SELECT * FROM sanpham_soluong WHERE maso = '".$row['maso']."';";
                        $laychitietsp = $conn->query($laychitietspsql);
                        $chitietsp = $laychitietsp->fetch_assoc();

                        echo "<td><b>".$chitietsp['mausac']."</b></td>";

                        echo "<td><b>".$row['soluong']."</b></td>";

                        echo "<td><b>".currency_format($tenvagiasp['giaban'])."</b></td>";

                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>

</div>

<?php include "footer.php"; ?>