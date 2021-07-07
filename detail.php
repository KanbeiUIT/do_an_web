<?php
    include "header.php";

    $masanpham = $_GET['masp'];


    // lay thong tin san pham tu masp
    $laysanphamsql = "SELECT * FROM sanpham WHERE masp = '$masanpham';";
    $result = $conn->query($laysanphamsql);
    // san pham lay duoc
    $product = mysqli_fetch_assoc($result);


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

    <h2><b><?php echo $product['tensp']; ?></b><small style="color: grey;"><?php echo " (". $product['masp'] .")" ?></small></h2>
    <hr>

    <div class="row">
            <div class="col-6">
                <img style="width: 300px;" src="<?php echo $product['image']; ?>">

                <div class="container-fluid">
                    <br><p><b>Hình ảnh sản phẩm:</b></p>

                    <?php
                        // lay thu vien anh cua san pham tu sanpham_thuvienanh
                        $laythuvienanhsp = "SELECT * FROM sanpham_thuvienanh WHERE masp = '".$masanpham."';";
                        $thuvienanh = $conn->query($laythuvienanhsp);
                        // neu co thu vien anh
                        if ($thuvienanh->num_rows > 0) {

                            while($row = $thuvienanh->fetch_assoc()) {
                                // xuat tung anh ra
                                echo "<img style='width: 150px;' src='".$row['path']."'>";
                            }

                        }
                    ?>

                </div>
            </div>
            <div class="col-6">

                <?php echo "<p style='color:red; font-size:30px;'>".currency_format($product['giaban'])." <span style='text-decoration: line-through; color:grey; font-size:15px;'>".currency_format($product['giagoc'])."</span></p><br>"; ?>
                

                <form action="giohang.php?action=add&masp=<?php echo $product['masp'] ?>" method="POST">

                    <table border="0" style="padding: 10px;">

                        <tr>
                            <td><b>Màu sắc:</b></td>
                            <td>
                                <select name="maso" masp="<?php echo $masanpham; ?>" id="chonmau">
                                    <?php

                                        $chonmausql = "SELECT * from sanpham_soluong WHERE masp = '".$masanpham."';";

                                        $mauvasoluong = $conn->query($chonmausql);

                                        if ($mauvasoluong->num_rows > 0) {

                                            while($row = $mauvasoluong->fetch_assoc()) {
                                                if ($row['soluong'] > 0) {
                                                    echo "<option value='".$row['maso']."'>".$row['mausac']."</option>";
                                                }
                                            }
                
                                        }
                                    ?>
                                </select>
                                <span style="text-decoration-line: underline; font-size:12px;">(quý khách vui lòng chọn màu để cập nhật số lượng)</span>.
                            </td>
                        </tr>

                        <tr>
                            <td><b>Số lượng:</b></td>

                            <td>
                                <input id="soluong" name="soluong" style="width:90px;" type="number" min="1" max="" value="1">
                            </td>
                        </tr>

                    </table><br>

                    <!-- nut them vao gio hang -->
                    <?php
                        if (!isset($_SESSION['current_user'])) {
                            echo "<a href='login.php' class='btn btn-warning btn-outline-danger btn-block'>Đăng nhập để mua hàng</a>";
                        } else {
                            echo "<input type='submit' class='btn btn-danger btn-block' value='Thêm vào giỏ hàng'><br>";
                        }
                    ?>
                </form>

                    <h4><b>Thông số kỹ thuật:</b></h4>
                    
                    <table border="1" class="bg-white">
                        <tr>
                            <td class="bg-dark text-white"><b>Màn hình</b></td>
                            <td><?php echo $product['manhinh']; ?></td>
                        </tr>
                        <tr>
                            <td class="bg-dark text-white"><b>Camera sau</b></td>
                            <td><?php echo $product['camsau']; ?></td>
                        </tr>
                        <tr>
                            <td class="bg-dark text-white"><b>Camera Selfie</b></td>
                            <td><?php echo $product['camtruoc']; ?></td>
                        </tr>
                        <tr>
                            <td class="bg-dark text-white"><b>RAM</b></td>
                            <td><?php echo $product['ram']; ?></td>
                        </tr>
                        <tr>
                            <td class="bg-dark text-white"><b>Bộ nhớ trong</b></td>
                            <td><?php echo $product['bonhotrong']; ?></td>
                        </tr>
                        <tr>
                            <td class="bg-dark text-white"><b>CPU</b></td>
                            <td><?php echo $product['cpu']; ?></td>
                        </tr>
                        <tr>
                            <td class="bg-dark text-white"><b>GPU</b></td>
                            <td><?php echo $product['gpu']; ?></td>
                        </tr>
                        <tr>
                            <td class="bg-dark text-white"><b>Dung lượng pin</b></td>
                            <td><?php echo $product['dlpin']; ?></td>
                        </tr>
                    </table>
            </div>
    </div>

    <div class="container">
        <br><h4><b>Mô tả sản phẩm:</b></h4>
        <p><?php echo $product['baiviet']; ?></p>
    </div>
</div>

<?php include "footer.php"; ?>