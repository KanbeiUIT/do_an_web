<?php include "header.php"; ?>

<div class="container">
    <h4><b>Danh sách tài khoản khách hàng</b></h4><br>

    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th><b>Username</b></th>
                <th><b>Họ và tên</b></th>
                <th><b>Điện thoại</b></th>
                <th><b>Địa chỉ</b></th>
            </tr>
        </thead>

        <tbody>
            <?php
                $laythongtinkhach = "SELECT * FROM users WHERE role='customer';";

                $result = $conn->query($laythongtinkhach);

                if ($result->num_rows > 0) {

                    while($row = $result->fetch_assoc()) {

                        echo "<tr>";
                        echo "<td><b>".$row['username']."</b></td>";
                        echo "<td><b>".$row['hoten']."</b></td>";
                        echo "<td><b>".$row['dienthoai']."</b></td>";
                        echo "<td><b>".$row['diachi']."</b></td>";
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>
</div>

<?php include "footer.php"; ?>