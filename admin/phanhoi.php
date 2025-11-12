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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send'])) {
        $phanhoiId = $_POST['phanhoiId'];
        $title = $_POST['title'];
        $message = $_POST['message'];

        // Fetch email of the user from feedback id
        $query = "SELECT email FROM phanhoi WHERE id = $phanhoiId";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $userEmail = $row['email'];

            // Send email
            $to = $userEmail;
            $subject = $title;
            $body = $message;
            $headers = "From: ngahtt.22itb@vku.udn.vn";

            if (mail($to, $subject, $body, $headers)) {
                echo '<script language="javascript">';
                echo 'alert("Gửi đi thành công!");';
                echo 'window.location.href = "phanhoi.php";';
                echo '</script>';
            } else {
                echo '<script language="javascript">';
                echo 'alert("Gửi đi không thành công!");';
                echo 'window.location.href = "phanhoi.php";';
                echo '</script>';
            }
        } else {
            echo "Error fetching email.";
        }
    } else {
        echo "Invalid request.";
    }

    mysqli_close($conn);
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
                                            <h3 class="card-title" style="margin-top: 20px;">Phản Hồi</h3>
                                        </div>
                                        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                                            <ul class="navbar-nav navbar-nav-right" style=" display: flex; justify-content: space-between;">
                                                <li class="nav-item nav-search d-none d-md-block mr-0" style="color: black;">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input filter-radio" name="filter" id="filter" value="unread">
                                                            Chưa đọc
                                                            <i class="input-helper"></i></label>
                                                    </div>
                                                </li>
                                                <li class="nav-item nav-search d-none d-md-block mr-0" style="color: black;">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input filter-radio" name="filter" id="filter" value="read">
                                                            Đã đọc
                                                            <i class="input-helper"></i></label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </nav>
                                    <div class="table-responsive">
                                        <table class="table table-striped project-orders-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>User</th>
                                                    <th>Email</th>
                                                    <th>Title</th>
                                                    <th>Message</th>
                                                    <th>Ngày Gửi</th>
                                                    <th>Trạng Thái</th>
                                                    <th>Hành Động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="danhsach">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT * FROM phanhoi ORDER BY id DESC ");
                                                $i = 1;
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $result2 = mysqli_query($conn, "SELECT * FROM user WHERE id = " . $row['idUser']);
                                                    $row2 = mysqli_fetch_assoc($result2);
                                                ?>
                                                    <tr>
                                                        <td style="display: none;"><?php echo $row['id']; ?></td>
                                                        <td><?php echo $i ?></td>
                                                        <td style="vertical-align: middle;  text-align: center; "><img src="../uploads/user/<?php echo $row2['Avatar'] ?>"><br><br>
                                                            <p><?php echo $row2['Fullname'] ?></p>
                                                        </td>
                                                        <td><?php echo $row['email'] ?></td>
                                                        <td><?php echo $row['title'] ?></td>
                                                        <td style="min-width: 400px;white-space: wrap;text-align: center;">
                                                            <p><?php echo $row['message'] ?></p>
                                                        </td>
                                                        <td><?php echo date("d-m-Y H:i:s", $row['timeSend']) ?></td>
                                                        <td>
                                                            <?php if ($row['status'] == 0) { ?>
                                                                <button class="btn btn-secondary phanhoi-status" id="btnStatus" data-phanhoi-id="<?php echo $row['id']; ?>">Chưa đọc</button>
                                                            <?php } else { ?>
                                                                <button class="btn btn-success phanhoi-status" id="btnStatus" data-phanhoi-id="<?php echo $row['id']; ?>">Đã đọc</button>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <button type="button" data-phanhoi-id="<?php echo $row['id']; ?>" class="btn btn-info btn-sm btn-icon-text mr-3" id="btnShowFormSend">
                                                                    <i class="typcn typcn-location-arrow-outline btn-icon-append"></i> Trả lời
                                                                </button>
                                                                <button name="delete-btn" id="delete-btn" data-phanhoi-id="<?php echo $row['id']; ?>" type="button" class="btn btn-danger btn-sm btn-icon-text">
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

        <!-- Update phanhoi Form  -->
        <div class="col-md-6 grid-margin stretch-card" id="sendPhanhoiFormContainer" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" align="center">Trả Lời Phản Hồi</h4>
                    <form class="forms-sample" action="phanhoi.php" method="POST">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="message"></textarea>
                        </div>
                        <input type="hidden" name="send" value="true">
                        <input type="hidden" id="phanhoiId" name="phanhoiId">
                        <button type="submit" class="btn btn-primary mr-2" id="btnSend">Send</button>
                        <button type="button" class="btn btn-light" id="btnClose">Cancel</button>
                    </form>
                </div>
            </div>
        </div>


        <script>
            // lọc danh sách
            $('.filter-radio').change(function() {
                var filterValue = $(this).val();

                $.ajax({
                    type: "POST",
                    url: "xuly/loc-phanhoi.php",
                    data: {
                        filter: filterValue
                    },
                    success: function(data) {
                        $('.danhsach').html(data);
                    }
                });
            });

            // Cập nhật tình trạng 
            $(document).ready(function() {
                $(".phanhoi-status").click(function() {
                    var phanhoiId = $(this).data("phanhoi-id");
                    var status = $(this).text().trim() === "Đã đọc" ? 0 : 1;
                    var clickedBtn = $(this);

                    $.ajax({
                        type: "POST",
                        url: "xuly/update-status.php",
                        data: {
                            phanhoiId: phanhoiId,
                            status: status
                        },
                        success: function(response) {
                            if (response === "success") {
                                var newStatus = status === 0 ? "Chưa đọc" : "Đã đọc";
                                if (status === 0) {
                                    clickedBtn.removeClass("btn-success").addClass("btn-secondary");
                                } else {
                                    clickedBtn.removeClass("btn-secondary").addClass("btn-success");
                                }
                                clickedBtn.text(newStatus);
                            } else {
                                alert("Cập nhật trạng thái không thành công!");
                            }
                        }
                    });
                });
            });

            $(document).ready(function() {
                $(document).on("click", "#btnShowFormSend", function() {
                    var phanhoiId = $(this).data("phanhoi-id");
                    $('#sendPhanhoiFormContainer').find("#phanhoiId").val(phanhoiId);

                    $('.overlay').show();
                    $('.overlay').addClass("active");
                    $('#sendPhanhoiFormContainer').show();
                });
            });

            // Xử lý sự kiện khi nhấn nút "Xóa"
            $(document).on("click", "#delete-btn", function() {
                var rowToDelete = $(this).closest("tr");
                var phanhoiId = $(this).data("phanhoi-id");
                var confirmation = confirm("Bạn có chắc chắn muốn xóa phản hồi này không?");

                if (confirmation) {
                    $.ajax({
                        type: "POST",
                        url: "xuly/delete.php",
                        data: {
                            phanhoiId: phanhoiId
                        },
                        success: function(response) {
                            if (response === "success") {
                                rowToDelete.remove();
                                alert("Phản hồi đã được xóa thành công!");
                            } else {
                                alert("Xóa phản hồi không thành công!");
                            }
                        }
                    });
                }
            });

            // Close Button
            $('#btnClose').click(function() {
                $('.overlay').hide();
                $('#sendPhanhoiFormContainer').hide();
            });
        </script>


        <?php
        mysqli_close($conn);
        include "footer.php" ?>
</body>

</html>