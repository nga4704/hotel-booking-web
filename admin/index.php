<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <?php
  // Code xử lý kiểm tra đăng nhập
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
      $u = $_POST['username'];
      $p = $_POST['password'];

      if (empty($u)) {
        $error = "Username is empty!";
      } elseif (empty($p)) {
        $error = "Password is empty!";
      } else {
        include("connect.php");
        $sql = "SELECT * FROM admin WHERE username = '$u' AND Password = '$p'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $_SESSION['dn'] = true;
          $_SESSION['idAdmin'] = $row['id'];
          header('Location: home.php');
          exit();
        } else {
          $error = "Username or password is incorrect!";
        }
      }
    }
  }
  if (isset($_GET['login']) && $_GET['login'] === 0) {
    unset($_SESSION['dn']);
    unset($_SESSION['idAdmin']);
    header('Location: index.php');
    exit();
  }
  ?>
  <div class="container-scroller">
    <?php if (!empty($error)) { ?>
      <div id="notify-msg" class="alert alert-danger" role="alert">
        <?= $error; ?>
      </div>
    <?php }   ?>
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="images/logo-dark.svg" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" method="POST" action="index.php">
                <div class="form-group">
                  <input type="text" name="username" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username"   value="<?php echo isset($u) ? $u : ''; ?>">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password"   value="<?php echo isset($p) ? $p : ''; ?>">
                </div>
                <div class="mt-3">
                  <input type="submit" name="login" id="login" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="SIGN IN" />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>

</body>

</html>