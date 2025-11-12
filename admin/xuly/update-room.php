<?php
// Kết nối đến cơ sở dữ liệu
include "../connect.php";

// Kiểm tra nếu có dữ liệu gửi đến từ AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['roomId'])) {
    // Nhận dữ liệu từ AJAX
    $roomId = $_POST['roomId'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $adult = $_POST['adult'];
    $size = $_POST['size'];
    $quantity = $_POST['quantity'];
    $children = $_POST['children'];
    $bed = $_POST['bed'];
    $loaiphong = $_POST['loaiphong'];

    // Câu lệnh SQL để cập nhật thông tin phòng trong cơ sở dữ liệu
    $sql = "UPDATE room SET name='$name', price='$price', adult='$adult', size='$size', quantity='$quantity', children='$children', detail='$detail', bed='$bed', loaiphong='$loaiphong' WHERE id=$roomId";

    // Thực thi câu lệnh SQL
    if (mysqli_query($conn, $sql)) {
        echo "success"; // Trả về thông báo thành công nếu cập nhật thành công
    } else {
        echo "error"; // Trả về thông báo lỗi nếu cập nhật không thành công
    }
} else {
    echo "Invalid request"; // Trả về thông báo lỗi nếu yêu cầu không hợp lệ
}

// Đóng kết nối đến cơ sở dữ liệu
mysqli_close($conn);
?>
