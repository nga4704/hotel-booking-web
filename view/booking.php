<!DOCTYPE html>
<html lang="zxx">

<head>
    <link rel="stylesheet" href="css/form-booking.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <?php include("header.php");
    $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
    include("connect.php");

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $kq = mysqli_query($conn, "SELECT * FROM room WHERE id=$id");
        $row = mysqli_fetch_assoc($kq);
    }
    $error = false;
    $success = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['booking'])) {
            $id = $_POST['id'];
            $kq = mysqli_query($conn, "SELECT * FROM room WHERE id=$id");
            $row = mysqli_fetch_assoc($kq);
            if (empty($_POST['name'])) {
                $error = "Fullname in is empty";
            } elseif (empty($_POST['phone'])) {
                $error = "Numberphone in is empty";
            }elseif (empty($_POST['email'])) {
                $error = "Email in is empty";
            } elseif (empty($_POST['date-in'])) {
                $error = "Date in is empty";
            } elseif (empty($_POST['date-out'])) {
                $error = "Date out is empty.";
            } elseif (empty($_POST['quantity'])) {
                $error = "Quantity is empty.";
            }

            if ($error === false) {
                $quantity = $_POST['quantity'];
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $price = $_POST['price'];
                $address = $_POST['address'];
                $idRoom = $id;
                $idUser = $_SESSION['idUser'];
                $nights = $_POST['nights'];
                $total = $_POST['total'];
                $dateIn = isset($_POST['date-in']) ? $_POST['date-in'] : '';
                $dateOut = isset($_POST['date-out']) ? $_POST['date-out'] : '';

                // Sửa câu truy vấn SQL để chứa giá trị nights và total
                $sql = "INSERT INTO booking (name, phone, email, address, idUser, idRoom, quantity, `date-in`, `date-out`, nights, total,status, timeBooking,price) VALUES ('$name', '$phone','$email', '$address', $idUser, $idRoom, $quantity, '$dateIn', '$dateOut', $nights, $total,1, " . time() .",$price)";
                $insertBooking = mysqli_query($conn, $sql);

                if ($insertBooking) {
                    $success = "Đặt phòng thành công.";
                } else {
                    $error = "Lỗi khi thực hiện đặt phòng: " . mysqli_error($conn);
                }
            }
        }
    }

    ?>

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Booking</h2>
                        <div class="bt-option">
                            <a href="./index.html">Home</a>
                            <a href="./rooms.html">Rooms</a>
                            <a href="./room-details.php">Room Details</a>
                            <span>Booking</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Room Booking Section Begin -->
    <section class="room-booking-section">
        <div class="container">
            <?php if (!empty($error)) { ?>
                <div id="notify-msg" class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php } elseif (!empty($success)) { ?>
                <div id="notify-msg" class="alert alert-success" role="alert">
                    <?php echo $success; ?> <a href="room-booked.php"> Phòng đã đặt</a>
                </div>
            <?php } ?>

            <div class="row">
                <div class="col-lg-8">
                    <div class="room-booking-item" style="margin-bottom: 60px;">
                        <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="../uploads/room/<?php echo $row['image'] ?>" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="../uploads/room/<?php echo $row['image'] ?>" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="../uploads/room/<?php echo $row['image'] ?>" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="rd-text">
                            <div class="rd-title">
                                <h3><?php echo $row['name'] ?></h3>

                            </div>
                            <h2>$<?php echo $row['price'] ?><span>/Pernight</span></h2>

                        </div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="room-booking" style="margin-top: -40px;">
                        <h3>Your Reservation</h3>
                        <form action="booking.php" method="POST" novalidate="novalidate">
                            <div class="input-num">
                                <label for="name">Fullname:</label>
                                <input type="text" id="name" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
                            </div>
                            <div class="input-num">
                                <label for="phone">Numberphone:</label>
                                <input type="text" id="phone" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
                            </div>
                            <div class="input-num">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
                            </div>
                            <div class="input-num">
                                <label for="address">Address:</label>
                                <input type="text" id="address" name="address" value="<?php echo isset($address) ? $address : ''; ?>">
                            </div>
                            <div class="check-date">
                                <label for="date-in">Check In:</label>
                                <input type="text" class="date-input" id="date-in" name="date-in" value="<?php echo isset($dateIn) ? $dateIn : ''; ?>">
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="check-date">
                                <label for="date-out">Check Out:</label>
                                <input type="text" class="date-input" id="date-out" name="date-out" value="<?php echo isset($dateOut) ? $dateOut : ''; ?>">
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="input-num">
                                <label for="quantity">Quantity:</label>
                                <input type="number" id="quantity" name="quantity" value="<?php echo isset($quantity) ? $quantity : ''; ?>">
                            </div>
                            <div class="input-num">
                                <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
                            </div>
                            <div class="input-num">
                                <input type="hidden" id="price" name="price" value="<?php echo $row['price'] ?>">
                            </div>
                            <div class="input-num">
                                <input type="hidden" id="booking" name="booking">
                            </div>
                            <!-- <div class="input-text">
                                <label for="note">Note:</label>
                                <textarea id="note" name="note" value="<?php echo isset($note) ? $note : ''; ?>"></textarea>
                            </div> -->
                            <div>Day of nights: <span id="total-nights">0 nights</span></div>
                            <div>Total: <span id="total-amount">$0</span></div>
                            <div class="input-num">
                                <input type="hidden" id="total-nights-hidden" name="nights">
                                <input type="hidden" id="total-amount-hidden" name="total">
                            </div>
                            <!-- <button type="submit" class="book-btn">Booking</button> -->
                            <div class="btn-form" style="margin-top: -20px;">
                                <!-- <input type="submit" value="Check available" class="book-btn" id="check"> -->
                                <input type="submit" value="Booking" class="book-btn" id="btnBooking" name="booking">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Room Booking Section End -->
    <script>
        $(document).ready(function() {
            // Hàm kiểm tra trạng thái nhập liệu
            function checkInputs() {
                var dateIn = $("#date-in").val();
                var dateOut = $("#date-out").val();
                var quantity = $("#quantity").val();

                if (dateIn !== "" && dateOut !== "" && quantity !== "") {
                    return true;
                } else {
                    return false;
                }
            }

            // Hàm tính toán và cập nhật số ngày ở và tổng tiền
            function calculate() {
                var dateIn = new Date($("#date-in").val());
                var dateOut = new Date($("#date-out").val());
                var oneDay = 24 * 60 * 60 * 1000; // Số mili giây trong một ngày

                var diffDays = Math.round(Math.abs((dateOut - dateIn) / oneDay));
                var pricePerNight = <?php echo $row['price']; ?>; // Giá tiền mỗi đêm từ PHP
                var quantity = parseInt($("#quantity").val());

                if (!isNaN(diffDays) && !isNaN(pricePerNight) && !isNaN(quantity)) {
                    var totalAmount = diffDays * pricePerNight * quantity;

                    $("#total-nights").text(diffDays + " nights");
                    $("#total-amount").text("$" + totalAmount);
                    $("#total-nights-hidden").val(diffDays);
                    $("#total-amount-hidden").val(totalAmount);
                }
            }

            // Lắng nghe sự kiện khi input thay đổi
            $("#date-in, #date-out, #quantity").on("change input", function() {
                if (checkInputs()) {
                    calculate(); // Nếu tất cả các trường input đã được nhập, tính toán và hiển thị kết quả
                }
            });

            // ... (phần xử lý khác của mã JavaScript của bạn)
        });
    </script>

    <?php
    mysqli_close($conn);
    include "footer.php"; ?>
</body>

</html>