<?php
include "../connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["customerId"])) {
        $customerId = $_POST["customerId"];

        $deleteCustomerQuery = "DELETE FROM User WHERE id = $customerId";
        $resultDeleteCustomer = mysqli_query($conn, $deleteCustomerQuery);

        if ($resultDeleteCustomer) {
            echo "success"; 
        } else {
            echo "error"; 
        }
    }elseif (isset($_POST["roomId"])) {
        $roomId = $_POST["roomId"];

        $deleteRoomQuery = "DELETE FROM room WHERE id = $roomId";
        $resultDeleteRoom = mysqli_query($conn, $deleteRoomQuery);

        if ($resultDeleteRoom) {
            echo "success"; 
        } else {
            echo "error"; 
        }
    } elseif (isset($_POST["tiennghiId"])) {
        $tiennghiId = $_POST["tiennghiId"];

        $deleteTiennghiQuery = "DELETE FROM tiennghi WHERE id = $tiennghiId";
        $resultDeleteTiennghi = mysqli_query($conn, $deleteTiennghiQuery);

        if ($resultDeleteTiennghi) {
            echo "success"; 
        } else {
            echo "error"; 
        }
    }else if (isset($_POST["reviewId"])) {
        $reviewId = $_POST["reviewId"];

        $deleteReviewQuery = "DELETE FROM review WHERE id = $reviewId";
        $resultDeleteReview = mysqli_query($conn, $deleteReviewQuery);

        if ($resultDeleteReview) {
            echo "success"; 
        } else {
            echo "error"; 
        }
    }elseif (isset($_POST["serviceId"])) {
        $serviceId = $_POST["serviceId"];

        $deleteServiceQuery = "DELETE FROM services WHERE id = $serviceId";
        $resultDeleteService = mysqli_query($conn, $deleteServiceQuery);

        if ($resultDeleteService) {
            echo "success"; 
        } else {
            echo "error"; 
        }
    }elseif (isset($_POST["blogId"])) {
        $blogId = $_POST["blogId"];

        $resultDeleteBlog = mysqli_query($conn, "DELETE FROM blog WHERE id = $blogId");

        if ($resultDeleteBlog) {
            echo "success"; 
        } else {
            echo "error"; 
        }
    }elseif (isset($_POST["slidedId"])) {
        $slidedId = $_POST["slidedId"];

        $resultDeleteSlided = mysqli_query($conn, "DELETE FROM slided WHERE id = $slidedId");

        if ($resultDeleteSlided) {
            echo "success"; 
        } else {
            echo "error"; 
        }
    }elseif (isset($_POST["phanhoiId"])) {
        $phanhoiId = $_POST["phanhoiId"];

        $resultDeletePhanhoi = mysqli_query($conn, "DELETE FROM phanhoi WHERE id = $phanhoiId");

        if ($resultDeletePhanhoi) {
            echo "success"; 
        } else {
            echo "error"; 
        }
    }elseif (isset($_POST["loaiphongId"])) {
        $loaiphongId = $_POST["loaiphongId"];

        $resultDeleteLoaiphong = mysqli_query($conn, "DELETE FROM category_room WHERE id = $loaiphongId");

        if ($resultDeleteLoaiphong) {
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
?>
