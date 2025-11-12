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
$idPhong = $_POST['id'];
$star = $_POST['star'];
$noidung = $_POST['noidung'];
$idUser = $_SESSION['idUser'];
$time = time();


// Thực hiện truy vấn SQL
// $ngayDanhGia = date("YmdHis"); // Định dạng thời gian cho MySQL
$sql = "INSERT INTO review (idUser, idRoom, star, content, timePost) 
        VALUES ($idUser , $idPhong, $star, '$noidung', '$time')";
// ... (previous code)

if ($conn->query($sql) === TRUE) {
    echo "Thanh cong";

    $kq1 = mysqli_query($conn, "SELECT count(id) as total FROM review WHERE idRoom=" . $idPhong);
    $row1 = mysqli_fetch_assoc($kq1);
    $soDanhGia = $row1['total']; // Corrected $row1['$kq1'] to $row1['total']

    $kq2 = mysqli_query($conn, "SELECT star FROM review WHERE idRoom=" . $idPhong);
    $tongSoSao = 0;

    while ($row6 = mysqli_fetch_assoc($kq2)) {
        $tongSoSao += $row6['star'];
    }

    $soSao = $tongSoSao / $soDanhGia;

    // Update the 'room' table with the calculated average star rating
    $updateQuery = "UPDATE room SET star = $soSao WHERE id = $idPhong";
    if ($conn->query($updateQuery) === TRUE) {
        echo "Star rating updated successfully in room table";
    } else {
        echo "Error updating star rating: " . $conn->error;
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>