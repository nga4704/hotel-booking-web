<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>

<body>
    <?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    include "connect.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['addTiennghi'])) {
            $name = $_POST['name'];

            $insertQuery = "INSERT INTO tiennghi (name,status) VALUES ('$name',1)";

            if (mysqli_query($conn, $insertQuery)) {
                echo '<script language="javascript">';
                echo 'alert("Bạn đã thêm tiện nghi mới thành công!");';
                echo 'window.location.href = "tiennghi.php";';
                echo '</script>';
            } else {
                echo '<script language="javascript">alert("Thêm tiện nghi mới thất bại.");</script>';
            }
        } elseif (isset($_POST['updateTiennghi'])) {
            $tiennghiId = $_POST['tiennghiId'];
            $name = $_POST['updated-name'];

            $updateQuery = "UPDATE tiennghi SET name='$name' WHERE id='$tiennghiId'";

            if (mysqli_query($conn, $updateQuery)) {
                echo '<script language="javascript">';
                echo 'alert("Bạn đã cập nhật thông tin tiện nghi thành công!");';
                echo 'window.location.href = "tiennghi.php";';
                echo '</script>';
            } else {
                echo '<script language="javascript">alert("Cập nhật thông tin tiện nghi thất bại.");</script>';
            }
        } else {
            echo "Invalid request";
        }
    } else {
        echo "Invalid request";
    }

    ?>

    <div class="container-scroller" style="margin-top: -21px;">
        <?php include "header.php" ?>
        <div class="container-fluid page-body-wrapper" style="margin-top: 50px;">
            <?php include "sidebar.php" ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <nav style="margin-top: -20px; background-color: white;" class=" navbar-breadcrumb col-xl-12 col-12 d-flex flex-row p-0">
                                        <div class="navbar-links-wrapper d-flex align-items-stretch">
                                            <h3 class="card-title" style="margin-top: 20px;">Quản Lý Tiện nghi</h3>
                                        </div>
                                        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                                            <ul class="navbar-nav navbar-nav-right">
                                                <li class="nav-item nav-search d-none d-md-block mr-0">
                                                    <div class="input-group" style="border: 1px solid #282f3a;">
                                                        <input type="text" class="form-control timkiem" placeholder="Search..." aria-label="search" aria-describedby="search">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="search">
                                                                <i class="typcn typcn-zoom"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div style="margin-top: 13px;">
                                            <button type="button" class="btn btn-secondary btn-sm btn-icon-text mr-3" id="btnAdd" style="display: flex; padding: 11px;">
                                                <i class="typcn typcn-document-add btn-icon-append" style="margin: -2px 2px 0 0;"></i> Thêm
                                            </button>
                                        </div>
                                    </nav>
                                    <div class="table-responsive">
                                        <table class="table table-striped project-orders-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tên Tiện Nghi</th>
                                                    <th>Tình Trạng</th>
                                                    <th>Hành Động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="danhsach">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT * FROM tiennghi ORDER BY id DESC ");
                                                $i = 1;
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                    <tr>
                                                    <td style="display: none;"><?php echo $row['id']; ?></td>
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $row['name'] ?></td>
                                                        <td>
                                                            <?php if ($row['status'] == 0) { ?>
                                                                <button class="btn btn-secondary tiennghi-status" data-tiennghi-id="<?php echo $row['id']; ?>" id="btnStatus">Tạm ngừng</button>
                                                            <?php } else { ?>
                                                                <button class="btn btn-primary tiennghi-status" data-tiennghi-id="<?php echo $row['id']; ?>" id="btnStatus">Hoạt động</button>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <button type="button" data-tiennghi-id="<?php echo $row['id']; ?>" class="btn btn-info btn-sm btn-icon-text mr-3" id="btnShowFormUpdate">
                                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                                </button>
                                                                <button name="delete-btn" id="delete-btn" data-tiennghi-id="<?php echo $row['id']; ?>" type="button" class="btn btn-danger btn-sm btn-icon-text">
                                                                    <i class="typcn typcn-delete-outline btn-icon-append"></i>
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
        <!-- container-scroller -->
        <div class="overlay" id="overlay"></div>

        <!-- Add tiennghi Form  -->
        <div class="col-md-6 grid-margin stretch-card" id="addTiennghiFormContainer" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" align="center">Thêm Tiện Nghi</h4>
                    <form class="forms-sample" action="tiennghi.php" method="POST">
                        <div class="form-group">
                            <label for="name">Tên Tiện Nghi</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>

                        <input type="hidden" name="addTiennghi" value="true">
                        <button type="submit" class="btn btn-primary mr-2" id="btnAddTiennghi">Add</button>
                        <button type="button" class="btn btn-light" id="btnCloseAdd">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Update Tiennghi Form  -->
        <div class="col-md-6 grid-margin stretch-card" id="updateTiennghiFormContainer" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" align="center">Cập Nhật Thông Tin Tiện Nghi</h4>
                    <form class="forms-sample" action="tiennghi.php" method="POST">
                        <div class="form-group">
                            <label for="updated-name">Tên Tiện Nghi</label>
                            <input type="text" class="form-control" id="updated-name" name="updated-name">
                        </div>
                        <input type="hidden" name="updateTiennghi" value="true">
                        <input type="hidden" id="tiennghiId" name="tiennghiId">
                        <button type="submit" class="btn btn-primary mr-2" id="btnUpdateTiennghi">Update</button>
                        <button type="button" class="btn btn-light" id="btnCloseUpdate">Cancel</button>
                    </form>
                </div>
            </div>
        </div>


        <script>
            // Hiển thị Form thêm 
            $(document).ready(function() {
                $(document).on("click", "#btnAdd", function() {
                    $('.overlay').show();
                    $('.overlay').addClass("active");
                    $('#addTiennghiFormContainer').show();
                });
            });

            // xử lý tìm kiếm
            $('.timkiem').keyup(function() {
                var txt = $('.timkiem').val();
                $.post('xuly/timkiem-tiennghi.php', {
                    data: txt
                }, function(data) {
                    $('.danhsach').html(data);
                })
            });

            // Cập nhật tình trạng 
            $(document).ready(function() {
                $(".tiennghi-status").click(function() {
                    // var tiennghiId = $(this).closest("tr").find("td:first").text();
                    var tiennghiId = $(this).data("tiennghi-id");
                    var status = $(this).text().trim() === "Hoạt động" ? 0 : 1;
                    var clickedBtn = $(this);

                    $.ajax({
                        type: "POST",
                        url: "xuly/update-status.php",
                        data: {
                            tiennghiId: tiennghiId,
                            status: status
                        },
                        success: function(response) {
                            if (response === "success") {
                                var newStatus = status === 0 ? "Tạm ngừng" : "Hoạt động";
                                // Thay đổi lớp CSS để chuyển màu và kiểu nút
                                if (status === 0) {
                                    clickedBtn.removeClass("btn-primary").addClass("btn-secondary");
                                } else {
                                    clickedBtn.removeClass("btn-secondary").addClass("btn-primary");
                                }
                                // Cập nhật trạng thái trên giao diện
                                clickedBtn.text(newStatus);
                            } else {
                                alert("Cập nhật trạng thái không thành công!");
                            }
                        }
                    });
                });
            });

            $(document).ready(function() {
                // Xử lý sự kiện click cho nút "Update" trong mỗi hàng
                $(document).on("click", "#btnShowFormUpdate", function() {
                    var row = $(this).closest("tr");
                    var tiennghiId = $(this).data("tiennghi-id");
                    var name = row.find("td:eq(2)").text().trim();
                    // var tiennghiId = row.find("td:eq(0)").text().trim();

                    $('#updateTiennghiFormContainer').find("#tiennghiId").val(tiennghiId);
                    $('#updateTiennghiFormContainer').find("#updated-name").val(name);

                    $('.overlay').show();
                    $('.overlay').addClass("active");
                    $('#updateTiennghiFormContainer').show();
                });
            });

            // Xử lý sự kiện khi nhấn nút "Xóa"
            $(document).on("click", "#delete-btn", function() {
                var rowToDelete = $(this).closest("tr");
                var tiennghiId = $(this).data("tiennghi-id");
                // var tiennghiId = rowToDelete.find("td:first").text().trim();
                var confirmation = confirm("Bạn có chắc chắn muốn xóa tiện nghi này không?");

                if (confirmation) {
                    $.ajax({
                        type: "POST",
                        url: "xuly/delete.php",
                        data: {
                            tiennghiId: tiennghiId
                        },
                        success: function(response) {
                            if (response === "success") {
                                rowToDelete.remove();
                                alert("Tiện nghi đã được xóa thành công!");
                            } else {
                                alert("Xóa tiện nghi không thành công!");
                            }
                        }
                    });
                }
            });

            // Close Button
            $('#btnCloseAdd').click(function() {
                $('.overlay').hide();
                $('#addTiennghiFormContainer').hide();
            });
            $('#btnCloseUpdate').click(function() {
                $('.overlay').hide();
                $('#updateTiennghiFormContainer').hide();
            });
        </script>


        <?php
        mysqli_close($conn);
        include "footer.php" ?>
</body>

</html>