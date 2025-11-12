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
                                            <h3 class="card-title" style="margin-top: 20px;">Thanh Toán Trả Phòng</h3>
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
                                                    <th>Hành Động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="danhsach">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT * FROM booking ORDER BY id DESC ");
                                                $i = 1;
                                                while ($row = mysqli_fetch_array($result)) {
                                                    if ($row['status'] == 3) {
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
                                                                
                                                                <p><b>Thời gian còn lại: </b>
                                                                    <?php
                                                                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                                    $checkInDate = strtotime($row['date-in']);
                                                                    $currentTime = time();

                                                                    if ($checkInDate !== false) {
                                                                        if ($currentTime >= $checkInDate) {
                                                                            $daysPassed = floor(($currentTime - $checkInDate) / (60 * 60 * 24));
                                                                            $daysLeft = $row['nights'] - $daysPassed;

                                                                            if ($daysLeft > 0) {
                                                                                echo '<span class="btn btn-inverse-success btn-fw tags">Còn lại ' . $daysLeft . ' ngày</span>';
                                                                            } else {
                                                                                echo '<span class="btn btn-inverse-warning btn-fw tags">Quá hạn ' . abs($daysLeft) . ' ngày</span>';
                                                                            }
                                                                        } else {
                                                                            echo '<span class="btn btn-inverse-danger btn-fw tags">Chưa đến ngày vào</span>';
                                                                        }
                                                                    } else {
                                                                        echo '<span class="btn btn-inverse-danger btn-fw tags">Ngày không hợp lệ</span>';
                                                                    }
                                                                    ?>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <button style="margin-bottom: 15px;" type="button" data-booking-id="<?php echo $row['id']; ?>" data-thanhtoan-total="<?php echo $row['total']; ?>" class="btn btn-success btn-sm btn-icon-text mr-3 btnXacNhanThanhToan">
                                                                    <i class="typcn typcn-tick-outline btn-icon-append"></i> Xác Nhận Thanh Toán
                                                                </button><br>
                                                                <button name="delete-btn" id="delete-btn" data-booking-id="<?php echo $row['id']; ?>" type="button" class="btn btn-danger btn-sm btn-icon-text btnHuy">
                                                                    <i class="typcn typcn-times-outline btn-icon-append"></i> Hủy Đặt Phòng
                                                                </button>
                                                            </td>
                                                        </tr>

                                                <?php $i++;
                                                    }
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
                $.post('xuly/timkiem-xacnhanthanhtoan.php', {
                    data: txt
                }, function(data) {
                    $('.danhsach').html(data);
                })
            });

            // Cập nhật tình trạng 
            $(document).ready(function() {
                $(".btnXacNhanThanhToan").click(function() {
                    var bookingId = $(this).data("booking-id");
                    var thanhToan = $(this).data("thanhtoan-total");
                    var clickedBtn = $(this);

                    var confirmation = confirm("Bạn muốn xác nhận thanh toán?");

                    if (confirmation) {
                        $.ajax({
                            type: "POST",
                            url: "xuly/update-statusThanhToan.php",
                            data: {
                                bookingId: bookingId,
                                status: 4,
                                thanhToan: thanhToan
                            },
                            success: function(response) {
                                if (response === "success") {
                                    location.reload();
                                } else {
                                    alert("Xác nhận không thành công!");
                                }
                            }
                        });
                    }
                });
            });
            $(document).ready(function() {
                $(".btnHuy").click(function() {
                    var bookingId = $(this).data("booking-id");
                    var clickedBtn = $(this);

                    var confirmation = confirm("Bạn muốn hủy đặt phòng?");

                    if (confirmation) {
                        $.ajax({
                            type: "POST",
                            url: "xuly/update-status.php",
                            data: {
                                bookingId: bookingId,
                                status: 2
                            },
                            success: function(response) {
                                if (response === "success") {
                                    location.reload();
                                } else {
                                    alert("Hủy đặt phòng không thành công!");
                                }
                            }
                        });
                    }
                });
            });
        </script>

        <?php
        mysqli_close($conn);
        include "footer.php" ?>
</body>

</html>