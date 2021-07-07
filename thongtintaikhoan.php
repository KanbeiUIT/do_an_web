<?php
    include "header.php";

    // lay thong tin dang nhap lai
    $dangnhaplaisql = "SELECT * FROM users WHERE username = '".$_SESSION['current_user']['username']."';";
    $dangnhaplai = $conn->query($dangnhaplaisql);
    $taikhoan = $dangnhaplai->fetch_assoc();

    $_SESSION['current_user'] = $taikhoan;
?>

<div class="container">

    <br><fieldset>

        <legend>Thông tin tài khoản</legend>

        <form action="?action=update" method="POST">

            <table border="0" cellspacing="5">

                <tr>
                    <td><b>Username:</b></td>
                    <td><input class="form-control" disabled="disabled" type="text" value="<?php echo $_SESSION['current_user']['username'] ?>"></td>
                <tr>

                <tr>
                    <td><b>Họ và tên:</b></td>
                    <td><input class="form-control" name="hoten" type="text" value="<?php echo $_SESSION['current_user']['hoten'] ?>"></td>
                <tr>

                <tr>
                    <td><b>Điện thoại:</b></td>
                    <td><input class="form-control" name="dienthoai" type="text" value="<?php echo $_SESSION['current_user']['dienthoai'] ?>"></td>
                <tr>

                <tr>
                    <td><b>Địa chỉ:</b></td>
                    <td><input class="form-control" name="diachi" type="text" value="<?php echo $_SESSION['current_user']['diachi'] ?>"></td>
                <tr>

                <tr><td colspan="2"> </td></tr>

                <tr><td colspan="2"><input type="submit" class="btn btn-info btn-block" value="Cập nhật"></td></tr>

                <tr><td colspan="2"><a href="doimatkhau.php" class="btn btn-danger btn-block">Đổi mật khẩu</a></td></tr>

            </table>

        </form>

    </fieldset>

    <?php
        if (isset($_GET['action']) && $_GET['action'] == "update") {
            $hoten = $_POST['hoten'];
            $dienthoai = $_POST['dienthoai'];
            $diachi = $_POST['diachi'];

            $update = "UPDATE users SET hoten = '".$hoten."', dienthoai = '".$dienthoai."', diachi = '".$diachi."' WHERE username = '".$_SESSION['current_user']['username']."';";

            if ($conn->query($update) === TRUE) {
                echo "<p>Update thành công! <a style='color: red;' href='thongtintaikhoan.php'>Xác nhận.</a></p>";
            } else {
                echo "<p style='color: red;'>Update không thành công!</p>";
            }
        }
    ?>

</div>

<?php include "footer.php"; ?>