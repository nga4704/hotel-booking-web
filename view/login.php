<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Main css -->
    <link rel="stylesheet" href="css/dn-style.css">
</head>

<body>

    <?php
    // Code xử lý kiểm tra đăng nhập
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['login'])) {
            $u = $_POST['email-phone'];
            $p = $_POST['password'];

            if (empty($u)) {
                $error = "Email/Phone is empty!";
            } elseif (empty($p)) {
                $error = "Password is empty!";
            } else {
                include("connect.php");
                $sql = "SELECT * FROM user WHERE (Email = '$u' OR Phone = '$u') AND Password = '$p'";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    $sql2 = "SELECT * FROM user WHERE (Email = '$u' OR Phone = '$u') AND Password = '$p' AND status = 1";
                    $result2 = mysqli_query($conn, $sql2);
                    if ($result2 && mysqli_num_rows($result2) > 0) {
                        $row = mysqli_fetch_assoc($result2);
                        $_SESSION['login'] = true;
                        $_SESSION['idUser'] = $row['id'];
                        // header("location:index.php");
                        if (isset($_SESSION['return_to']) && !empty($_SESSION['return_to'])) {
                            $return_to = $_SESSION['return_to'];
                            unset($_SESSION['return_to']);
                            header('Location: ' . $return_to);
                            exit();
                        } else {
                            header('Location: index.php');
                            exit();
                        }
                    } else {
                        $error = "Tài khoản của bạn đã bị khóa.";
                    }
                } else {
                    $error = "Email/Phone or password is incorrect!";
                }
            }
        }
    }
    if (isset($_GET['dn']) && $_GET['dn'] == 0) {
        unset($_SESSION['login']);
        unset($_SESSION['idUser']);
        if (isset($_SESSION['return_to']) && !empty($_SESSION['return_to'])) {
            $return_to = $_SESSION['return_to'];
            unset($_SESSION['return_to']);
            header('Location: ' . $return_to);
            exit();
        } else {
            header('Location: index.php');
            exit();
        }
    }
    ?>
    <!-- Sign up form -->
    <section class="login">
        <div class="container">
            <?php if (!empty($error)) { ?>
                <div id="notify-msg" class="alert alert-danger" role="alert">
                    <?= $error; ?>
                </div>
            <?php }   ?>
            <div class="login-content">
                <!-- <div class="login-form"> -->
                <form method="POST" class="login-form" id="login-form" action="login.php">
                    <div class="px-5 ms-xl-4 logo">
                        <a href="./index.php">
                            <img src="img/icon/logo.png" alt="">
                        </a>
                        <h3 class="form-title" align="center">Login</h3>
                    </div>
                    <div class="form-group">
                        <label for="email-phone"><i class="zmdi zmdi-email"></i></label>
                        <input type="text" name="email-phone" id="email-phone" placeholder="Email/Phone" value="<?php echo isset($u) ? $u : ''; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" id="password" placeholder="Password" value="<?php echo isset($p) ? $p : ''; ?>" />
                    </div>
                    <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
                    <div class="form-group form-button">
                        <input type="submit" name="login" id="login" class="login-btn" value="Login" />
                    </div>
                </form>
                <!-- </div> -->

                <div class="login-image">
                    <figure><img src="img/icon/hotel.png" alt="login image"></figure>
                    <p class="p-link">Don't have an account? <a href="register.php" class="link-dk"> Register here</a></p>

                </div>
            </div>
        </div>
    </section>



    <!-- JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>