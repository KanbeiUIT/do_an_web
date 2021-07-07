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
?>

<div class="container">
    <h3>Đơn hàng của bạn</h3>

    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Mã hóa đơn</th>
                <th>Tổng tiền</th>
                <th>Trạng thái giao hàng</th>
                <th>Ghi chú</th>
                <th>Ngày</th>
                <th>Thao tác</th>
            </tr>
        </thead>

        <tbody>

        <?php
            $laydonhangsql = "SELECT * FROM hoadon WHERE username = '".$_SESSION['current_user']['username']."';";
            $laydonhang = $conn->query($laydonhangsql);
            
            if ($laydonhang->num_rows > 0) {

                while($row = $laydonhang->fetch_assoc()) {
                    echo "<tr>";

                    echo "<td><b>".$row['mahoadon']."</b></td>";
                    echo "<td><b>".currency_format($row['total'])."</b></td>";


                    echo "<td>";

                    if ($row['giaohang'] == "chuagiao") {
                        echo "<b class='w3-text-pink'>Chưa giao</b>";

                    } else if ($row['giaohang'] == "danggiao") {
                        echo "<b class='w3-text-orange'>Đang giao</b>";

                    } else if ($row['giaohang'] == "dagiao") {
                        echo "<b class='w3-text-green'>Đã giao</b>";

                    } else {
                        echo "<td>".$row['giaohang']."</td>";
                    }

                  echo "</td>";


                  echo "<td><b>".$row['ghichu']."</b></td>";
                  echo "<td><b>".$row['ngaylap']."</b></td>";

                  echo "<td class='btn-group btn-outline-warning'><a href='xemchitietdh.php?mahd=".$row['mahoadon']."' class='btn btn-info'>Xem chi tiết</a><a href='?action=xoa&mahd=".$row['mahoadon']."&trangthaigiao=".$row['giaohang']."' class='btn btn-danger'>Xóa</a></td>";

                  echo "</tr>";
                }

            }

        ?>

        </tbody>
    </table>

    <?php
        if (isset($_GET['action'])){
            if ($_GET['action'] == "xoa") {
                if ($_GET['trangthaigiao'] == "chuagiao") {
                    $xoadh = "DELETE FROM hoadon WHERE mahoadon = '".$_GET['mahd']."';";

                    if ($conn->query($xoadh) === TRUE) {
                        echo "<p>Xóa đơn hàng thành công! <a href='xemdonhang.php' style='color: red;'>Xác nhận.</a></p>";
                    } else {
                        echo "<p style='color: red;'>Xóa đơn hàng không thành công!</p>";
                    }
                } else {
                    echo "<p style='color: red;'>Đơn hàng không thể xóa!</p>";
                }
            }
        }
    ?>

</div>

<?php include "footer.php"; ?>