<?php
    include "header.php";
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

            <h3><b>Chỉnh sửa thông tin sản phẩm:</b></h3>

            <fieldset>

                <legend>Thông tin sản phẩm</legend>

                <form action="admin_suathongtinsp.php?action=update&masp=<?php echo $_GET['masp']; ?>" method="POST">

                    <table border="0">
                        <?php
                            if (isset($_GET['masp'])) {
                                $laythongtinsp = "SELECT * FROM sanpham WHERE masp = '".$_GET['masp']."';";
                        
                                $result = $conn->query($laythongtinsp);
                        
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                        
                                    echo "<tr>";
                                    echo "<td><b>STT:</b></td>";
                                    echo "<td><input name='id' class='form-control' type='number' value='".$row['id']."'></td>";
                                    echo "</tr>";

                                    echo "<tr>";
                                    echo "<td><b>Mã:</b></td>";
                                    echo "<td><input name='masp' class='form-control' type='text' value='".$row['masp']."'></td>";
                                    echo "</tr>";

                                    echo "<tr>";
                                    echo "<td><b>Tên sản phẩm:</b></td>";
                                    echo "<td><input name='tensp' class='form-control' type='text' value='".$row['tensp']."'></td>";
                                    echo "</tr>";

                                    echo "<tr>";
                                    echo "<td><b>Hãng sản xuất:</b></td>";
                                    echo "<td><input name='brand' class='form-control' type='text' value='".$row['brand']."'></td>";
                                    echo "</tr>";

                                    // echo "<tr>";
                                    // echo "<td><b>Đường dẫn hỉnh ảnh:</b></td>";
                                    // echo "<td><input name='image' class='form-control' type='text' value='".$row['image']."'></td>";
                                    // echo "</tr>";

                                    echo "<tr>";
                                    echo "<td><b>Giá bán:</b></td>";
                                    echo "<td><input name='giaban' class='form-control' type='text' value='".$row['giaban']."'></td>";
                                    echo "</tr>";

                                    echo "<tr>";
                                    echo "<td><b>Màn hình:</b></td>";
                                    echo "<td><input name='manhinh' class='form-control' type='text' value='".$row['manhinh']."'></td>";
                                    echo "</tr>";

                                    echo "<tr>";
                                    echo "<td><b>RAM:</b></td>";
                                    echo "<td><input name='ram' class='form-control' type='text' value='".$row['ram']."'></td>";
                                    echo "</tr>";

                                    echo "<tr>";
                                    echo "<td><b>Bộ nhớ trong:</b></td>";
                                    echo "<td><input name='bonhotrong' class='form-control' type='text' value='".$row['bonhotrong']."'></td>";
                                    echo "</tr>";

                                    echo "<tr>";
                                    echo "<td><b>Cam trước:</b></td>";
                                    echo "<td><input name='camtruoc' class='form-control' type='text' value='".$row['camtruoc']."'></td>";
                                    echo "</tr>";

                                    echo "<tr>";
                                    echo "<td><b>Cam sau:</b></td>";
                                    echo "<td><input name='camsau' class='form-control' type='text' value='".$row['camsau']."'></td>";
                                    echo "</tr>";

                                    echo "<tr>";
                                    echo "<td><b>CPU:</b></td>";
                                    echo "<td><input name='cpu' class='form-control' type='text' value='".$row['cpu']."'></td>";
                                    echo "</tr>";

                                    echo "<tr>";
                                    echo "<td><b>GPU:</b></td>";
                                    echo "<td><input name='gpu' class='form-control' type='text' value='".$row['gpu']."'></td>";
                                    echo "</tr>";

                                    echo "<tr>";
                                    echo "<td><b>Pin:</b></td>";
                                    echo "<td><input name='dlpin' class='form-control' type='text' value='".$row['dlpin']."'></td>";
                                    echo "</tr>";
                                }
                            }
                        ?>

                        <tr>
                            <td colspan="2"><input type="submit" value="Thay đổi" class="btn btn-danger btn-block"></td>
                        </tr>

                    </table>

                </form>

                <?php
                    if (isset($_GET['action'])) {
                        if ($_GET['action'] == 'update') {
                            $updatespsql = "UPDATE sanpham SET id='".$_POST['id']."', tensp='".$_POST['tensp']."', brand='".$_POST['brand']."', giaban='".$_POST['giaban']."', manhinh='".$_POST['manhinh']."', ram='".$_POST['ram']."', bonhotrong='".$_POST['bonhotrong']."', camtruoc='".$_POST['camtruoc']."', camsau='".$_POST['camsau']."', cpu='".$_POST['cpu']."', gpu='".$_POST['gpu']."', dlpin='".$_POST['dlpin']."' WHERE masp='".$_POST['masp']."';";
                        
                            $conn->query($updatespsql);
                        }
                    }
                ?>

            </fieldset>
        </div>

    </div>

</div>

<?php include "footer.php"; ?>