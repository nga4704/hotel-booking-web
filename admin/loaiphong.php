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
        if (isset($_POST['addLoaiphong'])) {
            $targetDirectory = "../uploads/category/";
            $fileExtension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $idQuery = mysqli_query($conn, "SELECT MAX(id) AS max_id FROM category_room");
            $idRow = mysqli_fetch_assoc($idQuery);
            $nextId = $idRow['max_id'] + 1;
            $targetFile = $targetDirectory . "room-b" . $nextId . "." . $fileExtension;
            $nameFile = "room-b" . $nextId . "." . $fileExtension;

            $image = $_FILES['image'];
            $name = $_POST['name'];
            $size = $_POST['size'];
            $bed = $_POST['bed'];
            $capacity = $_POST['capacity'];
            $price = $_POST['price'];

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $insertQuery = "INSERT INTO category_room (image, name, size, bed, capacity, price) VALUES ('$nameFile', '$name', '$size', '$bed', '$capacity', '$price')";

                if (mysqli_query($conn, $insertQuery)) {
                    echo '<script language="javascript">';
                    echo 'alert("Bạn đã thêm loại phòng mới thành công!");';
                    echo 'window.location.href = "loaiphong.php";';
                    echo '</script>';
                } else {
                    echo '<script language="javascript">alert("Thêm loại phòng mới thất bại.");</script>';
                }
            } else {
                echo "Error uploading file.";
            }
        } elseif (isset($_POST['updateLoaiphong'])) {
            $loaiphongId = $_POST['loaiphongId'];
            $image = isset($_FILES['update-image']) ? $_FILES['update-image'] : null;
            $name = $_POST['update-name'];
            $size = $_POST['update-size'];
            $bed = $_POST['update-bed'];
            $capacity = $_POST['update-capacity'];
            $price = $_POST['update-price'];

            $targetDirectory = "../uploads/category/";
            $fileExtension = !empty($image['name']) ? pathinfo($image['name'], PATHINFO_EXTENSION) : '';

            // Check if an image has been uploaded
            if (!empty($fileExtension)) {
                $targetFile = $targetDirectory . "room-b" . $loaiphongId . "." . $fileExtension;
                $nameFile = "room-b" . $loaiphongId . "." . $fileExtension;

                $oldImageFile = $targetDirectory . "room-b" . $loaiphongId . ".*";
                array_map('unlink', glob($oldImageFile));

                if (move_uploaded_file($_FILES["update-image"]["tmp_name"], $targetFile)) {
                    // Update database with new image file
                    $updateQuery = "UPDATE category_room SET image='$nameFile', name='$name', size='$size', bed='$bed', capacity='$capacity', price='$price' WHERE id='$loaiphongId'";

                    if (mysqli_query($conn, $updateQuery)) {
                        echo '<script language="javascript">';
                        echo 'alert("Bạn đã cập nhật thành công!");';
                        echo 'window.location.href = "loaiphong.php";';
                        echo '</script>';
                    } else {
                        echo '<script language="javascript">alert("Cập nhật không thành công.");</script>';
                    }
                } else {
                    echo "Error uploading file.";
                }
            } else {
                // No new image uploaded, update other fields only
                $updateQuery = "UPDATE category_room SET name='$name', size='$size', bed='$bed', capacity='$capacity', price='$price' WHERE id='$loaiphongId'";

                if (mysqli_query($conn, $updateQuery)) {
                    echo '<script language="javascript">';
                    echo 'alert("Bạn đã cập nhật thành công!");';
                    echo 'window.location.href = "loaiphong.php";';
                    echo '</script>';
                } else {
                    echo '<script language="javascript">alert("Cập nhật không thành công.");</script>';
                }
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
                                            <h3 class="card-title" style="margin-top: 20px;">Quản Lý Loại Phòng</h3>
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
                                                    <th>Hình Ảnh</th>
                                                    <th>Tên Loại Phòng</th>
                                                    <th>Diện Tích</th>
                                                    <th>Loại Giường</th>
                                                    <th>Sức Chứa</th>
                                                    <th>Mức Giá</th>
                                                    <th>Hành Động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="danhsach">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT * FROM category_room");
                                                $i = 1;
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                    <tr>
                                                        <td style="display: none;"><?php echo $row['id']; ?></td>
                                                        <td><?php echo $i ?></td>
                                                        <td><img style="width: 150px; height: 180px; object-fit: cover; border-radius: 0;" src="../uploads/category/<?php echo isset($row['image']) ? $row['image'] : ''; ?>"></td>
                                                        <td><?php echo $row['name'] ?></td>
                                                        <td><?php echo $row['size'] ?>m²</td>
                                                        <td><?php echo $row['bed'] ?></td>
                                                        <td><?php echo $row['capacity'] ?> người</td>
                                                        <td>$<?php echo $row['price'] ?>/đêm</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <button type="button" data-loaiphong-id="<?php echo $row['id']; ?>" class="btn btn-info btn-sm btn-icon-text mr-3" id="btnShowFormUpdate">
                                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                                </button>
                                                                <button name="delete-btn" id="delete-btn" data-loaiphong-id="<?php echo $row['id']; ?>" type="button" class="btn btn-danger btn-sm btn-icon-text">
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

        <!-- Add loaiphong Form  -->
        <div class="col-md-6 grid-margin stretch-card" id="addLoaiphongFormContainer" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" align="center">Thêm Loại Phòng</h4>
                    <form class="forms-sample" action="loaiphong.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image">Hình Ảnh</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="form-group">
                            <label for="name">Tên Loại Phòng</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="size">Diện Tích</label>
                            <input type="text" class="form-control" id="size" name="size">
                        </div>
                        <div class="form-group">
                            <label for="bed">Loại Giường</label>
                            <input type="text" class="form-control" id="bed" name="bed">
                        </div>
                        <div class="form-group">
                            <label for="capacity">Sức Chứa</label>
                            <input type="text" class="form-control" id="capacity" name="capacity">
                        </div>
                        <div class="form-group">
                            <label for="price">Mức Giá</label>
                            <input type="text" class="form-control" id="price" name="price">
                        </div>

                        <input type="hidden" name="addLoaiphong" value="true">
                        <button type="submit" class="btn btn-primary mr-2" id="btnAddLoaiphong">Add</button>
                        <button type="button" class="btn btn-light" id="btnCloseAdd">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Update loaiphong Form  -->
        <div class="col-md-6 grid-margin stretch-card" id="updateLoaiphongFormContainer" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" align="center">Cập Nhật Thông Tin Loại Phòng</h4>
                    <form class="forms-sample" action="loaiphong.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="update-image">Hình Ảnh</label>
                            <input type="file" class="form-control" id="update-image" name="update-image">
                        </div>
                        <div class="form-group">
                            <label for="update-name">Tên Loại Phòng</label>
                            <input type="text" class="form-control" id="update-name" name="update-name">
                        </div>
                        <div class="form-group">
                            <label for="update-size">Diện Tích</label>
                            <input type="text" class="form-control" id="update-size" name="update-size">
                        </div>
                        <div class="form-group">
                            <label for="update-bed">Loại Giường</label>
                            <input type="text" class="form-control" id="update-bed" name="update-bed">
                        </div>
                        <div class="form-group">
                            <label for="update-capacity">Sức Chứa</label>
                            <input type="text" class="form-control" id="update-capacity" name="update-capacity">
                        </div>
                        <div class="form-group">
                            <label for="update-price">Mức Giá</label>
                            <input type="text" class="form-control" id="update-price" name="update-price">
                        </div>

                        <input type="hidden" name="updateLoaiphong" value="true">
                        <input type="hidden" id="loaiphongId" name="loaiphongId">
                        <button type="submit" class="btn btn-primary mr-2" id="btnUpdateLoaiphong">Update</button>
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
                    $('#addLoaiphongFormContainer').show();
                });
            });

            // xử lý tìm kiếm
            $('.timkiem').keyup(function() {
                var txt = $('.timkiem').val();
                $.post('xuly/timkiem-loaiphong.php', {
                    data: txt
                }, function(data) {
                    $('.danhsach').html(data);
                })
            });


            $(document).ready(function() {
                // Xử lý sự kiện click cho nút "Update" trong mỗi hàng
                $(document).on("click", "#btnShowFormUpdate", function() {
                    var row = $(this).closest("tr");
                    var loaiphongId = $(this).data("loaiphong-id");
                    var name = row.find("td:eq(3)").text().trim();
                    var size = row.find("td:eq(4)").text().trim().replace('m²', '');
                    var bed = row.find("td:eq(5)").text().trim();
                    var capacity = row.find("td:eq(6)").text().trim().replace('người', '');
                    var price = row.find("td:eq(7)").text().trim().replace('$', '').replace('/đêm', '');

                    $('#updateLoaiphongFormContainer').find("#loaiphongId").val(loaiphongId);
                    $('#updateLoaiphongFormContainer').find("#update-name").val(name);
                    $('#updateLoaiphongFormContainer').find("#update-size").val(size);
                    $('#updateLoaiphongFormContainer').find("#update-bed").val(bed);
                    $('#updateLoaiphongFormContainer').find("#update-capacity").val(capacity);
                    $('#updateLoaiphongFormContainer').find("#update-price").val(price);

                    $('.overlay').show();
                    $('.overlay').addClass("active");
                    $('#updateLoaiphongFormContainer').show();
                });
            });

            // Xử lý sự kiện khi nhấn nút "Xóa"
            $(document).on("click", "#delete-btn", function() {
                var rowToDelete = $(this).closest("tr");
                var loaiphongId = $(this).data("loaiphong-id");
                var confirmation = confirm("Bạn có chắc chắn muốn xóa loại phòng này không?");

                if (confirmation) {
                    $.ajax({
                        type: "POST",
                        url: "xuly/delete.php",
                        data: {
                            loaiphongId: loaiphongId
                        },
                        success: function(response) {
                            if (response === "success") {
                                rowToDelete.remove();
                                alert("Loại phòng đã được xóa thành công!");
                            } else {
                                alert("Xóa loại phòng không thành công!");
                            }
                        }
                    });
                }
            });

            // Close Button
            $('#btnCloseAdd').click(function() {
                $('.overlay').hide();
                $('#addLoaiphongFormContainer').hide();
            });
            $('#btnCloseUpdate').click(function() {
                $('.overlay').hide();
                $('#updateLoaiphongFormContainer').hide();
            });
        </script>


        <?php
        mysqli_close($conn);
        include "footer.php" ?>
</body>

</html>