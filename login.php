<?php
    include "header.php";
 ?>

        <div class="container">

            <?php
                if (empty($_SESSION['current_user'])) {
            ?>

            <br><fieldset>

                <legend>Đăng nhập</legend>

                <form method="POST" action="login.php?action=login" autocomplete="off">
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
                                <input class="form-control" type="password" name="password">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><br><input class="btn btn-info btn-block" type="submit" name="dangnhap" value="Đăng nhập"></td>
                        </tr>
                    </table>
                </form>
            </fieldset>

            <?php }

                if (isset($_POST['dangnhap']) && $_POST['dangnhap'] == 'Đăng nhập') {

                    if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
                        $sql = "SELECT * FROM users WHERE username = '".$_POST['username']."' AND password = '".$_POST['password']."';";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $_SESSION['current_user'] = mysqli_fetch_assoc($result);

                            if ($_SESSION['current_user']['role'] == 'admin') {
                                echo "<p>Đăng nhập thành công! <a href='admin.php' style='color: red;'>Xác nhận.</a></p>";
                            } else {
                                echo "<p>Đăng nhập thành công! <a href='index.php' style='color: red;'>Xác nhận.</a></p>";
                            }
                        } else {
                            echo "<p>Đăng nhập không thành công! Tài khoản hoặc mật khẩu không chính xác!</p>";
                        }

                    } else {
                        echo "<p style='color: red;'>Tên đăng nhập hoặc mật khẩu không được để trống!</p>";
                    }
                }
            ?>

        </div>

<?php include "footer.php"; ?>