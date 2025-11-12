<!DOCTYPE html>
<html lang="zxx">

<head>

</head>

<body>
    <?php include("header.php");
    $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
    if (isset($_GET['iddm'])) {
        $iddm = $_GET['iddm'];
    } else {
        echo "error";
    }
    include("connect.php");
    $result = mysqli_query($conn, "SELECT * FROM category_room WHERE id = $iddm");
    $danhMuc = mysqli_fetch_assoc($result);
    ?>

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Rooms</h2>
                        <div class="bt-option">
                            <a href="./index.php">Home</a>
                            <a href="#">Category</a>
                            <span><?php echo $danhMuc['name'] ?></span>
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
                // lấy ra tổng sản phẩm
                $kq = mysqli_query($conn, "SELECT count(id) AS tongSoPhong FROM room WHERE id_category = $iddm");
                $row1 = mysqli_fetch_assoc($kq);
                $tongSoPhong = $row1['tongSoPhong'];

                $p = 1;
                if (isset($_GET['p'])) $p = $_GET['p'];
                $trangHienTai = isset($_GET['p']) ? $_GET['p'] : 1;

                $soLuongPhongMoiTrang = 6;
                $soBatDau = ($p - 1) * $soLuongPhongMoiTrang;
                $tongSoTrang = ceil($tongSoPhong / $soLuongPhongMoiTrang); // tính tổng số trang

                // lấy dữ liệu trong khoảng giới hạn
                $kq2 = mysqli_query($conn, "SELECT * FROM room WHERE id_category=$iddm LIMIT $soBatDau, $soLuongPhongMoiTrang");
                while ($row = mysqli_fetch_array($kq2)) {
                ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="room-item">
                            <img class="image-room" src="../uploads/room/<?php echo $row['image'] ?>" alt="hình ảnh phòng">
                            <div class="ri-text">
                                <h4><?php echo $row['name'] ?></h4>
                                <h3><?php echo $row['price'] ?>$<span>/ Pernight</span></h3>
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
                                                <span><?php $x=$row['children']; if($x>0){echo ', '.$x.' Children';} ?> </span>
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
                                    <!-- <a href="room-details.php?id=<?php echo $row['id'] ?>" class="add-to-cart-btn"><img src="img/icon/add-to-cart.png"></a> -->
                                    <!-- <a href="" class="add-to-cart-btn">
                                        <span><img src="img/icon/add-to-cart.png"></span>
                                        <p class="hover-text">add to cart</p>
                                    </a> -->
                                    <a href="" class="add-to-cart-btn">
                                        <span><img src="img/icon/heart.png"></span>
                                        <p class="hover-text">wishlist</p>
                                    </a>
                                </div>
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
                            echo '<a href="room-category.php?p=' . ($trangHienTai - 1) . '" class="prev-arrow"><i class="fa fa-long-arrow-lem²" aria-hidden="true"></i>   Prev</a>';
                        }
                        // Lặp khoảng giữa
                        for ($i = 1; $i <= $tongSoTrang; $i++) { // Nếu là trang hiện tại thì hiển thị thẻ span 
                            // ngược lại hiển thị thẻ a 
                            if ($tongSoTrang <= 5) {
                                if ($i == $trangHienTai) {
                                    echo '<a class="active">' . $i . '</a>';
                                } else
                                    echo '<a href="room-category.php?p=' . $i . '">' . $i . '</a>';
                            } else {
                                if ($i == $trangHienTai) {
                                    echo '<a href="#" class="active-p">' . $i . '</a>';
                                } elseif ($i == ($trangHienTai + 1)) {
                                    echo '<a href="room-category.php?p=' . $i . '">' . $i . '</a>';
                                } elseif ($i == ($trangHienTai - 1)) {
                                    echo '<a href="room-category.php?p=' . $i . '">' . $i . '</a>';
                                } elseif ($i == 1) {
                                    echo '<a href="room-category.php?p=' . $i . '">' . $i . '</a>';
                                } elseif ($i == $tongSoTrang) {
                                    echo '<a href="room-category.php?p=' . $i . '">' . $i . '</a>';
                                } elseif ($i == ($trangHienTai + 2)) {
                                    echo '<a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>';
                                } elseif ($i == ($trangHienTai - 2)) {
                                    echo '<a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>';
                                }
                            }
                        }
                        // nếu current_page < $total_page và total_page> 1 mới hiển thị nút prev
                        if ($trangHienTai < $tongSoTrang && $tongSoTrang > 1) {
                            echo '<a href="room-category.php?p=' . ($trangHienTai + 1) . '" class="next-arrow">Next   <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Rooms Section End -->

    <?php mysqli_close($conn);
    include("footer.php")  ?>
</body>

</html>