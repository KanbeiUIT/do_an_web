<?php include "header.php"; ?>

<div class="container">
    <h3><b>Trang quản lý - Quản trị viên</b></h3>

    <br><fieldset>

                <legend>Tài khoản quản lý: <b><?php echo $_SESSION['current_user']['username']; ?> - <?php echo $_SESSION['current_user']['hoten']; ?></b></legend>

                <br><a href="thongtintaikhoan.php" class="btn btn-info">Xem thông tin tài khoản</a>
    </fieldset>
</div>

<?php include "footer.php"; ?>