<!DOCTYPE html>
<html lang="zxx">

<head>

</head>

<body>
    <?php include("header.php");$_SESSION['return_to'] = $_SERVER['REQUEST_URI']; ?>

<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Rooms</h2>
                        <div class="bt-option">
                            <a href="./index.php">Home</a>
                            <a href="./index.php">Category</a>
                            <span>Family Rooms</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Rooms Section Begin -->
    <section class="rooms-section spad">
        <div class="container">
            <div class="row">



                    <?php
                    include("connect.php");

                    // lấy ra tổng sản phẩm
                    $kq = mysqli_query($conn, 'SELECT count(id) AS tongSoPhong FROM Phong');
                    $row1 = mysqli_fetch_assoc($kq);
                    $tongSoPhong = $row1['tongSoPhong'];

                    $p = 1;
                    if (isset($_GET['p'])) $p = $_GET['p'];
                    $trangHienTai = isset($_GET['p']) ? $_GET['p'] : 1;

                    $soLuongPhongMoiTrang = 6;
                    $soBatDau = ($p - 1) * $soLuongPhongMoiTrang;
                    $tongSoTrang = ceil($tongSoPhong / $soLuongPhongMoiTrang); // tính tổng số trang

                    // lấy dữ liệu trong khoảng giới hạn
                    $kq2 = mysqli_query($conn, "SELECT * FROM Phong LIMIT $soBatDau, $soLuongPhongMoiTrang");

                    mysqli_close($conn);

                    while ($row = mysqli_fetch_array($kq2)) {


                    ?>



                <div class="col-lg-4 col-md-6">



                        <div class="room-item">
                            <img src="../uploads/room/<?php echo $row['hinhAnh'] ?>" alt="hình ảnh phòng">
                            <div class="ri-text">
                                <h4><?php echo $row['ten'] ?></h4>
                                <h3><?php echo number_format($row['gia'], "0", ",", ".") ?> VND<span>/ 1 đêm</span></h3>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Size:</td>
                                            <td>30 ft</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Capacity:</td>
                                            <td>Max persion 3</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Bed:</td>
                                            <td>King Beds</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Services:</td>
                                            <td>Wifi, Television, Bathroom,...</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="room-details.php?id=<?php echo $row['id'] ?>" class="primary-btn">More Details</a>
                            </div>
                        </div>
                </div>


            <?php } ?>


            <div class="col-lg-12">
                <div class="room-pagination">
                    <?php
                    // PHẦN HIỂN THỊ PHÂN TRANG
                    // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
                    if ($trangHienTai > 1 && $tongSoTrang > 1) {
                        echo '<a href="rooms.php?p=' . ($trangHienTai - 1) . '" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>   Prev</a>';
                    }
                    // Lặp khoảng giữa
                    for ($i = 1; $i <= $tongSoTrang; $i++) { // Nếu là trang hiện tại thì hiển thị thẻ span 
                        // ngược lại hiển thị thẻ a 
                        if ($tongSoTrang <= 5) {
                            if ($i == $trangHienTai) {
                                echo '<a class="active">' . $i . '</a>';
                            } else
                                echo '<a href="rooms.php?p=' . $i . '">' . $i . '</a>';
                        } else {
                            if ($i == $trangHienTai) {
                                echo '<a href="#" class="active-p">' . $i . '</a>';
                            } elseif ($i == ($trangHienTai + 1)) {
                                echo '<a href="rooms.php?p=' . $i . '">' . $i . '</a>';
                            } elseif ($i == ($trangHienTai - 1)) {
                                echo '<a href="rooms.php?p=' . $i . '">' . $i . '</a>';
                            } elseif ($i == 1) {
                                echo '<a href="rooms.php?p=' . $i . '">' . $i . '</a>';
                            } elseif ($i == $tongSoTrang) {
                                echo '<a href="rooms.php?p=' . $i . '">' . $i . '</a>';
                            } elseif ($i == ($trangHienTai + 2)) {
                                echo '<a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>';
                            } elseif ($i == ($trangHienTai - 2)) {
                                echo '<a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>';
                            }
                        }
                    }
                    // nếu current_page < $total_page và total_page> 1 mới hiển thị nút prev
                    if ($trangHienTai < $tongSoTrang && $tongSoTrang > 1) {
                        echo '<a href="rooms.php?p=' . ($trangHienTai + 1) . '" class="next-arrow">Next   <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>';
                    }
                    ?>
                </div>
            </div>
            </div>
        </div>
    </section>
    <!-- Rooms Section End -->

    <?php include("footer.php")  ?>
</body>

</html>