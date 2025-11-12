<!DOCTYPE html>
<html lang="zxx">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <?php include("header.php");
    $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
    include "connect.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['btnDanhGia'])) {
            $star = $_POST['star'];
            $content = $_POST['content'];
            $currentTimestamp = time();
            $idUser = $_SESSION['idUser'];
            $statusBooking = 5;
            $bookingId = $_POST['bookingId'];
            $idRoom = $_POST['idRoom'];

            $insertQuery = "INSERT INTO review (idUser, idRoom, star, content, timePost) VALUES ($idUser, $idRoom, $star, '$content', '$currentTimestamp')";
            $updateQuery = "UPDATE booking SET status = $statusBooking WHERE id = $bookingId";

            if ((mysqli_query($conn, $insertQuery)) && (mysqli_query($conn, $updateQuery))) {
                echo '<script language="javascript">';
                echo 'alert("Bạn đã đánh giá thành công!");';
                echo 'window.location.href = "room-booked.php";';
                echo '</script>';
            } else {
                echo '<script language="javascript">alert("Đánh giá không thành công.");</script>';
            }
        } else {
            echo "Invalid request";
        }
    }
    ?>

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Room Booked</h2>
                        <div class="bt-option">
                            <a href="./index.php">Home</a>
                            <span>Room Booked</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- booked Section Begin -->
    <section class="blog-section blog-page spad">
        <div class="container">

            <div class="row">
                <?php
                include("connect.php");
                if (isset($_SESSION['idUser'])) {
                    $idUser = $_SESSION['idUser'];
                    if (isset($_GET['id'])) {
                        $result3 = mysqli_query($conn, "SELECT count(id) as total FROM booking");
                        $row3 = mysqli_fetch_assoc($result3);
                        $total = $row3['total'];
                        $result = mysqli_query($conn, "SELECT * FROM booking WHERE idUser=$idUser  ORDER BY id DESC LIMIT 8,$total");
                    } else {
                        $result = mysqli_query($conn, "SELECT * FROM booking WHERE idUser=$idUser  ORDER BY id DESC LIMIT 8");
                    }

                    while ($row = mysqli_fetch_array($result)) {
                        $result2 = mysqli_query($conn, "SELECT * FROM room WHERE id = " . $row['idRoom']);
                        $row2 = mysqli_fetch_assoc($result2);
                ?>
                        <div class="col-lg-3">
                            <div class="card" style="width: auto;margin-bottom: 30px; padding: 0px;">
                                <div class="card-body">
                                    <img style="min-height: 150px; object-fit: cover; margin-bottom: 10px;" src="../uploads/room/<?php echo $row2['image'] ?>" class="card-img-top" alt="...">
                                    <h4 class="card-title"><?php echo $row2['name'] ?></h4>
                                    <p class="card-text"><small class="text-muted"><b>Đơn giá: </b>$<?php echo $row['price'] ?>/đêm</small></p>
                                    <p class="card-text"><b>Ngày Vào: </b> <?php echo date("d-m-Y", strtotime($row['date-in'])) ?></p>
                                    <p class="card-text"><b>Ngày Trả: </b> <?php echo date("d-m-Y", strtotime($row['date-out'])) ?></p>
                                    <p class="card-text"><b>Số đêm: </b> <?php echo $row['nights'] ?></p>
                                    <p class="card-text"><b>Số phòng: </b> <?php echo $row['quantity'] ?></p>
                                    <p class="card-text"><b>Tổng: </b> $<?php echo $row['total'] ?></p>
                                    <p class="card-text"><b>Ngày đặt: </b> <?php echo date("d-m-Y H:i:s", $row['timeBooking']) ?></p>
                                    <div style="display: block; justify-content: center;">
                                        <?php
                                        if ($row['status'] == 1) { ?>
                                            <span class="span span-info" id="btnChoXacNhan">Đang Chờ Xác Nhận</span>
                                            <button type="button" class="btn btn-danger btn-small btn-huy" id="btnHuy" name="btnHuy" data-booking-id="<?php echo $row['id']; ?>">Hủy Đặt Phòng</button>
                                        <?php   } elseif ($row['status'] == 2) { ?>
                                            <span class="span span-danger" id="btnDaHuy">Đã Hủy Đặt Phòng</span>
                                        <?php   } elseif ($row['status'] == 3) { ?>
                                            <span class="span span-success" id="btnDaDat">Đã Đặt Phòng</span>
                                        <?php   } elseif ($row['status'] == 4) { ?>
                                            <span class="span span-primary" id="btnChoXacNhan">Đã Thanh Toán</span>
                                            <button style="margin-top: 0px;" type="button" class="btn btn-warning btn-small btn-form-danhgia" id="btnFormDanhGia" name="btnFormDanhGia" data-booking-id="<?php echo $row['id']; ?>" data-room-id="<?php echo $row['idRoom']; ?>">Đánh Giá</button>
                                        <?php   } elseif ($row['status'] == 5) { ?>
                                            <span class="span span-primary" id="btnChoXacNhan">Đã Thanh Toán</span>
                                            <span class="span span-warning" id="btnChoXacNhan">Đã Đánh Giá</span>

                                        <?php   }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php  }
                }
                ?>
            </div>
            <?php if (isset($_GET['id'])) {
            ?>
                <div class="col-lg-12">
                    <div class="load-more">
                        <a href="room-booked.php" class="primary-btn">Return</a>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-lg-12">
                    <div class="load-more">
                        <a href="room-booked.php?id=1" class="primary-btn">Load More</a>
                    </div>
                </div>
            <?php } ?>

        </div>
    </section>
    <!-- booked Section End -->
    <div class="overlay" id="overlay"></div>
    <div class="col-lg-4" style="display: none; border-radius: 5px;" id="formDanhGia">
        <div class="room-booking">
            <h3 align="center">Your Review</h3>
            <form action="room-booked.php" method="POST" novalidate="novalidate">
                <div class="select-option">
                    <label for="star">Đánh giá</label>
                    <select name="star">
                        <option value="5">Rất tốt</option>
                        <option value="4">Tốt</option>
                        <option value="3">Tạm ổn</option>
                        <option value="2">Kém</option>
                        <option value="1">Rất kém</option>
                    </select>
                </div>
                <div class="input-text">
                    <label for="content">Nhận xét</label>
                    <textarea id="content" name="content"></textarea>
                </div>
                <input type="hidden" class="btn btn-warning btn-small" id="bookingId" name="bookingId">
                <input type="hidden" class="btn btn-warning btn-small" id="idRoom" name="idRoom">
                <div class="btn-form" style="display: flex; justify-content: space-around;">
                    <input type="submit" value="Submit" class="btn btn-warning btn-small" id="btnDanhGia" name="btnDanhGia">
                    <input value="Cancel" class="btn btn-light btn-small" id="btnCancel">
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(document).on("click", "#btnFormDanhGia", function() {
                var bookingId = $(this).data("booking-id");
                var idRoom = $(this).data("room-id");

                $('#formDanhGia').find("#bookingId").val(bookingId);
                $('#formDanhGia').find("#idRoom").val(idRoom);

                $('.overlay').show();
                $('.overlay').addClass("active");
                $('#formDanhGia').show();
            });
        });
        $('#btnCancel').click(function() {
            $('.overlay').hide();
            $('#formDanhGia').hide();
        });
        $(document).ready(function() {
            $(".btn-huy").click(function() {
                var bookingId = $(this).data("booking-id");
                var clickedBtn = $(this);

                var confirmation = confirm("Bạn có chắc chắn muốn hủy đặt phòng không?");

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
                                alert("Cập nhật trạng thái không thành công!");
                            }
                        }
                    });
                }
            });
        });
    </script>

    <?php
    mysqli_close($conn);
    include("footer.php") ?>
</body>

</html>