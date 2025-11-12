<?php
include "../connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['bookingId']) && isset($_POST['status'])) {
        $bookingId = $_POST['bookingId'];
        $statusBooking = $_POST['status'];

        $resultUpdateBooking = mysqli_query($conn, "UPDATE booking SET status = $statusBooking WHERE id = $bookingId");

        if ($resultUpdateBooking) {
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
