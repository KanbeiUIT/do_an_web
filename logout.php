<?php
    include "header.php";

    if (!empty($_SESSION['current_user'])) {
        session_unset();
    }
?>

<div class="container">

    <br><fieldset>
        <legend>Đăng xuất</legend>

        <p>Đăng xuất tài khoản thành công!</p>
        <p>Quay về <a style="color: red;" href="index.php">trang chủ</a>.</p>
    
    </fieldset>

</div>

<?php include "footer.php"; ?>