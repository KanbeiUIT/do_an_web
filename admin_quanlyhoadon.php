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

    if (isset($_GET['action'])) {
        if ($_GET['action'] == "update") {
            echo $_POST['mahd'];
        }
    }
?>

<div class="container">
    <h4><b>Trang quản lý hóa đơn</b></h4><br>

    <!-- <form action="admin_quanlyhoadon.php?action=update" method="POST"> -->
        <table class="table table-hover" style="font-size: 14px;">

            <thead class="thead-dark">
                <tr>
                    <th>Mã hóa đơn</th>
                    <th>Tài khoản mua</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái giao hàng</th>
                    <th>Ghi chú</th>
                    <th>Ngày lập</th>
                    <th>Hành động</th>
                    </tr>
            </thead>

            </tbody>
                <?php
                    $laydanhsachhdsql = "SELECT * FROM hoadon;";
                    $laydanhsachhd = $conn->query($laydanhsachhdsql);

                    if ($laydanhsachhd->num_rows > 0) {
                        while($row = $laydanhsachhd->fetch_assoc()) {
                            echo "<tr>";

                            echo "<td><input type='hidden' name='mahd' value='".$row['mahoadon']."'><b>".$row['mahoadon']."</b></td>";
                            echo "<td><b>".$row['username']."</b></td>";
                            echo "<td><b style='color: red;'>".currency_format($row['total'])."</b></td>";

                            // echo "<td><b>".$row['giaohang']."</b></td>";
                            echo "<td><select madh='".$row['mahoadon']."' class='form-control updategiaohangdh'>";
                            if ($row['giaohang'] == "chuagiao") {
                                echo "<option selected='selected' value='chuagiao'>Chưa giao</option>";
                                echo "<option value='danggiao'>Đang giao</option>";
                                echo "<option value='dagiao'>Đã giao</option>";
                            } else if ($row['giaohang'] == "danggiao") {
                                echo "<option value='chuagiao'>Chưa giao</option>";
                                echo "<option selected='selected' value='danggiao'>Đang giao</option>";
                                echo "<option value='dagiao'>Đã giao</option>";
                            } else if ($row['giaohang'] == "dagiao") {
                                echo "<option value='chuagiao'>Chưa giao</option>";
                                echo "<option value='danggiao'>Đang giao</option>";
                                echo "<option selected='selected' value='dagiao'>Đã giao</option>";
                            }
                            echo "</select></td>";

                            echo "<td><b>".$row['ghichu']."</b></td>";
                            echo "<td><b>".$row['ngaylap']."</b></td>";

                            echo "<td class='btn-outline-danger'><a class='btn btn-info' href='xemchitietdh.php?mahd=".$row['mahoadon']."'>Xem chi tiết</a></td>";

                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>

        </table>
    <!-- </form> -->
</div>

<?php include "footer.php"; ?>