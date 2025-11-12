<?php
include "../connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['customerId']) && isset($_POST['status'])) {
        $customerId = $_POST['customerId'];
        $statusCustomer = $_POST['status'];

        $resultUpdateUser = mysqli_query($conn, "UPDATE User SET status = $statusCustomer WHERE id = $customerId");

        if ($resultUpdateUser) {
            echo "success";
        } else {
            echo "error";
        }
    } elseif (isset($_POST['roomId']) && isset($_POST['status'])) {
        $roomId = $_POST['roomId'];
        $statusRoom = $_POST['status'];

        $resultUpdateRoom = mysqli_query($conn, "UPDATE room SET status = $statusRoom WHERE id = $roomId");

        if ($resultUpdateRoom) {
            echo "success";
        } else {
            echo "error";
        }
    } elseif (isset($_POST['serviceId']) && isset($_POST['status'])) {
        $serviceId = $_POST['serviceId'];
        $statusService = $_POST['status'];

        $resultUpdateService = mysqli_query($conn, "UPDATE services SET status = $statusService WHERE id = $serviceId");

        if ($resultUpdateService) {
            echo "success";
        } else {
            echo "error";
        }
    } elseif (isset($_POST['tiennghiId']) && isset($_POST['status'])) {
        $tiennghiId = $_POST['tiennghiId'];
        $statusTiennghi = $_POST['status'];

        $resultUpdateTiennghi = mysqli_query($conn, "UPDATE tiennghi SET status = $statusTiennghi WHERE id = $tiennghiId");

        if ($resultUpdateTiennghi) {
            echo "success";
        } else {
            echo "error";
        }
    }elseif (isset($_POST['blogId']) && isset($_POST['status'])) {
        $blogId = $_POST['blogId'];
        $statusBlog = $_POST['status'];

        $resultUpdateBlog = mysqli_query($conn, "UPDATE blog SET status = $statusBlog WHERE id = $blogId");

        if ($resultUpdateBlog) {
            echo "success";
        } else {
            echo "error";
        }
    }elseif (isset($_POST['bookingId']) && isset($_POST['status'])) {
        $bookingId = $_POST['bookingId'];
        $statusBooking = $_POST['status'];

        $resultUpdateBooking = mysqli_query($conn, "UPDATE booking SET status = $statusBooking WHERE id = $bookingId");

        if ($resultUpdateBooking) {
            echo "success";
        } else {
            echo "error";
        }
    }elseif (isset($_POST['phanhoiId']) && isset($_POST['status'])) {
        $phanhoiId = $_POST['phanhoiId'];
        $statusPhanhoi = $_POST['status'];

        $resultUpdatePhanhoi = mysqli_query($conn, "UPDATE phanhoi SET status = $statusPhanhoi WHERE id = $phanhoiId");

        if ($resultUpdatePhanhoi) {
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
