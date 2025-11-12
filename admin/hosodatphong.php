<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    include "connect.php";

    ?>

    <div class="container-scroller" style="margin-top: -21px;">
        <?php include "header.php" ?>
        <div class="container-fluid page-body-wrapper" style="margin-top: 75px;">
            <?php include "sidebar.php" ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <nav style="margin-top: -20px; background-color: white;" class=" navbar-breadcrumb col-xl-12 col-12 d-flex flex-row p-0">
                                        <div class="navbar-links-wrapper d-flex align-items-stretch">
                                            <h3 class="card-title" style="margin-top: 20px;">Hồ Sơ Đặt Phòng</h3>
                                        </div>
                                        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                                            <ul class="navbar-nav navbar-nav-right">
                                                <li class="nav-item nav-search d-none d-md-block mr-0">
                                                    <div class="input-group" style="border: 1px solid #282f3a;">
                                                        <input type="text" class="form-control timkiem" placeholder="Search..." aria-label="search" aria-describedby="search">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="search">
                                                                <i class="typcn typcn-zoom"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </nav>
                                    <div class="table-responsive">
                                        <table class="table table-striped project-orders-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Thông Tin Khách Hàng</th>
                                                    <th>Thông Tin Phòng</th>
                                                    <th>Thông Tin Đặt Phòng</th>
                                                    <th>Tình Trạng</th>
                                                    <th>Hành Động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="danhsach">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT * FROM booking ORDER BY id DESC ");
                                                $i = 1;
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $result2 = mysqli_query($conn, "SELECT * FROM room WHERE id = " . $row['idRoom']);
                                                    $row2 = mysqli_fetch_assoc($result2);
                                                ?>
                                                    <tr>
                                                        <td style="display: none;"><?php echo $row['id']; ?></td>
                                                        <td><?php echo $i ?></td>
                                                        <td>
                                                            <p><b>Họ tên: </b><?php echo $row['name'] ?></p>
                                                            <p><b>Số điện thoại: </b><?php echo $row['phone'] ?></p>
                                                            <p><b>Email: </b><?php echo $row['email'] ?></p>
                                                        </td>
                                                        <td>
                                                            <p><b>Tên phòng: </b><?php echo $row2['name'] ?></p>
                                                            <p><b>Giá phòng: </b>$<?php echo $row['price'] ?></p>
                                                            <p><b>Số lượng phòng: </b><?php echo $row['quantity'] ?> phòng</p>
                                                            <p><b>Tổng tiền: </b>$<?php echo $row['total'] ?></p>
                                                        </td>
                                                        <td>
                                                            <p><b>Ngày vào: </b><?php echo date("d-m-Y", strtotime($row['date-in'])) ?></p>
                                                            <p><b>Ngày ra: </b><?php echo date("d-m-Y", strtotime($row['date-out'])) ?></p>
                                                            <p><b>Số ngày ở: </b><?php echo $row['nights'] ?> ngày</p>
                                                            <p><b>Thanh toán: </b>$<?php echo $row['thanhToan'] ?></p>
                                                        </td>
                                                        <td><?php
                                                            if ($row['status'] == 1) {
                                                                echo '<span class="btn btn-inverse-info btn-fw tags">Đang Chờ Xác Nhận</span>';
                                                            } elseif ($row['status'] == 2) {
                                                                echo '<span class="btn btn-inverse-danger btn-fw tags">Đã Hủy</span>';
                                                            } elseif ($row['status'] == 3) {
                                                                echo '<span class="btn btn-inverse-success btn-fw tags">Đã Xác Nhận Đặt Phòng</span>';
                                                            } elseif (($row['status'] == 4) || ($row['status'] == 5)) {
                                                                echo '<span class="btn btn-inverse-primary btn-fw tags">Đã Thanh Toán</span>';
                                                            }
                                                            ?></td>
                                                        <td>
                                                            <?php if (($row['status'] == 4) || ($row['status'] == 5)) { ?>
                                                                <form action="hoadon.php" method="POST">
                                                                    <button type="submit" data-booking-id="<?php echo $row['id']; ?>" class="btn btn-primary btn-sm btn-icon-text mr-3 btnInHoaDon">
                                                                        <i class="typcn typcn-upload btn-icon-append"></i> In Hóa Đơn
                                                                    </button>
                                                                    <input type="hidden" name="inHoaDon">
                                                                    <input type="hidden" name="idBooking" value="<?php echo $row['id']; ?>">
                                                                </form>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>

                                                <?php $i++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- content-wrapper ends -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>

        <script>
            // xử lý tìm kiếm
            $('.timkiem').keyup(function() {
                var txt = $('.timkiem').val();
                $.post('xuly/timkiem-hosodatphong.php', {
                    data: txt
                }, function(data) {
                    $('.danhsach').html(data);
                })
            });
        </script>

        <?php
        mysqli_close($conn);
        include "footer.php" ?>
</body>

</html>