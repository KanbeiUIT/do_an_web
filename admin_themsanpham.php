<?php include "header.php"; ?>

<div class="container-fluid">

    <div class="row">

        <div class="col-2">

            <ul class="nav flex-column bg-dark rounded">

                <li style="margin-top:10px; margin-bottom: 10px;" class="nav-item">
                    <a class="nav-link btn btn-dark btn-block text-white" href="admin_quanlysanpham.php"><b>Danh sách sản phẩm</b></a>
                </li>

                <li style="margin-top:10px; margin-bottom: 10px;" class="nav-item">
                    <a class="nav-link btn btn-dark disabled" href=""><b>Thêm sản phẩm</b></a>
                </li>

                <li style="margin-top:10px; margin-bottom: 10px;" class="nav-item">
                <a class="nav-link btn btn-dark" href="admin_quanlyslsp.php"><b>Quản lý số lượng</b></a>
                </li>

            </ul>

        </div>

        <div class="col-10">

            <h3><b>Thêm sản phẩm mới:</b></h3>

            <br><fieldset>

                <legend>Thông tin sản phẩm</legend>
                
                <form method="POST" action="?action=themsp">

                    <table border="0" class="table-hover">
                        <tr>
                            <td>Mã sản phẩm:</td>
                            <td><input class="form-control" type="text" name="masp"></td>
                        </tr>
                        <tr>
                            <td>Tên sản phẩm:</td>
                            <td><input class="form-control" type="text" name="tensp"></td>
                        </tr>
                        <tr>
                            <td>Thứ tự show:</td>
                            <td><input class="form-control" type="text" name="id"></td>
                        </tr>
                        <tr>
                            <td>Hãng sản xuất:</td>
                            <td><input class="form-control" type="text" name="brand"></td>
                        </tr>
                        <tr>
                            <td>Đường dẫn hình ảnh:</td>
                            <td><input class="form-control" type="text" name="image"></td>
                        </tr>
                        <tr>
                            <td>Giá bán:</td>
                            <td><input class="form-control" type="text" name="giaban"></td>
                        </tr>
                        <tr>
                            <td>Giá bán gốc:</td>
                            <td><input class="form-control" type="text" name="giagoc"></td>
                        </tr>
                        <tr>
                            <td>Màn hình:</td>
                            <td><input class="form-control" type="text" name="manhinh"></td>
                        </tr>
                        <tr>
                            <td>RAM:</td>
                            <td><input class="form-control" type="text" name="ram"></td>
                        </tr>
                        <tr>
                            <td>Bộ nhớ trong:</td>
                            <td><input class="form-control" type="text" name="bonhotrong"></td>
                        </tr>
                        <tr>
                            <td>Camera trước:</td>
                            <td><input class="form-control" type="text" name="camtruoc"></td>
                        </tr>
                        <tr>
                            <td>Camera sau:</td>
                            <td><input class="form-control" type="text" name="camsau"></td>
                        </tr>
                        <tr>
                            <td>CPU:</td>
                            <td><input class="form-control" type="text" name="cpu"></td>
                        </tr>
                        <tr>
                            <td>GPU:</td>
                            <td><input class="form-control" type="text" name="gpu"></td>
                        </tr>
                        <tr>
                            <td>Dung lượng pin:</td>
                            <td><input class="form-control" type="text" name="dlpin"></td>
                        </tr>

                        <tr><td colspan="2"><input type="submit" class="btn btn-danger btn-block" value="Thêm"></td></tr>

                    </table>

                
                </form>

                <?php
                    if (isset($_GET['action'])) {
                        if ($_GET['action'] == "themsp") {

                            $themsanphamsql = "INSERT INTO sanpham (masp, id, tensp, brand, image, giaban, giagoc, manhinh, ram, bonhotrong, camtruoc, camsau, cpu, gpu, dlpin) VALUES ('".$_POST['masp']."','".$_POST['id']."','".$_POST['tensp']."','".$_POST['brand']."','".$_POST['image']."','".$_POST['giaban']."','".$_POST['giagoc']."','".$_POST['manhinh']."','".$_POST['ram']."','".$_POST['bonhotrong']."','".$_POST['camtruoc']."','".$_POST['camsau']."','".$_POST['cpu']."','".$_POST['gpu']."','".$_POST['dlpin']."')";
                        
                            if ($conn->query($themsanphamsql) === TRUE) {
                                echo "<p>Thêm sản phẩm mới thành công!</p>";
                            } else {
                                echo "<p>Lỗi! Không thể thêm sản phẩm mới: ".$conn->error."</p>";
                            }
                        }
                    }
                ?>
            
            </fieldset>
        </div>
    </div>

</div>

<?php include "footer.php"; ?>