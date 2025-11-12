<!DOCTYPE html>
<html lang="zxx">

<head>

</head>

<body>
    <?php include("header.php");
    $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_SESSION['idUser'])) {
            echo '<script language="javascript">';
            echo 'alert("Bạn cần đăng nhập để tiếp tục!");';
            echo 'window.location.href = "login.php";';
            echo '</script>';
            exit(); 
        }
        if (isset($_POST['phanHoi'])) {
            $idUser = $_SESSION['idUser'];
            $result4 = mysqli_query($conn, "SELECT Email FROM User WHERE id = ".$idUser);
            $row4 = mysqli_fetch_assoc($result4);
            $email = $row4['Email'];
            $title = $_POST['title'];
            $message = $_POST['message'];
            $currentTime = time();
            $insertQuery = "INSERT INTO phanhoi (idUser,email,title, message,timeSend,status) VALUES ($idUser,'$email','$title', '$message','$currentTime',0)";

            if (mysqli_query($conn, $insertQuery)) {
                echo '<script language="javascript">';
                echo 'alert("Bạn đã gửi thành công!");';
                echo 'window.location.href = "contact.php";'; 
                echo '</script>';
            } else {
                echo '<script language="javascript">alert("Gửi không thành công.");</script>';
            }
        }
    }

    ?>

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Contact</h2>
                        <div class="bt-option">
                            <a href="./index.php">Home</a>
                            <span>Contact</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <?php
            include("connect.php");
            $result = mysqli_query($conn, "SELECT * FROM contact");
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="contact-text">
                            <h2>Contact Info</h2>
                            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.</p> -->
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="c-o">Address:</td>
                                        <td><?php echo $row['address'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="c-o">Phone:</td>
                                        <td><?php echo $row['phone'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="c-o">Email:</td>
                                        <td><?php echo $row['email'] ?></td>
                                    </tr>
                                    <!-- <tr>
                                    <td class="c-o">Fax:</td>
                                    <td>+(12) 345 67890</td>
                                </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-7 offset-lg-1">
                            <form action="contact.php" class="contact-form" method="POST">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input style="color: black;" type="text" placeholder="Title" name="title">
                                        <textarea style="color: black;" placeholder="Your Message" name="message"></textarea>
                                        <button type="submit">Submit Now</button>
                                        <input type="hidden" name="phanHoi">
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
                <div class="map">
                    <iframe src="<?php echo $row['map'] ?>" height="470" style="border:0;" allowfullscreen=""></iframe>
                </div>
            <?php } ?>
        </div>
    </section>
    <!-- Contact Section End -->
    <script>
        $(document).ready(function() {
            $('#showBookingForm').click(function() {
                var roomId = <?php echo $id; ?>;
                $.ajax({
                    url: 'check-login.php',
                    type: 'GET',
                    success: function(response) {
                        if (response === 'loggedIn') {
                            window.location.href = 'booking.php?id=' + roomId;
                        } else {
                            alert("Bạn chưa đăng nhập! Vui lòng đăng nhập để tiếp tục.");
                            window.location.href = 'login.php';
                        }
                    },
                    error: function() {}
                });
            });

        });
    </script>
    <?php include("footer.php") ?>
</body>

</html>