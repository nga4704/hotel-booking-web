<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sona Admin</title>
    <link rel="shortcut icon" href="images/favicon.png" />
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
</head>

<body>
<div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="typcn typcn-cog-outline"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close typcn typcn-times"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme">
            <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
          </div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme">
            <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
          </div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="home.php">
              <i class="typcn typcn-device-desktop menu-icon"></i>
              <span class="menu-title">Thống kê</span>
              <!-- <div class="badge badge-danger">new</div> -->
            </a>
          </li>
         
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="typcn typcn-document-text menu-icon"></i>
              <span class="menu-title">Đặt phòng</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="new-booking.php">Phòng mới đặt</a></li>
                <li class="nav-item"> <a class="nav-link" href="xacnhanthanhtoan.php">Xác nhận thanh toán</a></li>
                <li class="nav-item"> <a class="nav-link" href="hosodatphong.php">Hồ sơ đặt phòng</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#phong" aria-expanded="false" aria-controls="ui-basic">
              <i class="typcn typcn-th-large-outline menu-icon"></i>
              <span class="menu-title">Quản lý phòng</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="phong">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="loaiphong.php">Loại Phòng</a></li>
                <li class="nav-item"> <a class="nav-link" href="room.php">Phòng</a></li>
                <li class="nav-item"> <a class="nav-link" href="services.php">Dịch Vụ</a></li>
                <li class="nav-item"> <a class="nav-link" href="tiennghi.php">Tiện Nghi</a></li>
                <li class="nav-item"> <a class="nav-link" href="review.php">Đánh Giá</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="customer.php">
              <i class="typcn typcn-user-add-outline menu-icon"></i>
              <span class="menu-title">Khách hàng</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="room.php">
              <i class="typcn typcn-th-small-outline menu-icon"></i>
              <span class="menu-title">Phòng</span>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="review.php">
              <i class="typcn typcn-pen menu-icon"></i>
              <span class="menu-title">Đánh giá</span>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="services.php">
              <i class="typcn typcn-headphones menu-icon"></i>
              <span class="menu-title">Dịch vụ</span>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="tiennghi.php">
              <i class="typcn typcn-rss-outline menu-icon"></i>
              <span class="menu-title">Tiện nghi</span>
            </a>
          </li> -->
          
          <li class="nav-item">
            <a class="nav-link" href="blog.php">
              <i class="typcn typcn-news menu-icon"></i>
              <span class="menu-title">Bài viết</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="phanhoi.php">
              <i class="typcn typcn-messages menu-icon"></i>
              <span class="menu-title">Phản hồi</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="slided.php">
              <i class="typcn typcn-image-outline menu-icon"></i>
              <span class="menu-title">Slided</span>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="setting.php">
              <i class="typcn typcn-cog-outline menu-icon"></i>
              <span class="menu-title">Thiết lập</span>
            </a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#setting" aria-expanded="false" aria-controls="ui-basic">
              <i class="typcn typcn-th-large-outline menu-icon"></i>
              <span class="menu-title">Thiết lập</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="setting">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="slided.php">Slided</a></li>
                <li class="nav-item"> <a class="nav-link" href="setting-about.php">About Us</a></li>
                <li class="nav-item"> <a class="nav-link" href="setting-contact.php">Contact</a></li>
              </ul>
            </div>
          </li>

          

        </ul>
      </nav>
</body>

</html>