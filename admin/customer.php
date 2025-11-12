<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    include "connect.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['addCustomer'])) {
            // Xử lý form thêm khách hàng mới
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $date = $_POST['date'];
            $formatted_birthdate = date('Y-m-d', strtotime($date));
            $currentTimestamp = time();
            $formattedDatetime = date('Y-m-d H:i:s', $currentTimestamp);

            // Query để thêm khách hàng mới vào cơ sở dữ liệu
            $insertQuery = "INSERT INTO User (Fullname, Email, Phone, Address, Birthday, status, timeRegister, Avatar) VALUES ('$name', '$email', '$phone', '$address', '$formatted_birthdate', 1, '$currentTimestamp','user.png')";

            if (mysqli_query($conn, $insertQuery)) {
                echo '<script language="javascript">';
                echo 'alert("Bạn đã thêm khách hàng mới thành công!");';
                echo 'window.location.href = "customer.php";'; // Chuyển hướng về trang danh sách khách hàng sau khi thêm thành công
                echo '</script>';
            } else {
                echo '<script language="javascript">alert("Thêm khách hàng mới thất bại.");</script>';
            }
        } elseif (isset($_POST['updateCustomer'])) {
            // Xử lý form cập nhật thông tin khách hàng
            $customerId = $_POST['customerId'];
            $name = $_POST['updated-name'];
            $email = $_POST['updated-email'];
            $phone = $_POST['updated-phone'];
            $address = $_POST['updated-address'];
            $date = $_POST['updated-date'];
            $formatted_birthdate = date('Y-m-d', strtotime($date));
            $currentTimestamp = time();

            $updateQuery = "UPDATE User SET Fullname='$name', Email='$email', Phone='$phone', Address='$address', Birthday='$formatted_birthdate', lastUpdated='$currentTimestamp' WHERE id='$customerId'";

            if (mysqli_query($conn, $updateQuery)) {
                echo '<script language="javascript">';
                echo 'alert("Bạn đã cập nhật thông tin khách hàng thành công!");';
                echo 'window.location.href = "customer.php";'; // Chuyển hướng về trang danh sách khách hàng sau khi cập nhật thành công
                echo '</script>';
            } else {
                echo '<script language="javascript">alert("Cập nhật thông tin khách hàng thất bại.");</script>';
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
                                            <h3 class="card-title" style="margin-top: 20px;">Quản Lý Khách Hàng</h3>
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
                                                <i class="typcn typcn-document-add btn-icon-append" style="margin: -2px 2px 0 0;"></i>   Thêm
                                            </button>
                                        </div>
                                    </nav>
                                    <div class="table-responsive">
                                        <table class="table table-striped project-orders-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Avatar</th>
                                                    <th>Họ tên</th>
                                                    <th>Email</th>
                                                    <th>SĐT</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Ngày sinh</th>
                                                    <th>Ngày đăng ký</th>
                                                    <th>Cập Nhật Lần Cuối</th>
                                                    <th>Tình trạng</th>
                                                    <th>Hành Động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="danhsach">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT * FROM User ORDER BY id DESC ");
                                                $i = 1;
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                    <tr>
                                                        <td style="display: none;"><?php echo $row['id']; ?></td>
                                                        <td><?php echo $i ?></td>
                                                        <td><img style="width: 60px; height: 60px;" src="../uploads/user/<?php if (!empty($row['Avatar'])) {
                                                                                            echo $row['Avatar'];
                                                                                        } else {
                                                                                            echo 'user.png'; // Hiển thị dữ liệu mặc định khi $row['img'] rỗng
                                                                                        } ?>" alt=""></td>
                                                        <td><?php echo $row['Fullname'] ?></td>
                                                        <td><?php echo $row['Email'] ?></td>
                                                        <td><?php echo $row['Phone'] ?></td>
                                                        <td><?php echo $row['Address'] ?></td>
                                                        <td><?php echo date("d-m-Y", strtotime($row['Birthday'])) ?></td>
                                                        <td><?php echo date("d-m-Y H:i:s", $row['timeRegister']) ?></td>
                                                        <td><?php if($row['lastUpdated']!="") echo date("d-m-Y H:i:s", $row['lastUpdated']) ?></td>
                                                        <td>
                                                            <?php if ($row['status'] == 0) { ?>
                                                                <button class="btn btn-danger customer-status" id="btnStatus"  data-customer-id="<?php echo $row['id']; ?>">Vô hiệu hóa</button>
                                                            <?php } else { ?>
                                                                <button class="btn btn-success customer-status" id="btnStatus"  data-customer-id="<?php echo $row['id']; ?>">Hoạt động</button>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <button type="button" data-customer-id="<?php echo $row['id']; ?>" class="btn btn-info btn-sm btn-icon-text mr-3" id="btnShowFormUpdate">
                                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                                </button>
                                                                <button name="delete-btn" id="delete-btn" data-customer-id="<?php echo $row['id']; ?>" type="button" class="btn btn-danger btn-sm btn-icon-text">
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

        <!-- Add Customer Form  -->
        <div class="col-md-6 grid-margin stretch-card" id="addCustomerFormContainer" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" align="center">Thêm Khách Hàng</h4>
                    <form class="forms-sample" action="customer.php" method="POST">
                        <div class="form-group">
                            <label for="name">Họ và Tên</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Số Điện Thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="address">Địa Chỉ</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="form-group">
                            <label for="date">Ngày Sinh</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>
                        <input type="hidden" name="addCustomer" value="true">
                        <button type="submit" class="btn btn-primary mr-2" id="btnAddCustomer">Add</button>
                        <button type="button" class="btn btn-light" id="btnCloseAdd">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Update Customer Form  -->
        <div class="col-md-6 grid-margin stretch-card" id="updateCustomerFormContainer" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" align="center">Cập Nhật Thông Tin Khách Hàng</h4>
                    <form class="forms-sample" action="customer.php" method="POST">
                        <div class="form-group">
                            <label for="updated-name">Họ và Tên</label>
                            <input type="text" class="form-control" id="updated-name" name="updated-name">
                        </div>
                        <div class="form-group">
                            <label for="updated-email">Email</label>
                            <input type="email" class="form-control" id="updated-email" name="updated-email">
                        </div>
                        <div class="form-group">
                            <label for="updated-phone">Số Điện Thoại</label>
                            <input type="text" class="form-control" id="updated-phone" name="updated-phone">
                        </div>
                        <div class="form-group">
                            <label for="updated-address">Địa Chỉ</label>
                            <input type="text" class="form-control" id="updated-address" name="updated-address">
                        </div>
                        <div class="form-group">
                            <label for="updated-date">Ngày Sinh</label>
                            <input type="text" class="form-control" id="updated-date" name="updated-date">
                        </div>
                        <input type="hidden" name="updateCustomer" value="true">
                        <input type="hidden" id="customerId" name="customerId">
                        <button type="submit" class="btn btn-primary mr-2" id="btnUpdateCustomer">Update</button>
                        <button type="button" class="btn btn-light" id="btnCloseUpdate">Cancel</button>
                    </form>
                </div>
            </div>
        </div>


        <script>
            // Hiển thị Form thêm khách hàng
            $(document).ready(function() {
                $(document).on("click", "#btnAdd", function() {
                    $('.overlay').show();
                    $('.overlay').addClass("active");
                    $('#addCustomerFormContainer').show();
                });
            });

            // xử lý tìm kiếm
            $('.timkiem').keyup(function() {
                var txt = $('.timkiem').val();
                $.post('xuly/timkiem-customer.php', {
                    data: txt
                }, function(data) {
                    $('.danhsach').html(data);
                })
            });

            // Cập nhật tình trạng tài khoản khách hàng
            $(document).ready(function() {
                $(".customer-status").click(function() {
                    var customerId = $(this).data("customer-id");
                    // var customerId = $(this).closest("tr").find("td:first").text();
                    var status = $(this).text().trim() === "Hoạt động" ? 0 : 1;
                    var clickedBtn = $(this);

                    $.ajax({
                        type: "POST",
                        url: "xuly/update-status.php",
                        data: {
                            customerId: customerId,
                            status: status
                        },
                        success: function(response) {
                            if (response === "success") {
                                var newStatus = status === 0 ? "Vô hiệu hóa" : "Hoạt động";
                                // Thay đổi lớp CSS để chuyển màu và kiểu nút
                                if (status === 0) {
                                    clickedBtn.removeClass("btn-success").addClass("btn-danger");
                                } else {
                                    clickedBtn.removeClass("btn-danger").addClass("btn-success");
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
            // Script JavaScript
            $(document).ready(function() {
                // Kích hoạt jQuery Datepicker cho trường input có id là updated-date
                $('#updated-date').datepicker({
                    dateFormat: 'dd-mm-yy', // Định dạng ngày tháng
                    changeMonth: true,
                    changeYear: true
                    // Các tùy chọn khác nếu cần
                });
            });

            $(document).ready(function() {
                // Xử lý sự kiện click cho nút "Update" trong mỗi hàng
                $(document).on("click", "#btnShowFormUpdate", function() {
                    // Lấy thông tin từ hàng tương ứng
                    var row = $(this).closest("tr");
                    var name = row.find("td:eq(3)").text().trim();
                    var email = row.find("td:eq(4)").text().trim();
                    var phone = row.find("td:eq(5)").text().trim();
                    var address = row.find("td:eq(6)").text().trim();
                    var birthday = row.find("td:eq(7)").text().trim();
                    // var customerId = row.find("td:eq(0)").text().trim();
                    var customerId = $(this).data("customer-id");

                    // Điền thông tin vào các trường input trong form cập nhật
                    $('#updateCustomerFormContainer').find("#customerId").val(customerId);
                    $('#updateCustomerFormContainer').find("#updated-name").val(name);
                    $('#updateCustomerFormContainer').find("#updated-email").val(email);
                    $('#updateCustomerFormContainer').find("#updated-phone").val(phone);
                    $('#updateCustomerFormContainer').find("#updated-address").val(address);
                    $('#updateCustomerFormContainer').find("#updated-date").val(birthday);

                    // Hiển thị form cập nhật thông tin khách hàng
                    $('.overlay').show();
                    $('.overlay').addClass("active");
                    $('#updateCustomerFormContainer').show();
                });
            });

            // Xóa khách hàng
            $(document).on("click", "#delete-btn", function() {
                var rowToDelete = $(this).closest("tr"); // Lưu trữ dòng để xóa
                // var customerId = rowToDelete.find("td:first").text().trim(); 
                var customerId = $(this).data("customer-id");
                var confirmation = confirm("Bạn có chắc chắn muốn xóa khách hàng này không?");

                if (confirmation) {
                    $.ajax({
                        type: "POST",
                        url: "xuly/delete.php",
                        data: {
                            customerId: customerId
                        },
                        success: function(response) {
                            if (response === "success") {
                                rowToDelete.remove();
                                alert("Khách hàng đã được xóa thành công!");
                            } else {
                                alert("Xóa khách hàng không thành công!");
                            }
                        }
                    });
                }
            });

            // Close Button
            $('#btnCloseAdd').click(function() {
                $('.overlay').hide();
                $('#addCustomerFormContainer').hide();
            });
            $('#btnCloseUpdate').click(function() {
                $('.overlay').hide();
                $('#updateCustomerFormContainer').hide();
            });
        </script>


        <?php
        mysqli_close($conn);
        include "footer.php" ?>
</body>

</html>