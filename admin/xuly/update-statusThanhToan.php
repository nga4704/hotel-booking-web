<?php
include "../connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['bookingId']) && isset($_POST['status']) && isset($_POST['thanhToan'])) {
        $bookingId = $_POST['bookingId'];
        $statusBooking = $_POST['status'];
        $thanhToan = $_POST['thanhToan'];

        $resultXacNhanThanhToan = mysqli_query($conn, "UPDATE booking SET status = $statusBooking, thanhToan = $thanhToan WHERE id = $bookingId");

        if ($resultXacNhanThanhToan) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "error";
    } 
} else {
    echo "error";
}
mysqli_close($conn);
