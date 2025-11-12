<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <?php
    include "connect.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['editAbout'])) {
            $aboutId = $_POST['aboutId'];
            $title = $_POST['title'];
            $intro = $_POST['intro'];

            $updateQuery = "UPDATE about_us SET title='$title', intro='$intro' WHERE id='$aboutId'";

            if (mysqli_query($conn, $updateQuery)) {
                echo '<script language="javascript">';
                echo 'alert("Bạn đã cập nhật thành công!");';
                echo 'window.location.href = "setting-about.php";';
                echo '</script>';
            } else {
                echo '<script language="javascript">alert("Cập nhật không thành công.");</script>';
            }
        } else {
            echo "Invalid request";
        }
    }
    ?>


    <div class="container-scroller"">
        <?php include "header.php" ?>
        <div class=" container-fluid page-body-wrapper" style="margin-top: 55px;">
        <?php include "sidebar.php" ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <nav style="margin-top: -20px; background-color: white; display: flex; justify-content: space-between;" class=" navbar-breadcrumb col-xl-12 col-12 d-flex flex-row p-0">
                                    <div class="navbar-links-wrapper d-flex align-items-stretch">
                                        <h3 class="card-title" style="margin-top: 20px;">Thiết Lập Chung</h3>
                                    </div>
                                </nav>
                                <div class="table-responsive" style="margin-top: -15px;">
                                    <table class="table table-striped project-orders-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tiêu Đề</th>
                                                <th>Giới Thiệu</th>
                                                <th>Sửa</th>
                                            </tr>
                                        </thead>
                                        <tbody class="danhsach">
                                            <?php
                                            $result = mysqli_query($conn, "SELECT * FROM about_us");
                                            $i = 1;
                                            while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td style="min-width: 150px;white-space: wrap;">
                                                        <?php if ($row['type'] == 1) {
                                                            echo '<span class="btn btn-inverse-danger btn-fw tags">Slided</span>';
                                                        } elseif ($row['type'] == 2) {
                                                            echo '<span class="btn btn-inverse-primary btn-fw tags">Introduce</span>';
                                                        } elseif ($row['type'] == 3) {
                                                            echo '<span class="btn btn-inverse-warning btn-fw tags">About Us</span>';
                                                        } ?>
                                                        <p><?php echo $row['title']; ?>
                                                        </p>
                                                    </td>
                                                    <td style="min-width: 200px;white-space: wrap;">
                                                        <p><?php echo $row['intro'] ?></p>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <button name="btnDisplayEditAbout" id="btnDisplayEditAbout" data-about-id="<?php echo $row['id']; ?>" type="button" class="btn btn-info btn-sm btn-icon-text btnDisplayEditAbout">
                                                                <i class="typcn typcn-edit btn-icon-append"></i> Sửa
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php $i++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    </div>

    <div class="overlay" id="overlay"></div>

    <!-- Edit About Form  -->
    <div class="col-md-6 grid-margin stretch-card" id="formEditAbout" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" align="center">Sửa Thông Tin</h4>
                <form class="forms-sample" action="setting-about.php" method="POST">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="aboutId" name="aboutId">
                    </div>
                    <div class="form-group">
                        <label for="title">Tiêu Đề</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="intro">Giới Thiệu</label>
                        <textarea class="form-control" id="intro" name="intro"></textarea>
                    </div>

                    <input type="hidden" name="editAbout" value="true">
                    <button type="submit" class="btn btn-primary mr-2" id="btnEditAbout">Submit</button>
                    <button type="button" class="btn btn-light" id="btnCloseEdit">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Xử lý sự kiện click cho nút "Update" trong mỗi hàng
            $(document).on("click", "#btnDisplayEditAbout", function() {
                // Lấy thông tin từ hàng tương ứng
                var row = $(this).closest("tr");
                var title = row.find("td:eq(1) p").text().trim();
                var intro = row.find("td:eq(2)").text().trim();
                var aboutId = $(this).data("about-id");

                // Điền thông tin vào các trường input trong form cập nhật
                $('#formEditAbout').find("#aboutId").val(aboutId);
                $('#formEditAbout').find("#title").val(title);
                $('#formEditAbout').find("#intro").val(intro);

                // Hiển thị form cập nhật thông tin khách hàng
                $('.overlay').show();
                $('.overlay').addClass("active");
                $('#formEditAbout').show();
            });
        });
        $('#btnCloseEdit').click(function() {
            $('.overlay').hide();
            $('#formEditAbout').hide();
        });
    </script>

    <?php
    mysqli_close($conn);
    include "footer.php" ?>
</body>

</html>