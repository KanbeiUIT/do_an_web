<?php include "header.php"; ?>

<div class="container-fluid">

    <div class="row">

        <div class="col-2">

            <ul class="nav flex-column bg-dark rounded">

                <li style="margin-top:10px; margin-bottom: 10px;" class="nav-item">
                    <a class="nav-link btn btn-dark btn-block text-white" href="admin_quanlysanpham.php"><b>Danh sách sản phẩm</b></a>
                </li>

                <li style="margin-top:10px; margin-bottom: 10px;" class="nav-item">
                <a class="nav-link btn btn-dark" href="admin_themsanpham.php"><b>Thêm sản phẩm</b></a>
                </li>

                <li style="margin-top:10px; margin-bottom: 10px;" class="nav-item">
                <a class="nav-link btn btn-dark disabled" href="admin_quanlyslsp.php"><b>Quản lý số lượng</b></a>
                </li>

            </ul>

        </div>

        <div class="col-10">

            <h3><b>Quản lý số lượng sản phẩm:</b></h3><br>

            <fieldset>

                <legend>Thông tin sản phẩm</legend>

                <table>

                    <tr>
                        <td><b>Tên sản phẩm:</b></td>
                        <td>
                            <select id="qlsl_chonsp" class="form-control">
                                <?php
                                    $laythongtinsanphamsql = "SELECT * FROM sanpham;";

                                    $laythongtinsanpham = $conn->query($laythongtinsanphamsql);

                                    if ($laythongtinsanpham->num_rows > 0) {

                                        while($row = $laythongtinsanpham->fetch_assoc()) {
                                            echo "<option value='".$row['masp']."'>".$row['tensp']."</option>";
                                        }

                                    }
                                ?>
                            </select>
                        </td>
                    </tr>

                </table>

            </fieldset><br>



            <fieldset>

                <legend>Màu và số lượng</legend>

                <table border="0">
                    <tr>
                        <td><b>Màu sắc</b></td>

                        <td>
                            <select id="quanlyslsp_mausac" class="form-control"></select>
                        </td>
                    </tr>

                    <tr>
                        <td><b>Số lượng</b></td>

                        <td><input id="quanlyslsp_soluong" class="form-control" type="number"></td>
                    </tr>
                </table>

            </fieldset>



        </div>

    </div>
</div>

<?php include "footer.php"; ?>