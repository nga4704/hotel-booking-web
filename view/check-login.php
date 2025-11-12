<?php
// Bạn cần bắt đầu phiên làm việc để sử dụng $_SESSION
session_start();

// Kiểm tra xem biến session 'login' có tồn tại và có giá trị là true không
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    // Nếu người dùng đã đăng nhập, trả về một giá trị để thông báo rằng đã đăng nhập
    echo 'loggedIn';
} else {
    // Nếu người dùng chưa đăng nhập, trả về một giá trị để thông báo rằng chưa đăng nhập
    echo 'notLoggedIn';
}
?>
