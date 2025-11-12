<?php
session_start();
// Kết nối CSDL và thực hiện truy vấn
include("connect.php"); // Đảm bảo file connect.php chứa thông tin kết nối đến MySQL

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set('Asia/Ho_Chi_Minh'); // Đặt timezone thành Asia/Ho_Chi_Minh
// Lấy dữ liệu gửi từ AJAX
$idBlog = $_POST['id'];
$message = $_POST['message'];
$idUser = $_SESSION['idUser'];
$time = time();


// Thực hiện truy vấn SQL
// $ngayDanhGia = date("YmdHis"); // Định dạng thời gian cho MySQL
$sql = "INSERT INTO comment (idUser, idBlog, message, time) 
        VALUES ($idUser , $idBlog, '$message', '$time')";
// ... (previous code)

if ($conn->query($sql) === TRUE) {
    echo "Thanh cong";

    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>