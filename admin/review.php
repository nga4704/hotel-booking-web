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
                                <nav style="margin-top: -20px; background-color: white;" class=" navbar-breadcrumb col-xl-12 col-12 d-flex flex-row p-0">
                                    <div class="navbar-links-wrapper d-flex align-items-stretch">
                                        <h3 class="card-title" style="margin-top: 20px;">Quản Lý Đánh Giá Phòng</h3>
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
                                </nav>
                                <div class="table-responsive">
                                    <table class="table table-striped project-orders-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tên Phòng</th>
                                                <th>Tên Khách Hàng</th>
                                                <th>Đánh Giá</th>
                                                <th>Nhận Xét</th>
                                                <th>Ngày</th>
                                                <th>Hành Động</th>
                                            </tr>
                                        </thead>
                                        <tbody class="danhsach">
                                            <?php
                                            $result = mysqli_query($conn, "SELECT * FROM review ORDER BY id DESC ");
                                            $i = 1;
                                            while ($row = mysqli_fetch_array($result)) {
                                                $result1 = mysqli_query($conn, "SELECT * FROM room WHERE id = " . $row['idRoom']);
                                                $row1 = mysqli_fetch_assoc($result1);
                                                $result2 = mysqli_query($conn, "SELECT * FROM user WHERE id = " . $row['idUser']);
                                                $row2 = mysqli_fetch_assoc($result2);
                                            ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $row1['name'] ?></td>
                                                    <td><?php echo $row2['Fullname'] ?></td>
                                                    <td><?php $star = $row['star'];
                                                        if ($star == 5) {
                                                            echo 'Rất tốt';
                                                        } elseif ($star == 4) {
                                                            echo 'Tốt';
                                                        } elseif ($star == 3) {
                                                            echo 'Bình thường';
                                                        } elseif ($star == 2) {
                                                            echo 'Tệ';
                                                        } elseif ($star == 1) {
                                                            echo 'Rất tệ';
                                                        }
                                                        ?></td>
                                                    <td style="min-width: 200px;white-space: wrap;text-align: center;"><p><?php echo $row['content'] ?></p></td>
                                                    <td><?php echo date("d-m-Y H:i:s", $row['timePost']) ?></td>
                                                    <td style="display: none;"><?php echo $row['id']; ?></td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <button name="delete-btn" id="delete-btn" data-review-id="<?php echo $row['id']; ?>" type="button" class="btn btn-danger btn-sm btn-icon-text">
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

    <script>
        // xử lý tìm kiếm
        $('.timkiem').keyup(function() {
            var txt = $('.timkiem').val();
            $.post('xuly/timkiem-review.php', {
                data: txt
            }, function(data) {
                $('.danhsach').html(data);
            })
        });

        // Xóa khách hàng
        $(document).on("click", "#delete-btn", function() {
            var rowToDelete = $(this).closest("tr"); // Lưu trữ dòng để xóa
            // var reviewId = rowToDelete.find("td:first").text().trim(); 
            var reviewId =  $(this).data("review-id"); 
            var confirmation = confirm("Bạn có chắc chắn muốn xóa đánh giá này không?");

            if (confirmation) {
                $.ajax({
                    type: "POST",
                    url: "xuly/delete.php",
                    data: {
                        reviewId: reviewId
                    },
                    success: function(response) {
                        if (response === "success") {
                            rowToDelete.remove();
                            alert("Đánh giá đã được xóa thành công!");
                        } else {
                            alert("Xóa đánh giá không thành công!");
                        }
                    }
                });
            }
        });
    </script>

    <?php
    mysqli_close($conn);
    include "footer.php" ?>
</body>

</html>