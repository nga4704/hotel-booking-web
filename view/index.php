<!DOCTYPE html>
<html lang="zxx">

<head>
    <link rel="stylesheet" href="css/slick.css" type="text/css">
    <link rel="stylesheet" href="css/new.css" type="text/css">
</head>

<body>
    <?php include("header.php");
    $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
    include("connect.php");

    ?>

    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-text">
                        <h1><?php
                            $result6 = mysqli_query($conn, "SELECT * FROM about_us WHERE type=1");
                            $row6 = mysqli_fetch_assoc($result6);
                            echo $row6['title'];
                            ?>
                        </h1>
                        <p><?php echo $row6['intro']; ?></p>
                        <a href="rooms.php" class="primary-btn">Discover Now</a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1" id="formTimPhong">
                    <div class="booking-form">
                        <h3>Booking Your Hotel</h3>
                        <form action="timPhongTrong.php" method="POST">
                            <div class="check-date">
                                <label for="date-in">Check In:</label>
                                <input type="text" class="date-input" id="date-in" name="date-in">
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="check-date">
                                <label for="date-out">Check Out:</label>
                                <input type="text" class="date-input" id="date-out" name="date-out">
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="input-num">
                                <label for="adult">Adult:</label>
                                <input type="number" class="" id="adult" name="adult">
                            </div>
                            <div class="input-num">
                                <label for="children">Children:</label>
                                <input type="number" class="" id="children" name="children">
                            </div>
                            <div class="input-num">
                                <label for="room">Room:</label>
                                <input type="number" class="" id="room" name="room">
                            </div>
                            <input type="hidden" name="timPhong">
                            <button type="submit">Check Availability</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-slider owl-carousel">
            <?php
            include("connect.php");
            $result3 = mysqli_query($conn, "SELECT * FROM slided");
            while ($row3 = mysqli_fetch_array($result3)) {
            ?>
                <div class="hs-item set-bg" data-setbg="../uploads/hero/<?php echo $row3['image'] ?>"></div>
            <?php } ?>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- About Us Section Begin -->
    <section class="aboutus-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-text">
                        <div class="section-title">
                            <span>About Us</span>
                            <h2><?php
                                $result7 = mysqli_query($conn, "SELECT * FROM about_us WHERE type=2");
                                $row7 = mysqli_fetch_assoc($result7);
                                echo $row7['title'];
                                ?></h2>
                        </div>
                        <p class="f-para"><?php 
                        echo $row7['intro'];
                        ?></p><br>
                        <a href="about-us.php" class="primary-btn about-btn">Read More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-pic">
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="img/about/about-1.jpg" alt="">
                            </div>
                            <div class="col-sm-6">
                                <img src="img/about/about-2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Section End -->

    <!-- Services Section End -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>What We Do</span>
                        <h2>Discover Our Services</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                include("connect.php");
                $result3 = mysqli_query($conn, "SELECT * FROM services");
                while ($row3 = mysqli_fetch_array($result3)) {
                    if ($row3['status'] == 1) {
                ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="service-item">
                                <i class="<?php echo $row3['icon']; ?>"></i>
                                <h4><?php echo $row3['name']; ?></h4>
                                <p><?php echo $row3['detail']; ?></p>
                            </div>
                        </div>
                <?php }
                }
                mysqli_close($conn); ?>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Home Room Section Begin -->
    <section class="hp-room-section">
        <div class="container-fluid">
            <div class="hp-room-items">
                <?php
                include("connect.php");
                $result2 = mysqli_query($conn, "SELECT * FROM category_room");
                while ($row2 = mysqli_fetch_array($result2)) {
                ?>
                    <div class="hp-room-item">
                        <div class="hp-room-item set-bg" data-setbg="../uploads/category/<?php echo $row2['image'] ?>">
                            <div class="hr-text">
                                <h3><?php echo $row2['name'] ?></h3>
                                <h2>$<?php echo $row2['price'] ?><span>/Pernight</span></h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Size:</td>
                                            <td><?php echo $row2['size'] ?> m²</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Capacity:</td>
                                            <td>Max persion <?php echo $row2['capacity'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Bed:</td>
                                            <td><?php echo $row2['bed'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="room-category.php?iddm=<?php echo $row2['id'] ?>" class="primary-btn">More Details</a>
                            </div>
                        </div>
                    </div>
                <?php }
                mysqli_close($conn); ?>
            </div>

            <button type="button" class="slick-prev">Previous</button>
            <button type="button" class="slick-next">Next</button>
        </div>
    </section>
    <!-- Home Room Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Testimonials</span>
                        <h2>What Customers Say?</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="testimonial-slider owl-carousel">
                        <?php
                        include("connect.php");
                        $result = mysqli_query($conn, "SELECT * FROM testimonial");
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <div class="ts-item">
                                <p>"<?php echo $row['content'] ?>"</p>
                                <div class="ti-author">
                                    <div class="rating" data-rating="<?php echo $row['star'] ?>">

                                    </div>
                                    <h5> – <?php echo $row['nameCustomer'] ?>, tourist from <?php echo $row['addressCustomer'] ?> </h5>
                                </div>
                                <img src="../uploads/testimonial/<?php echo $row['img'] ?>" alt="">
                            </div>
                        <?php }
                        mysqli_close($conn); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->

    <!-- Blog Section Begin -->
    <section class="blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Hotel News</span>
                        <h2>Our Blog & Event</h2>
                    </div>
                </div>
            </div>
            <div class="row blog-items">
                <?php
                include("connect.php");
                $result4 = mysqli_query($conn, "SELECT * FROM blog LIMIT 5");
                while ($row4 = mysqli_fetch_array($result4)) {
                ?>
                    <?php if ($row4['id'] == 4) { ?>
                        <div class="col-lg-8">
                            <div class="blog-item small-size set-bg" data-setbg="../uploads/blog/<?php echo $row4['image']; ?>">
                            <?php } elseif ($row4['id'] == 5) { ?>
                                <div class="col-lg-4">
                                    <div class="blog-item small-size set-bg" data-setbg="../uploads/blog/<?php echo $row4['image']; ?>">
                                    <?php } else { ?>
                                        <div class="col-lg-4">
                                            <div class="blog-item set-bg" data-setbg="../uploads/blog/<?php echo $row4['image']; ?>">
                                            <?php } ?>
                                            <div class="bi-text">
                                                <span class="b-tag"><?php
                                                                    $result5 = mysqli_query($conn, "SELECT * FROM category_blog WHERE id = " . $row4['category_id']);
                                                                    $row5 = mysqli_fetch_assoc($result5);
                                                                    echo $row5['name'];
                                                                    ?></span>
                                                <h4><a href="blog-details.php?id=<?php echo $row4['id']; ?>"><?php echo $row4['title']; ?></a></h4>
                                                <div class="b-time"><i class="icon_clock_alt"></i><?php echo date("d M, Y", $row4['timePost']) ?></div>
                                            </div>
                                            </div>
                                        </div>
                                    <?php }
                                mysqli_close($conn); ?>
                                    </div>
                                </div>
    </section>
    <!-- Blog Section End -->
    <?php include("footer.php") ?>



</body>

</html>