<?php
    session_start();
    include "connect.php";
?>

<!DOCTYPE html>
<html lang="vi">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- import boostrap4 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

        <link rel="stylesheet" href="style.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- tieu de trang web -->
        <title>DQT SHOP - Chuyên về iPhone</title>
        <link rel="shortcut icon" href="assets/icon.png">

        <script>
            $(document).ready(function() {

                // ajax thay doi mau sac tu detail.php:
                $("#chonmau").change(function(){
                    let masp = $(this).attr("masp");
                    let maso = $(this).val();
                    $.get("ajax_chonslvamau.php?masp="+masp+"&maso="+maso, function(data,status){
                        $("#soluong").val(1);
                        $("#soluong").attr("max",data);
                    });
                });

                //ajax thay doi so luong mua trong gio hang:
                $(".soluongmua").change(function(){
                    let masp = $(this).parent().parent().attr("masp");
                    let masosp = $(this).attr("masosp");
                    let slmua = $(this).val();

                    $.get("ajax_thaydoislmua.php?masp="+masp+"&masosp="+masosp+"&slmua="+slmua, function(data,status){
                    });
                });

                //ajax cap nhat don hang - admin:
                $(".updategiaohangdh").change(function(){
                    let madh = $(this).attr("madh");
                    let giaohang = $(this).val();

                    $.get("ajaxthaydoigiaohang.php?madh="+madh+"&giaohang="+giaohang, function(data,status){
                    });
                });

                //ajax quan ly so luong - chon san pham --> lay thong tin mau + so luong:
                $("#qlsl_chonsp").change(function(){
                    let masp = $(this).val();

                    $.get("ajax_laymauvasl.php?masp="+masp, function(data,status){
                        $("#quanlyslsp_mausac").html(data);
                    });
                });

                //ajax quan ly so luong - thay doi mau sac --> lay thong so luong --> :
                $("#quanlyslsp_mausac").change(function(){
                    let maso = $(this).val();
                    let masp = $("#qlsl_chonsp").val();

                    $.get("ajax_laysltumasovamasp.php?maso="+maso+"&masp="+masp, function(data,status){
                        $("#quanlyslsp_soluong").val(data);
                    });
                });

                //ajax thay doi so luong san pham
                $("#quanlyslsp_soluong").change(function(){
                    let soluong = $(this).val();
                    let maso = $("#quanlyslsp_mausac").val();

                    $.get("ajax_thaydoislsp.php?soluong="+soluong+"&maso="+maso, function(data,status){
                    });
                });
            });
        </script>

    </head>

    <!-- open body part -->
    <body  class="d-flex flex-column min-vh-100 w3-pale-yellow ">

        <header>

            <!-- navbar -->
            <nav class="navbar navbar-expand-xl w3-lime w3-text-dark-grey mb-4">
                <div class="container">

                    <a class="navbar-brand" href="<?php if (!empty($_SESSION['current_user']) && $_SESSION['current_user']['role'] == 'admin') {
                        echo "admin.php";
                    } else {
                        echo "index.php";
                    } ?>">
                        <img src="assets/logo.png" alt="Logo" style="width:250px;">
                    </a>

                    <ul class="navbar-nav">

                        <?php if (empty($_SESSION['current_user'])) { ?>

                            <li class="nav-item">
                                <a class="btn btn-warning nav-link" href="signin.php"><i class='fas fa-address-card'></i> Đăng ký</a>
                            </li>

                            <li class="nav-item">
                                <a class="btn btn-warning nav-link" href="login.php"><i class='fas fa-user-alt'></i> Đăng nhập</a>
                            </li>

                        <?php } else if ($_SESSION['current_user']['role'] == 'customer') { ?>

                            <li class="nav-item">
                                <span class="nav-link">Xin chào <strong><?php echo $_SESSION['current_user']['hoten']; ?></strong></span>
                            </li>

                            <li class="nav-item">
                                <a class="btn btn-danger nav-link" href="logout.php"><i class='fas fa-door-open'></i> Đăng xuất</a>
                            </li>

                            <li class="nav-item">
                                <a class="btn btn-info nav-link" href="thongtintaikhoan.php">
                                    <i class='fas fa-info-circle'></i> Thông tin tài khoản
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="btn btn-success nav-link" href="xemdonhang.php">
                                    <i class='fas fa-eye'></i> Xem đơn hàng
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="btn btn-primary nav-link" href="giohang.php">
                                    <i class='fas fa-shopping-cart'></i> Xem giỏ hàng
                                </a>
                            </li>

                        <?php } else if ($_SESSION['current_user']['role'] == 'admin') { ?>

                            <li class="nav-item">
                                <a class="btn btn-info nav-link" href="admin_quanlysanpham.php"><i class='fas fa-chart-bar'></i> Quản lý sản phẩm</a>
                            </li>

                            <li class="nav-item">
                                <a class="btn btn-success nav-link" href="admin_quanlytaikhoan.php"><i class='fas fa-address-book'></i> Thông tin khách hàng</a>
                            </li>

                            <li class="nav-item">
                                <a class="btn btn-primary nav-link" href="admin_quanlyhoadon.php"><i class='fas fa-clipboard'></i> Quản lý hóa đơn</a>
                            </li>

                            <li class="nav-item">
                                <a class="btn btn-danger nav-link" href="logout.php"><i class='fas fa-door-open'></i> Đăng xuất</a>
                            </li>

                        <?php } ?>

                    </ul>

                </div>
            </nav>

        </header>