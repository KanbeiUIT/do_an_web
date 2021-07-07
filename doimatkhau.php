<?php include "header.php"; ?>

<div class="container">

    <br><fieldset>

        <legend>Thay đổi mật khẩu</legend>

        <form method="POST" action="doimatkhau.php?action=submit">

            <table border="0" cellspacing="0">

                <tr>
                    <td><b>Mật khẩu mới:</b></td>
                    <td><input class="form-control" type="password" name="matkhau1" autocomplete="off"></td>
                </tr>

                <tr>
                    <td><b>Nhập lại mật khẩu mới:</b></td>
                    <td><input class="form-control" type="password" name="matkhau2" autocomplete="off"></td>
                </tr>

            </table>

            <br><br><input class="btn btn-danger" type="submit" value="Xác nhận">

        </form>

        <?php

            if (isset($_GET['action'])) {
                if (isset($_POST['matkhau1']) && isset($_POST['matkhau2']) && $_POST['matkhau1'] != "" && $_POST['matkhau2'] != "") {
                    if ($_POST['matkhau1'] == $_POST['matkhau2']) {
                        $doimatkhausql = "UPDATE users SET password = '".$_POST['matkhau2']."' WHERE username = '".$_SESSION['current_user']['username']."';";

                        if ($conn->query($doimatkhausql) === TRUE) {
                            if ($_SESSION['current_user']['role'] == "admin") {
                                echo "<br><p>Đổi mật khẩu thành công!</p><p>Quay về <a style='color: red;' href='admin.php'>trang chủ</a></p>";
                            } else {
                                echo "<br><p>Đổi mật khẩu thành công!</p><p>Quay về <a style='color: red;' href='index.php'>trang chủ</a></p>";
                            }
                        } else {
                            echo "<p style='color: red;'>Đổi mật khẩu không thành công!</p>";
                        }

                    } else {
                        echo "<p style='color: red;'>Nhập lại mật khẩu không đúng!</p>";
                    }

                } else {
                    echo "<p style='color: red;'>Không được để trống!</p>";
                }
            }

        ?>

    </fieldset>

</div>

<?php include "footer.php"; ?>