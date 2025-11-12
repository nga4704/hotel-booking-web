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
        if (isset($_POST['editContact'])) {
            $contactId = $_POST['contactId'];
            $address = $_POST['address'];
            $map = $_POST['map'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $social = $_POST['social'];

            $updateQuery = "UPDATE contact SET address='$address', map='$map', phone='$phone', email='$email', social = '$social' WHERE id='$contactId'";

            if (mysqli_query($conn, $updateQuery)) {
                echo '<script language="javascript">';
                echo 'alert("Bạn đã cập nhật thành công!");';
                echo 'window.location.href = "setting-contact.php";';
                echo '</script>';
            } else {
                echo "Error: " . mysqli_error($conn);
                echo '<script language="javascript">alert("Cập nhật không thành công.");</script>';
            }
        } else {
            echo "Error: " . mysqli_error($conn);
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
                                        <h3 class="card-title" style="margin-top: 20px;">Thiết Lập Liên Hệ</h3>
                                    </div>
                                </nav>
                                <div class="table-responsive" style="margin-top: -15px;">
                                    <table class="table table-striped project-orders-table">
                                        <thead>
                                            <tr>
                                                <th>Địa Chỉ</th>
                                                <th>Google Map</th>
                                                <th>Số Điện Thoại</th>
                                                <th>Email</th>
                                                <th>Mạng Xã Hội</th>
                                                <th>Sửa</th>
                                            </tr>
                                        </thead>
                                        <tbody class="danhsach">
                                            <?php
                                            $result = mysqli_query($conn, "SELECT * FROM contact");
                                            $i = 1;
                                            while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                                <tr>
                                                    <td style="max-width: 150px;white-space: wrap;"><?php echo $row['address']; ?></td>
                                                    <!-- <td>
                                                        <div class="map">
                                                            <iframe src="<?php echo $row['map'] ?>" width="800" height="400" style="border:0;" allowfullscreen=""></iframe>
                                                        </div>
                                                    </td> -->
                                                    <td style="max-width: 600px;white-space: wrap;"><p><?php echo $row['map']; ?><p></td>

                                                    <td><?php echo $row['phone'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td><?php echo $row['social'] ?></td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <button name="btnEditContact" id="btnEditContact" data-contact-id="<?php echo $row['id']; ?>" type="button" class="btn btn-info btn-sm btn-icon-text btnEditContact">
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

    <!-- Edit Contact Form  -->
    <div class="col-md-6 grid-margin stretch-card" id="formEditContact" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" align="center">Sửa Thông Tin</h4>
                <form class="forms-sample" action="setting-contact.php" method="POST">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="contactId" name="contactId">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa Chỉ</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="map">Google Map</label>
                        <textarea class="form-control" id="map" name="map"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số Điện Thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="social">Mạng Xã Hội</label>
                        <input type="text" class="form-control" id="social" name="social">
                    </div>
                    <!-- <div class="form-group">
                        <label for="phone"></label>
                        <textarea class="form-control" id="phone" name="phone"></textarea>
                    </div> -->

                    <input type="hidden" name="editContact" value="true">
                    <button type="submit" class="btn btn-primary mr-2" id="btnEditContact">Submit</button>
                    <button type="button" class="btn btn-light" id="btnCloseContact">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    <script>

        $(document).ready(function() {
            // Xử lý sự kiện click cho nút "Update" trong mỗi hàng
            $(document).on("click", ".btnEditContact", function() {
                // Lấy thông tin từ hàng tương ứng
                var row = $(this).closest("tr");
                var address = row.find("td:eq(0)").text().trim();
                var map = row.find("td:eq(1)").text().trim();
                var phone = row.find("td:eq(2)").text().trim();
                var email = row.find("td:eq(3)").text().trim();
                var social = row.find("td:eq(4)").text().trim();
                var contactId = $(this).data("contact-id");

                // Điền thông tin vào các trường input trong form cập nhật
                $('#formEditContact').find("#contactId").val(contactId);
                $('#formEditContact').find("#address").val(address);
                $('#formEditContact').find("#map").val(map);
                $('#formEditContact').find("#phone").val(phone);
                $('#formEditContact').find("#email").val(email);
                $('#formEditContact').find("#social").val(social);

                // Hiển thị form cập nhật thông tin khách hàng
                $('.overlay').show();
                $('.overlay').addClass("active");
                $('#formEditContact').show();
            });
        });
        $('#btnCloseContact').click(function() {
            $('.overlay').hide();
            $('#formEditContact').hide();
        });
    </script>

    <?php
    mysqli_close($conn);
    include "footer.php" ?>
</body>

</html>