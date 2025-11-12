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
        if (isset($_POST['addPhong'])) {
            // $image = $_FILES['image'];
            $targetDirectory = "../uploads/room/";
            $fileExtension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $idQuery = mysqli_query($conn, "SELECT MAX(id) AS max_id FROM room");
            $idRow = mysqli_fetch_assoc($idQuery);
            $nextId = $idRow['max_id'] + 1;
            $targetFile = $targetDirectory . "room-" . $nextId . "." . $fileExtension;
            $nameFile = "room-" . $nextId . "." . $fileExtension;

            $numberRoom = $_POST['numberRoom'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $adult = $_POST['adult'];
            $size = $_POST['size'];
            $quantity = $_POST['quantity'];
            $children = $_POST['children'];
            $bed = $_POST['bed'];
            $loaiphong = $_POST['loaiphong'];
            $detail = $_POST['detail'];

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $insertQuery =  "INSERT INTO room (numberRoom, name, price, adult, size, quantity, children, status,bed,loaiphong, detail, image) VALUES ('$numberRoom','$name', '$price', '$adult', '$size', '$quantity', '$children',1,'$bed',$loaiphong, '$detail', '$nameFile')";

                if (mysqli_query($conn, $insertQuery)) {
                    echo '<script language="javascript">';
                    echo 'alert("Bạn đã thêm mới thành công!");';
                    echo 'window.location.href = "room.php";';
                    echo '</script>';
                } else {
                    echo '<script language="javascript">alert("Thêm mới không thành công.");</script>';
                }
            } else {
                echo "Error uploading file.";
            }
        } elseif (isset($_POST['btnUpdate'])) {
            $image = isset($_FILES['update-image']) ? $_FILES['update-image'] : null;
            $roomId = $_POST['update-roomId'];
            $numberRoom = $_POST['update-numberRoom'];
            $name = $_POST['update-name'];
            $price = $_POST['update-price'];
            $adult = $_POST['update-adult'];
            $children = $_POST['update-children'];
            $size = $_POST['update-size'];
            $quantity = $_POST['update-quantity'];
            $detail = $_POST['update-detail'];
            $bed = $_POST['update-bed'];
            $loaiphong = $_POST['update-loaiphong'];

            $targetDirectory = "../uploads/room/";
            $fileExtension = !empty($image['name']) ? pathinfo($image['name'], PATHINFO_EXTENSION) : '';

            if (!empty($fileExtension)) {
                $targetFile = $targetDirectory . "room-" . $loaiphongId . "." . $fileExtension;
                $nameFile = "room-" . $loaiphongId . "." . $fileExtension;

                $oldImageFile = $targetDirectory . "room-" . $loaiphongId . ".*";
                array_map('unlink', glob($oldImageFile));

                if (move_uploaded_file($_FILES["update-image"]["tmp_name"], $targetFile)) {
                    $updateQuery = "UPDATE room SET image='$nameFile', numberRoom='$numberRoom', name='$name', price=$price, adult=$adult, size=$size, quantity=$quantity, children=$children, detail='$detail', bed='$bed', loaiphong=$loaiphong WHERE id='$roomId'";

                    if (mysqli_query($conn, $updateQuery)) {
                        echo '<script language="javascript">';
                        echo 'alert("Bạn đã cập nhật thành công!");';
                        echo 'window.location.href = "room.php";';
                        echo '</script>';
                    } else {
                        echo '<script language="javascript">alert("Cập nhật không thành công.");</script>';
                    }
                } else {
                    echo "Error uploading file.";
                }
            } else {
                // No new image uploaded, update other fields only
                $updateQuery = "UPDATE room SET numberRoom='$numberRoom', name='$name', price=$price, adult=$adult, size=$size, quantity=$quantity, children=$children, detail='$detail', bed='$bed', loaiphong=$loaiphong WHERE id='$roomId'";

                if (mysqli_query($conn, $updateQuery)) {
                    echo '<script language="javascript">';
                    echo 'alert("Bạn đã cập nhật thành công!");';
                    echo 'window.location.href = "room.php";';
                    echo '</script>';
                } else {
                    echo '<script language="javascript">alert("Cập nhật không thành công.");</script>';
                }
            }
        }
    } else {
        echo "Invalid request";
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
                                            <h3 class="card-title" style="margin-top: 20px;">Quản Lý Phòng</h3>
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
                                                    <th class="ml-5">#</th>
                                                    <th>Hình Ảnh</th>
                                                    <th>Tên Phòng</th>
                                                    <th>Số Phòng</th>
                                                    <th>Mô Tả</th>
                                                    <th>Diện Tích</th>
                                                    <th>Giá</th>
                                                    <th>Số Lượng</th>
                                                    <th>Sức Chứa</th>
                                                    <th>Loại Giường</th>
                                                    <th>Loại Phòng</th>
                                                    <th>Trạng thái</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="danhsach">
                                                <?php
                                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                include "connect.php";
                                                $result = mysqli_query($conn, "SELECT * FROM room ORDER BY id DESC ");
                                                $i = 1;
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i ?></td>
                                                        <td><img style="width: 150px; height: auto; border-radius: 0;" src="../uploads/room/<?php echo $row['image'] ?>"></td>
                                                        <td><?php echo $row['name'] ?></td>
                                                        <td><?php echo $row['numberRoom'] ?></td>
                                                        <td style="min-width: 400px;white-space: wrap;">
                                                            <p><?php echo $row['detail'] ?></p>
                                                        </td>
                                                        <td><?php echo $row['size'] . 'm²' ?></td>
                                                        <td><?php echo '$' . $row['price'] . '/đêm' ?></td>
                                                        <td><?php echo $row['quantity'] . ' phòng'  ?> </td>
                                                        <td>
                                                            <p><span class="btn btn-inverse-primary btn-fw tags"><?php echo $row['adult'] . ' người lớn' ?></span></p>
                                                            <p><span class="btn btn-inverse-danger btn-fw tags"><?php echo $row['children'] . ' trẻ em' ?></span></p>
                                                        </td>
                                                        <td><?php echo $row['bed'] ?></td>
                                                        <td><?php
                                                            $result1 = mysqli_query($conn, "SELECT * FROM category_room WHERE id = " . $row['loaiphong']);
                                                            $row1 = mysqli_fetch_assoc($result1);
                                                            echo $row1['name'];
                                                            ?></td>
                                                        <td>
                                                            <?php if ($row['status'] == 0) { ?>
                                                                <button class="btn btn-dark room-status" data-room-id="<?php echo $row['id']; ?>">Bảo trì</button>
                                                            <?php } else { ?>
                                                                <button class="btn btn-primary room-status" data-room-id="<?php echo $row['id']; ?>">Hoạt động</button>
                                                            <?php } ?>
                                                        </td>

                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <button type="button" data-room-id="<?php echo $row['id']; ?>" class="btn btn-info btn-sm btn-icon-text mr-3" id="btnShowFormUpdate" data-loaiphong-id="<?php echo $row['loaiphong']; ?>">
                                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                                </button>
                                                                <!-- <button type="button" data-room-id="<?php echo $row['id']; ?>" class="btn btn-secondary btn-sm btn-icon-text mr-3" id="btnShowFormUpdateImage">
                                                                    <i class="typcn typcn-image-outline btn-icon-append"></i>
                                                                </button> -->
                                                                <button name="delete-btn" data-room-id="<?php echo $row['id']; ?>" id="delete-btn" type="button" class="btn btn-danger btn-sm btn-icon-text">
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
    </div>

    <div class="overlay" id="overlay"></div>



    <!-- // Form Add -->
    <div class="col-md-6 grid-margin stretch-card" id="addRoomFormContainer" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" align="center">Thêm phòng</h4>
                <form class="forms-sample" action="room.php" method="POST" enctype="multipart/form-data">
                    <div class="col-md-12 form-group">
                        <label for="name">Tên Phòng</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="image">Hình Ảnh</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="flex-form">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="numberRoom">Số Phòng</label>
                                <input type="text" class="form-control" id="numberRoom" name="numberRoom">
                            </div>
                            <div class="form-group">
                                <label for="price">Giá</label>
                                <input type="number" class="form-control" id="price" name="price">
                            </div>

                            <div class="form-group">
                                <label for="adult">Người Lớn</label>
                                <input type="number" class="form-control" id="adult" name="adult">
                            </div>
                            <div class="form-group">
                                <label for="bed">Loại Giường</label>
                                <input type="text" class="form-control" id="bed" name="bed">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="size">Diện Tích</label>
                                <input type="number" class="form-control" id="size" name="size">
                            </div>

                            <div class="form-group">
                                <label for="quantity">Số Lượng</label>
                                <input type="number" class="form-control" id="quantity" name="quantity">
                            </div>
                            <div class="form-group">
                                <label for="children">Trẻ Em</label>
                                <input type="number" class="form-control" id="children" name="children">
                            </div>
                            <div class="form-group">
                                <label for="loaiphong">Loại Phòng</label>
                                <select class="form-control" id="loaiphong" name="loaiphong">
                                    <?php
                                    $result2 = mysqli_query($conn, "SELECT * FROM category_room");
                                    while ($row2 = mysqli_fetch_array($result2)) {
                                    ?>
                                        <option value="<?php echo $row2['id'] ?>"><?php echo $row2['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <label for="tienNghi">Tiện Nghi</label>
                    <div name="tienNghi" class="col-md-12 container-checkbox">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" checked>
                                Wifi
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                                Điều hòa
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                                Nóng lạnh
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                                Tivi
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="detail">Mô tả</label>
                        <textarea type="number" class="form-control" id="detail" name="detail"></textarea>
                    </div>
                    <input type="hidden" class="form-control" id="addPhong" name="addPhong" value="true">
                    <button type="submit" class="btn btn-primary mr-2" id="btnAddRoom">Add</button>
                    <button type="button"  class="btn btn-light" id="btnCloseAdd">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <!-- // Form Update -->
    <div class="col-md-6 grid-margin stretch-card" id="updateRoomFormContainer" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" align="center">Cập nhật phòng</h4>
                <form class="forms-sample" action="room.php" method="POST" enctype="multipart/form-data">
                    <div class="col-md-12 form-group">
                        <label for="update-name">Tên Phòng</label>
                        <input type="text" class="form-control" id="update-name" name="update-name">
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="update-image">Hình Ảnh</label>
                        <input type="file" class="form-control" id="update-image" name="update-image">
                    </div>
                    <div class="flex-form">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update-numberRoom">Số Phòng</label>
                                <input type="text" class="form-control" id="update-numberRoom" name="update-numberRoom">
                            </div>
                            <div class="form-group">
                                <label for="update-price">Giá</label>
                                <input type="number" class="form-control" id="update-price" name="update-price">
                            </div>

                            <div class="form-group">
                                <label for="update-adult">Người Lớn</label>
                                <input type="number" class="form-control" id="update-adult" name="update-adult">
                            </div>
                            <div class="form-group">
                                <label for="update-bed">Loại Giường</label>
                                <input type="text" class="form-control" id="update-bed" name="update-bed">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update-size">Diện Tích</label>
                                <input type="number" class="form-control" id="update-size" name="update-size">
                            </div>

                            <div class="form-group">
                                <label for="update-quantity">Số Lượng</label>
                                <input type="number" class="form-control" id="update-quantity" name="update-quantity">
                            </div>
                            <div class="form-group">
                                <label for="update-children">Trẻ Em</label>
                                <input type="number" class="form-control" id="update-children" name="update-children">
                            </div>
                            <div class="form-group">
                                <label for="update-loaiphong">Loại Phòng</label>
                                <select class="form-control" id="update-loaiphong" name="update-loaiphong">
                                    <?php
                                    $result3 = mysqli_query($conn, "SELECT * FROM category_room");
                                    while ($row3 = mysqli_fetch_array($result3)) {
                                    ?>
                                        <option value="<?php echo $row3['id'] ?>" data-loaiphong-id="<?php echo $row3['id']; ?>"><?php echo $row3['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <label for="tienNghi">Tiện Nghi</label>
                    <div name="tienNghi" class="col-md-12 container-checkbox">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" checked>
                                Wifi
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                                Điều hòa
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                                Nóng lạnh
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input">
                                Tivi
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="update-detail">Mô tả</label>
                        <textarea type="number" class="form-control" id="update-detail" name="update-detail"></textarea>
                    </div>
                    <input type="hidden" class="form-control" id="update-roomId" name="update-roomId">
                    <input type="hidden" class="form-control" id="btnUpdate" name="btnUpdate">
                    <button type="submit" class="btn btn-primary mr-2" id="btnUpdate" name="Update" data-room-id="<?php echo $row['id']; ?>">Update</button>
                    <button type="button" class="btn btn-light" id="btnCloseUpdate">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    <!-- // Form Edit Image  -->
    <!-- <div class="col-6 grid-margin stretch-card" id="updateImageRoomFormContainer" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" align="center">Thêm Ảnh</h4>
                <form action="room.php" id="uploadForm" method="post" enctype="multipart/form-data">
                    <div class="form-group" style="margin-top: 10px;display: flex;justify-content: right;">
                        <label for="image" class="btn-primary custom-file-upload" style="display: flex;">
                            <i class="typcn typcn-document-add btn-icon-append" style="margin: -1px 2px 0 0;"></i>Thêm
                        </label>
                        <input style="display: none;" type="file" class="form-control" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" id="btnUpdateImage" name="btnUpdateImage" data-room-id="<?php echo $row['id']; ?>">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
                <table class="table table-striped project-orders-table" style="margin-top: 15px;">
                    <thead>
                        <tr>
                            <th>Hình Ảnh</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody class="danhsach">
                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM room_images ");
                        $i = 1;
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td><img style="min-width: 800px; height: auto; border-radius: 0px;" src="../uploads/room/<?php echo $row['image'] ?>" width="300px"></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <button name="delete-btn-image" id="delete-btn-image" type="button" class="btn btn-danger btn-sm btn-icon-text">
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
    </div> -->

    <script>
        $('.timkiem').keyup(function() {
            var txt = $('.timkiem').val();
            $.post('xuly/timkiem-room.php', {
                data: txt
            }, function(data) {
                $('.danhsach').html(data);
            })
        });

        $(document).ready(function() {
            $(".room-status").click(function() {
                var roomId = $(this).data("room-id");
                var status = $(this).text().trim() === "Hoạt động" ? 0 : 1;

                var clickedBtn = $(this); // Lưu trữ thẻ nút được nhấn

                $.ajax({
                    type: "POST",
                    url: "xuly/update-status.php",
                    data: {
                        roomId: roomId,
                        status: status
                    },
                    success: function(response) {
                        if (response === "success") {
                            var newStatus = status === 0 ? "Bảo trì" : "Hoạt động";
                            // Thay đổi lớp CSS để chuyển màu và kiểu nút
                            if (status === 0) {
                                clickedBtn.removeClass("btn-primary").addClass("btn-dark");
                            } else {
                                clickedBtn.removeClass("btn-dark").addClass("btn-primary");
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
            $(document).on("click", "#btnAdd", function() {
                $('.overlay').show();
                $('.overlay').addClass("active");
                $('#addRoomFormContainer').show();
            });
        });
        $(document).ready(function() {
            $(document).on("click", "#btnShowFormUpdateImage", function() {
                $('.overlay').show();
                $('.overlay').addClass("active");
                $('#updateImageRoomFormContainer').show();
            });
        });



        $(document).ready(function() {
            // Xử lý sự kiện click cho nút "Update" trong mỗi hàng
            $(document).on("click", "#btnShowFormUpdate", function() {
                var row = $(this).closest("tr");
                var roomId = $(this).data("room-id");
                var loaiphong = $(this).data("loaiphong-id");
                var name = row.find("td:eq(2)").text().trim();
                var numberRoom = row.find("td:eq(3)").text().trim();
                var detail = row.find("td:eq(4)").text().trim();
                var size = row.find("td:eq(5)").text().trim().replace('m²', '');
                var price = row.find("td:eq(6)").text().trim().replace('$', '').replace('/đêm', '');
                var quantity = row.find("td:eq(7)").text().trim().replace(' phòng', '');
                var adult = row.find("td:eq(8) span.btn-inverse-primary").text().trim().replace(' người lớn', '');
                var children = row.find("td:eq(8) span.btn-inverse-danger").text().trim().replace(' trẻ em', '');
                var bed = row.find("td:eq(9)").text().trim();
                // var loaiphong = row.find("td:eq(10)").text().trim();

                $('#updateRoomFormContainer').find("#update-roomId").val(roomId);
                $('#updateRoomFormContainer').find("#update-name").val(name);
                $('#updateRoomFormContainer').find("#update-numberRoom").val(numberRoom);
                $('#updateRoomFormContainer').find("#update-detail").val(detail);
                $('#updateRoomFormContainer').find("#update-size").val(size);
                $('#updateRoomFormContainer').find("#update-price").val(price);
                $('#updateRoomFormContainer').find("#update-quantity").val(quantity);
                $('#updateRoomFormContainer').find("#update-adult").val(adult);
                $('#updateRoomFormContainer').find("#update-children").val(children);
                $('#updateRoomFormContainer').find("#update-bed").val(bed);
                $('#updateRoomFormContainer').find("#update-loaiphong").val(loaiphong);

                $('.overlay').show();
                $('.overlay').addClass("active");
                $('#updateRoomFormContainer').show();

            });
        });

        // Xóa phòng
        $(document).on("click", "#delete-btn", function() {
            var rowToDelete = $(this).closest("tr"); // Lưu trữ dòng để xóa
            var roomId = $(this).data("room-id");
            var confirmation = confirm("Bạn có chắc chắn muốn xóa phòng này không?");

            if (confirmation) {
                $.ajax({
                    type: "POST",
                    url: "xuly/delete.php",
                    data: {
                        roomId: roomId
                    },
                    success: function(response) {
                        if (response === "success") {
                            rowToDelete.remove();
                            alert("Phòng đã được xóa thành công!");
                        } else {
                            alert("Xóa phòng không thành công!");
                        }
                    }
                });
            }
        });

        // Close Button
        $('#btnCloseAdd').click(function() {
            $('.overlay').hide();
            $('#addRoomFormContainer').hide();
        });
        $('#btnCloseUpdate').click(function() {
            $('.overlay').hide();
            $('#updateRoomFormContainer').hide();
        });
    </script>

    <?php
    mysqli_close($conn);
    include "footer.php" ?>
</body>

</html>