<?php include "header.php"; ?>

        <div class="container">

            <br><fieldset>

                <legend>Đăng ký tài khoản khách hàng</legend>

                <form method="POST" action="signin.php?action=reg" autocomplete="off">
                    <table border="0" cellspacing="0">
                        <tr>
                            <td>Tài khoản:</td>
                            <td>
                                <input class="form-control" type="text" name="username">
                            </td>
                        </tr>
                        <tr>
                            <td>Mật khẩu:</td>
                            <td>
                                <input class="form-control" type="password" name="password1">
                            </td>
                        </tr>
                        <tr>
                            <td>Nhập lại mật khẩu:</td>
                            <td>
                                <input class="form-control" type="password" name="password2">
                            </td>
                        </tr>
                        <tr>
                            <td>Họ tên:</td>
                            <td>
                                <input class="form-control" type="text" name="hoten">
                            </td>
                        </tr>
                        <tr>
                            <td>Điện thoại:</td>
                            <td>
                                <input class="form-control" type="text" name="dienthoai">
                            </td>
                        </tr>
                        <tr>
                            <td>Địa chỉ:</td>
                            <td>
                                <input class="form-control" type="text" name="diachi">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><br><input class="btn btn-primary btn-block" type="submit" value="Đăng ký">
                        </tr>
                    </table>
                </form>

            </fieldset>

            <?php
            
                $error = false;

                if (isset($_GET['action']) && $_GET['action'] = 'reg') {
                        if (!empty($_POST['username']) && !empty($_POST['password1']) && !empty($_POST['password2'])) {
                            if ($_POST['password1'] == $_POST['password2']) {
                                $username = $_POST['username'];
                                $password = $_POST['password1'];
                                $hoten = $_POST['hoten'];
                                $dienthoai = $_POST['dienthoai'];
                                $diachi = $_POST['diachi'];
                                $role = "customer";
        
                                $themClientSQL = "INSERT INTO users VALUES('$username','$password','$hoten', '$dienthoai', '$diachi','$role')";
        
                                if ($conn->query($themClientSQL) === TRUE) {
                                    echo "<br><p>Đăng ký tài khoản khách hàng thành công! Mời bạn <a style='color: red;' href='login.php'>đăng nhập</a>.</p>";
                                } else {
                                    echo "<br><p>Đăng ký tài khoản khách hàng không thành công!</p>".$conn->error;
                                }

                            } else {
                                echo "<br><p>Nhâp lại mật khẩu không đúng!</p>";
                            }
    
                        } else {
                            echo "<br><p>Username và Password không được để trống!</p>";
                        }
                }
            ?>

        </div>

<?php include "footer.php"; ?>