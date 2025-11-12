<?php
include("header.php");
date_default_timezone_set('Asia/Ho_Chi_Minh');
$_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
?>
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>List of Available Rooms</h2>
                    <div class="bt-option">
                        <a href="./index.php">Home</a>
                        <span>List of Available Rooms</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->
<section class="rooms-section spad">
    <div class="container">
        <div class="row">
            <?php
            // Kiểm tra nếu là phương thức POST
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                include "connect.php"; // Kết nối tới cơ sở dữ liệu

                // Lấy thông tin từ form POST
                $check_in = $_POST['date-in'];
                $check_out = $_POST['date-out'];
                $adults = $_POST['adult'];
                $children = $_POST['children'];
                $rooms = $_POST['room'];

                echo "<script>";
                echo "console.log('Dữ liệu được POST vào:', " . json_encode($_POST) . ");";
                echo "</script>";
                // Truy vấn để tìm các phòng trống phù hợp
                $query = "SELECT * FROM room 
            WHERE quantity >= $rooms 
            AND adult = $adults     
            AND children = $children 
            AND id NOT IN (
                SELECT idRoom FROM booking 
                WHERE (`date-in` BETWEEN '$check_in' AND '$check_out') 
                OR (`date-out` BETWEEN '$check_in' AND '$check_out')
            )";


                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
            ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="room-item">
                                <img class="image-room" src="../uploads/room/<?php echo $row['image'] ?>" alt="hình ảnh phòng">
                                <div class="ri-text">
                                    <h4><?php echo $row['name'] ?></h4>
                                    <h3>$<?php echo $row['price'] ?><span>/ Pernight</span></h3>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="r-o">Size:</td>
                                                <td><?php echo $row['size'] ?> m²</td>
                                            </tr>
                                            <tr>
                                                <td class="r-o">Capacity:</td>
                                                <td>
                                                    <span><?php echo $row['adult'] ?> Adult</span>
                                                    <span><?php $x = $row['children'];
                                                            if ($x > 0) {
                                                                echo ', ' . $x . ' Children';
                                                            } ?> </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="r-o">Bed:</td>
                                                <td><?php echo $row['bed'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="r-o">Services:</td>
                                                <td>Wifi, Television, Bathroom,...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="btn-room-action">
                                        <a href="room-details.php?id=<?php echo $row['id'] ?>" class="more-btn">More Details</a>
                                        <a href="" class="add-to-cart-btn">
                                            <span><img src="img/icon/heart.png"></span>
                                            <p class="hover-text">wishlist</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                } else {
                    // Nếu không có phòng trống thì thông báo
                    echo "Không có phòng trống phù hợp.";
                }

                mysqli_close($conn);
            }
            ?>
        </div>
    </div>
</section>
<!-- Phần HTML: Breadcrumb, Rooms Section, và phân trang -->
<!-- ... -->

<?php
// Bao gồm phần footer
include("footer.php");
?>