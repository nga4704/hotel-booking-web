<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Main css -->
    <link rel="stylesheet" href="css/dk-style.css">
    <link rel="stylesheet" href="css/new.css">
</head>

<body>
    <?php
    // Code xử lý kiểm tra đăng ký
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['signup'])) {
            $u = isset($_POST['fullname']) ? $_POST['fullname'] : '';
            $e = isset($_POST['email']) ? $_POST['email'] : '';
            $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
            $address = isset($_POST['address']) ? $_POST['address'] : '';
            $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : '';
            $p = isset($_POST['password']) ? $_POST['password'] : '';
            $re_p = isset($_POST['re_pass']) ? $_POST['re_pass'] : '';
            $agree_term = isset($_POST['agree-term']) ? $_POST['agree-term'] : '';
            $error = false;
            $success = false;

            // Kiểm tra định dạng email hợp lệ
            if (empty($u) || empty($e) || empty($p) || empty($re_p) || empty($phone) ) {
                $error = "Please fill in all fields!";
            } elseif (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email format!";
            } elseif ($p !== $re_p) {
                $error = "Passwords do not match!";
            } elseif (empty($agree_term)) {
                $error = "Please agree to the terms!";
            } else {
                include("connect.php");

                // Kiểm tra tên người dùng đã tồn tại hay chưa
                $check_phone_query = "SELECT * FROM user WHERE Phone = '$phone'";
                $check_phone_result = mysqli_query($conn, $check_phone_query);

                $check_email_query = "SELECT * FROM user WHERE Email = '$e'";
                $check_email_query = mysqli_query($conn, $check_email_query);

                if (mysqli_num_rows($check_phone_result) > 0) {
                    $error = "Phone number already exists! Please choose another phone number.";
                } elseif (mysqli_num_rows($check_email_query) > 0) {
                    $error = "This email is already in use! Please use another email.";
                } else {
                    // Kiểm tra xem người dùng có tải lên tệp avatar hay không
                    if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] !== UPLOAD_ERR_NO_FILE) {
                        // Người dùng đã tải lên tệp avatar
                        $avatar_extension = pathinfo($_FILES['imageUpload']['name'], PATHINFO_EXTENSION);
                        $avatar_name = $phone . '.' . $avatar_extension;
                        $avatar_target_path = "../uploads/user/" . $avatar_name;
                        move_uploaded_file($_FILES['imageUpload']['tmp_name'], $avatar_target_path);
                    } else {
                        $avatar_name = 'user.png';
                    }

                    // Thực hiện truy vấn SQL để chèn dữ liệu vào cơ sở dữ liệu
                    $sql = "INSERT INTO user (Fullname, Password, Email, Phone, Address, Birthday, Avatar, timeRegister, status) VALUES ('$u','$p','$e','$phone','$address','$birthday','$avatar_name',".time().",1)";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        $success = "You have successfully registered!";
                    } else {
                        $error = "Registration failed! Please try again.";
                    }
                }
            }
        }
    }


    ?>

    <!-- Sign up form -->
    <?php if (!empty($error)) { ?>
        <div id="notify-msg" class="alert alert-danger" role="alert">
            <?= $error; ?>
        </div>
    <?php } elseif (!empty($success)) {  ?>
        <div id="notify-msg" class="alert alert-success" role="alert">
            <?= $success; ?><a href="login.php"> Login</a>
        </div>
    <?php } ?>
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h3 class="form-title" align="center">Sign up</h3>
                    <form method="POST" action="register.php" enctype="multipart/form-data" class="register-form" id="register-form">
                        <div class="container-avatar">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input class="input-file" name="imageUpload" type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload" id="label-input-file"><i class="fas fa-pencil-alt"></i></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview" style="background-image: url(https://media-cdn-v2.laodong.vn/Storage/NewsPortal/2019/10/27/762479/Black-Pink-4.jpg);">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fullname"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input class="input-text" type="text" name="fullname" id="fullname" placeholder="Fullname" value="<?php echo isset($u) ? $u : ''; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input class="input-text" type="email" name="email" id="email" placeholder="Your Email" value="<?php echo isset($e) ? $e : ''; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="phone"><i class="zmdi zmdi-local-phone"></i></label>
                            <input class="input-text" type="text" name="phone" id="phone" placeholder="Phone Number" value="<?php echo isset($phone) ? $phone : ''; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="address"><i class="zmdi zmdi-home"></i></label>
                            <input class="input-text" type="text" name="address" id="address" placeholder="Address" value="<?php echo isset($address) ? $address : ''; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="birthday"><i class="zmdi zmdi-calendar"></i></label>
                            <input class="input-text" type="date" name="birthday" id="birthday" placeholder="Date of birth" value="<?php echo isset($birthday) ? $birthday : ''; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input class="input-text" type="password" name="password" id="password" placeholder="Password" value="<?php echo isset($p) ? $p : ''; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input class="input-text" type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" value="<?php echo isset($re_p) ? $re_p : ''; ?>" />
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label><br>
                        </div>
                        <div class="form-group form-button">
                            <input align="center" type="submit" name="signup" id="signup" class="signup-btn" value="Register" />
                        </div>
                    </form><br>
                    <a href="login.php" class="signup-image-link">I am already member</a>
                </div>

            </div>
        </div>
    </section>



    <!-- JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
    </script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>