<?php include "header.php"; ?>


<div class="container">
    <h3>Giỏ hàng của bạn:</h3>

    <?php
        // $_SESSION['giohang'][masp][maso] = soluong san pham co ma la masp, mau sac cua maso.

        // neu lan dau vao gio hang
        // neu mang session "gio hang" chua duoc khoi tao
        if (!isset($_SESSION['giohang'])) {
            $_SESSION['giohang'] = array();
        }

        // quyet dinh
        // neu action co gia tri
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {

                case "add": // neu action co gia tri la "add"

                    // neu mang session "gio hang" co mang la "$masp" co bien "ma so" chua duoc khoi tao:
                    $maso = $_POST['maso'];
                    $soluong = $_POST['soluong'];
                    $masp = $_GET['masp'];

                    // neu lan dau them san pham X vao gio hang
                    // neu mang session "gio hang" co mang "san pham" chua duoc khoi tao
                    if (!isset($_SESSION['giohang'][$masp])) {
                        $_SESSION['giohang'][$masp] = array();
                    }


                    if (!isset($_SESSION['giohang'][$masp][$maso])) {
                        $_SESSION['giohang'][$masp][$maso] = (int)$soluong;
                    } else { // neu mang session "gio hang" co mang la "$masp" co bien "ma so" da dc khoi tao:
                        
                        // cong bien so luong them $soluong
                        $_SESSION['giohang'][$masp][$maso] += $soluong;
                    }
                    break;


                case "delete": // xoa san pham dang trong gio hang
                    if (isset($_GET['maspdelete']) && isset($_GET['masodelete'])) {
                        unset($_SESSION['giohang'][$_GET['maspdelete']][$_GET['masodelete']]);
                    }
                    break;

                case "update":
                    var_dump();
                    break;

                case "submit":

                    // ngay dat hang
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    date('Y/m/d a', time());
                    $ngaylap = date('Y/m/d a', time());

                    $ghichu = $_POST['ghichu'];

                    $dathangsql = "INSERT INTO hoadon (username, total, giaohang, ghichu, ngaylap) VALUES('".$_SESSION['current_user']['username']."', '".$_SESSION['tongtiengiohang']."', 'chuagiao', '".$ghichu."', '$ngaylap');";

                    // neu them vao hoadon thanh cong:
                    if ($conn->query($dathangsql) === TRUE) {

                        // lay id vua insert
                        $last_id = $conn->insert_id;

                        foreach($_SESSION['giohang'] as $maspdathang => $mangmasospdathang) {
                            //$masosp là 1 mảng

                            foreach($_SESSION['giohang'][$maspdathang] as $masospdathang => $soluongdathang) {

                                $laygiatiensanphamsql = "SELECT giaban FROM sanpham WHERE masp = '".$maspdathang."';";
                                $laygiatiensanpham = $conn->query($laygiatiensanphamsql);
                                $giatiensanpham = $laygiatiensanpham->fetch_assoc();

                                $dathangcthdsql = "INSERT INTO hoadon_ct (hoadon_id, masp, maso, soluong, giatien) VALUES( $last_id, '".$maspdathang."', '".$masospdathang."', $soluongdathang, ".$giatiensanpham['giaban'].");";

                                $conn->query($dathangcthdsql);
                            }
                        }

                        unset($_SESSION['giohang']);
                        unset($_SESSION['tongtiengiohang']);
                    }
                    break;
            }
        }

        # Ham dinh dang gia tien
        if (!function_exists('currency_format')) {
            function currency_format($number, $suffix = 'đ') {
                if (!empty($number)) {
                    return number_format($number, 0, ',', '.') . "{$suffix}";
                }
            }
        }

    ?>

    
    
    <form action="?action=submit" method="POST">

        <table class="table">

            <thead class="thead-dark">
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Màu sắc</th>
                    <th>Giá tiền</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tboody>
                <?php
                    if (isset($_SESSION['giohang'])) {
                        
                        $sothutu = 1;
                        $_SESSION['tongtiengiohang'] = 0;
    
                        foreach ($_SESSION['giohang'] as $masanpham => $masosp) {
    
                            foreach($masosp as $ma => $sl) {
    
                                // thong tin san pham
                                $laythongtinspSQL = "SELECT * FROM sanpham WHERE masp = '".$masanpham."';";
                                $laythongtinsp = $conn->query($laythongtinspSQL);
                                $thongtinsp = $laythongtinsp->fetch_assoc();
    
                                // lay mau san pham
                                $laymauSQL = "SELECT * FROM sanpham_soluong WHERE maso = '".$ma."';";
                                $laymausp = $conn->query($laymauSQL);
                                $mausp = $laymausp->fetch_assoc();
    
                                echo "<tr masp='".$masanpham."'>";
    
                                echo "<td><b>".$sothutu."</b></td>";
                                echo "<td><b>".$thongtinsp['tensp']."</b></td>";
                                echo "<td><img style='width: 100px;' src='".$thongtinsp['image']."'></td>";
                                echo "<td><b>".$mausp['mausac']."<b></td>";
                                echo "<td><span style='color: red;'><b>".currency_format($thongtinsp['giaban'])."</b></span></td>";
    
                                // lay so luong max cho san pham trong gio hang
                                $laysoluongmaxsql = "SELECT soluong FROM sanpham_soluong WHERE maso = '$ma';";
                                $laysoluongmax = $conn->query($laysoluongmaxsql);
                                $soluongmax = $laysoluongmax->fetch_assoc();
    
                                // neu so luong mua lon hon so luong max:
                                if ($sl > $soluongmax['soluong']) {
                                    $_SESSION['giohang'][$masanpham][$ma] = $soluongmax['soluong'];
                                }
                                echo "<td><input class='soluongmua' masosp='".$ma."' type='number' value='".$sl."' min='1' max='".$soluongmax['soluong']."'></td>";
    
                                echo "<td><span style='color: red;'><b>".currency_format($sl * $thongtinsp['giaban'])."</b></span></td>";
                                $_SESSION['tongtiengiohang'] += $sl * $thongtinsp['giaban'];
                                // $tongtiengiohang += $sl * $thongtinsp['giaban'];
    
                                echo "<td>";
                                echo "<a class='btn btn-warning' href='?action=delete&masodelete=".$ma."&maspdelete=".$masanpham."'>Xóa</a>";
                                echo "</td>";
    
                                echo "</tr>";
                            }
                        }
                    }

                    
                ?>

                <tr>
                    <td colspan="6"><b style="text-decoration: underline; font-size: 20px;" class="float-right">Tổng tiền:</b></td>

                    <td colspan="2"><b id="tongtiengiohang" class="w3-text-purple" style="font-size: 25px;"><?php if (isset($_SESSION['tongtiengiohang'])) {echo currency_format($_SESSION['tongtiengiohang']); } ?></b></td>
                </tr>

            </tbody>
        </table>

        <!-- phan ghi chu cho don hang -->
        <a class="w3-button w3-purple" data-toggle="collapse" data-target="#ghichu">Ghi chú đơn hàng</a>

        <div id="ghichu" class="collapse">
            <textarea name="ghichu" style="width: 1100px; height: 100px;"></textarea><br>
        </div>


        <br><p class="float-right" style="text-decoration: underline; font-size: 12px;">( *Nếu muốn thay đổi số lượng từng sản phẩm muốn mua, hãy điều chỉnh nó.)</p>

        <input type="submit" class="btn btn-info btn-outline-danger text-white btn-block" value="Tiến hành đặt hàng">

        <a class="btn btn-danger btn-block" href="index.php">Tiếp tục mua sắm</a>

    </from>
</div>

<?php include "footer.php"; ?>