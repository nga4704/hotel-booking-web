<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Sona Hotel">
    <meta name="keywords" content="Sona, unica, creative, php">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sona Hotel</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/slick.css" type="text/css">
    <link rel="stylesheet" href="css/slick-theme.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/new.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Section Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="canvas-open">
        <i class="icon_menu"></i>
    </div>
    <div class="offcanvas-menu-wrapper">
        <div class="canvas-close">
            <i class="icon_close"></i>
        </div>
        <!-- <div class="search-icon search-switch">
            <i class="icon_search"></i>
        </div> -->
        <div class="header-configure-area">

            <?php
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
                $idUser = $_SESSION['idUser'];
                include('connect.php');
                $result = mysqli_query($conn, "SELECT * FROM user WHERE id=" . $idUser);
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);

            ?>
                    <div class="user-option">
                        <img src="../uploads/user/<?php echo $row['Avatar']; ?>" alt="">
                        <span><?php echo $row['Fullname']; ?> <i class="fa fa-angle-down"></i></span>
                        <div class="user-dropdown">
                            <ul>
                                <li><a href="#">Profile</a></li>
                                <li><a href="room-booked.php">Room Booked</a></li>
                                <li><a href="post-blog.php">Post Blog</a></li>
                                <li><a href="posted-blog.php">Blog Posted</a></li>
                                <li><a href="login.php?dn=0">Log out</a></li>
                            </ul>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="user-option">
                    <img src="img/icon/user.png" alt="">
                    <span>User <i class="fa fa-angle-down"></i></span>
                    <div class="user-dropdown">
                        <ul>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="register.php">Register</a></li>
                        </ul>
                    </div>
                </div>
            <?php
            }
            ?>

            <a href="rooms.php" class="bk-btn">Booking Now</a>
        </div>
        <nav class="mainmenu mobile-menu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="rooms.php">Rooms</a></li>
                <li><a href="about-us.php">About Us</a></li>
                <li><a>Category</a>
                    <ul class="dropdown">
                        <li><a href="room-category.php?iddm=1">Standard Room</a></li>
                        <li><a href="room-category.php?iddm=2">Deluxe Room</a></li>
                        <li><a href="room-category.php?iddm=3">Suite Room</a></li>
                        <li><a href="room-category.php?iddm=4">Family Room</a></li>
                    </ul>
                </li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="top-social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-tripadvisor"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
        </div>
        <ul class="top-widget">
            <li><i class="fa fa-phone"></i> (12) 345 67890</li>
            <li><i class="fa fa-envelope"></i> sona@gmail.com</li>
        </ul>
    </div>
    <!-- Offcanvas Menu Section End -->

    <!-- Header Section Begin -->
    <header class="header-section header-normal">
        <div class="top-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="tn-left">
                            <li><i class="fa fa-phone"></i> (12) 345 67890</li>
                            <li><i class="fa fa-envelope"></i> sona@gmail.com</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="tn-right">
                            <div class="top-social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-tripadvisor"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                            <a href="rooms.php" class="bk-btn">Booking Now</a>
                            <?php
                            if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
                                $idUser = $_SESSION['idUser'];
                                include('connect.php');
                                $result2 = mysqli_query($conn, "SELECT * FROM user WHERE id=" . $idUser);
                                if ($result2 && mysqli_num_rows($result2) > 0) {
                                    $row2 = mysqli_fetch_assoc($result2);

                            ?>
                                    <div class="user-option">
                                        <img src="../uploads/user/<?php echo $row2['Avatar']; ?>" alt="">
                                        <span><?php echo $row2['Fullname']; ?> <i class="fa fa-angle-down"></i></span>
                                        <div class="user-dropdown">
                                            <ul>
                                                <li><a href="#">Profile</a></li>
                                                <li><a href="room-booked.php">Room Booked</a></li>
                                                <li><a href="post-blog.php">Post Blog</a></li>
                                                <li><a href="posted-blog.php">Blog Posted</a></li>
                                                <li><a href="login.php?dn=0">Log out</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php }
                            } else {
                                ?>
                                <div class="user-option">
                                    <img src="img/icon/user.png" alt="">
                                    <span>User <i class="fa fa-angle-down"></i></span>
                                    <div class="user-dropdown">
                                        <ul>
                                            <li><a href="login.php">Login</a></li>
                                            <li><a href="register.php">Register</a></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-item">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="./index.php">
                                <img src="img/icon/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="nav-menu">
                            <nav class="mainmenu">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="rooms.php">Rooms</a></li>
                                    <li><a href="about-us.php">About Us</a></li>
                                    <li><a>Category</a>
                                        <ul class="dropdown">
                                            <?php
                                            include("connect.php");
                                            $result3 = mysqli_query($conn, "SELECT * FROM category_room");
                                            while ($row3 = mysqli_fetch_array($result3)) {
                                            ?>
                                                <li><a href="room-category.php?iddm=<?php echo $row3['id'] ?>"><?php echo $row3['name'] ?></a></li>
                                                <!-- <li><a href="room-category.php?iddm=2">Deluxe Room</a></li>
                                            <li><a href="room-category.php?iddm=3">Suite Room</a></li>
                                            <li><a href="room-category.php?iddm=4">Family Room</a></li> -->
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <li><a href="blog.php">Blog</a></li>
                                    <li><a href="contact.php">Contact</a></li>
                                </ul>
                            </nav>
                            <!-- <div class="nav-right search-switch">
                            <a href="room-booked.php"><i class="fa fa-file-text-o"></i></a>
                            </div> -->
                            <!-- <div class="nav-right search-switch">
                                <i class="icon_search"></i>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->
    <script>
        $(document).ready(function() {
            var currentPath = window.location.pathname;
            console.log(currentPath); // In ra đường dẫn tương đối trong Console

            // Lặp qua mỗi thẻ <a> trong menu và kiểm tra URL
            $('nav a').each(function() {
                var linkPath = this.pathname;
                console.log(linkPath);
                if (linkPath === currentPath) {
                    $(this).closest('li').addClass('active');
                }
            });
        });
    </script>




</body>

</html>