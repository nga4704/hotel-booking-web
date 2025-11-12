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
        if (isset($_POST['addService'])) {
            $icon = $_POST['icon'];
            $name = $_POST['name'];
            $detail = $_POST['detail'];

            $insertQuery = "INSERT INTO services (icon, name, detail, status) VALUES ('$icon', '$name', '$detail',  1)";

            if (mysqli_query($conn, $insertQuery)) {
                echo '<script language="javascript">';
                echo 'alert("Bạn đã thêm thành công!");';
                echo 'window.location.href = "services.php";';
                echo '</script>';
            } else {
                echo '<script language="javascript">alert("Thêm dịch vụ mới không thành công.");</script>';
            }
        } elseif (isset($_POST['updateService'])) {
            $serviceId = $_POST['serviceId'];
            $icon = $_POST['updated-icon'];
            $name = $_POST['updated-name'];
            $detail = $_POST['updated-detail'];

            $updateQuery = "UPDATE services SET icon='$icon', name='$name', detail='$detail' WHERE id='$serviceId'";

            if (mysqli_query($conn, $updateQuery)) {
                echo '<script language="javascript">';
                echo 'alert("Bạn đã cập nhật thành công!");';
                echo 'window.location.href = "services.php";';
                echo '</script>';
            } else {
                echo '<script language="javascript">alert("Cập nhật không thành công.");</script>';
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
                                            <h3 class="card-title" style="margin-top: 20px;">Quản Lý Dịch Vụ</h3>
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
                                                    <th>Icon</th>
                                                    <th>Tên Dịch Vụ</th>
                                                    <th>Mô Tả</th>
                                                    <th>Tình trạng</th>
                                                    <th>Hành Động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="danhsach">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT * FROM services ORDER BY id DESC ");
                                                $i = 1;
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                    <tr>
                                                        <td style="display: none;"><?php echo $row['id']; ?></td>
                                                        <td><?php echo $i ?></td>
                                                        <td><i class="<?php echo $row['icon'] ?>"></i></td>
                                                        <td><?php echo $row['name'] ?></td>
                                                        <td style="max-width: 400px;white-space: wrap;">
                                                            <p><?php echo $row['detail'] ?>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <?php if ($row['status'] == 0) { ?>
                                                                <button class="btn btn-secondary service-status" id="btnStatus" data-service-id="<?php echo $row['id']; ?>">Tạm ngừng</button>
                                                            <?php } else { ?>
                                                                <button class="btn btn-primary service-status" id="btnStatus" data-service-id="<?php echo $row['id']; ?>">Hoạt động</button>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <button type="button" data-service-id="<?php echo $row['id']; ?>" class="btn btn-info btn-sm btn-icon-text mr-3" id="btnShowFormUpdate">
                                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                                </button>
                                                                <button name="delete-btn" id="delete-btn" data-service-id="<?php echo $row['id']; ?>" type="button" class="btn btn-danger btn-sm btn-icon-text">
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

        <!-- Add service Form  -->
        <div class="col-md-6 grid-margin stretch-card" id="addServiceFormContainer" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" align="center">Thêm Dịch Vụ</h4>
                    <form class="forms-sample" action="services.php" method="POST">
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <select class="form-control" id="icon" name="icon">
                                <option value="flaticon-001-luggage"><i class="flaticon-001-luggage"></i> flaticon-001-luggage</option>
                                <option value="flaticon-002-breakfast"><i class="flaticon-002-breakfast"></i> flaticon-002-breakfast</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Tên Dịch Vụ</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="detail">Mô tả</label>
                            <textarea class="form-control" id="detail" name="detail"></textarea>
                        </div>

                        <input type="hidden" name="addService" value="true">
                        <button type="submit" class="btn btn-primary mr-2" id="btnAddService">Add</button>
                        <button type="button" class="btn btn-light" id="btnCloseAdd">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Update Service Form  -->
        <div class="col-md-6 grid-margin stretch-card" id="updateServiceFormContainer" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" align="center">Cập Nhật Thông Tin Dịch Vụ</h4>
                    <form class="forms-sample" action="services.php" method="POST">
                        <div class="form-group">
                            <label for="updated-icon">Icon</label>
                            <select class="form-control" id="updated-icon" name="updated-icon">
                                <option value="flaticon-001-luggage"><i class="flaticon-001-luggage"></i> flaticon-001-luggage</option>
                                <option value="flaticon-002-breakfast"><i class="flaticon-002-breakfast"></i> flaticon-002-breakfast</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="updated-name">Tên Dịch Vụ</label>
                            <input type="text" class="form-control" id="updated-name" name="updated-name">
                        </div>
                        <div class="form-group">
                            <label for="updated-detail">Mô tả</label>
                            <textarea class="form-control" id="updated-detail" name="updated-detail"></textarea>
                        </div>
                        <input type="hidden" name="updateService" value="true">
                        <input type="hidden" id="serviceId" name="serviceId">
                        <button type="submit" class="btn btn-primary mr-2" id="btnUpdateService">Update</button>
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
                    $('#addServiceFormContainer').show();
                });
            });

            // xử lý tìm kiếm
            $('.timkiem').keyup(function() {
                var txt = $('.timkiem').val();
                $.post('xuly/timkiem-service.php', {
                    data: txt
                }, function(data) {
                    $('.danhsach').html(data);
                })
            });

            // Cập nhật tình trạng 
            $(document).ready(function() {
                $(".service-status").click(function() {
                    // var serviceId = $(this).closest("tr").find("td:first").text();
                    var serviceId = $(this).data("service-id");
                    var status = $(this).text().trim() === "Hoạt động" ? 0 : 1;
                    var clickedBtn = $(this);

                    $.ajax({
                        type: "POST",
                        url: "xuly/update-status.php",
                        data: {
                            serviceId: serviceId,
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
                    var serviceId = $(this).data("service-id");
                    var icon = row.find("td:eq(2) i").attr("class");
                    var name = row.find("td:eq(3)").text().trim();
                    var detail = row.find("td:eq(4)").text().trim();
                    // var serviceId = row.find("td:eq(0)").text().trim();

                    $('#updateServiceFormContainer').find("#serviceId").val(serviceId);
                    $('#updateServiceFormContainer').find("#updated-name").val(name);
                    $('#updateServiceFormContainer').find("#updated-detail").val(detail);
                    $('#updateServiceFormContainer').find("#updated-icon i").attr("class", icon);

                    $('.overlay').show();
                    $('.overlay').addClass("active");
                    $('#updateServiceFormContainer').show();
                });
            });

            // Xử lý sự kiện khi nhấn nút "Xóa"
            $(document).on("click", "#delete-btn", function() {
                var rowToDelete = $(this).closest("tr");
                // var serviceId = rowToDelete.find("td:first").text().trim();
                var serviceId = $(this).data("service-id");
                var confirmation = confirm("Bạn có chắc chắn muốn xóa dịch vụ này không?");

                if (confirmation) {
                    $.ajax({
                        type: "POST",
                        url: "xuly/delete.php",
                        data: {
                            serviceId: serviceId
                        },
                        success: function(response) {
                            if (response === "success") {
                                rowToDelete.remove();
                                alert("Dịch vụ đã được xóa thành công!");
                            } else {
                                alert("Xóa dịch vụ không thành công!");
                            }
                        }
                    });
                }
            });

            // Close Button
            $('#btnCloseAdd').click(function() {
                $('.overlay').hide();
                $('#addServiceFormContainer').hide();
            });
            $('#btnCloseUpdate').click(function() {
                $('.overlay').hide();
                $('#updateServiceFormContainer').hide();
            });
        </script>


        <?php
        mysqli_close($conn);
        include "footer.php" ?>
</body>

</html>