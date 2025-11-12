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
        if (isset($_POST['addBlog'])) {
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Xử lý form thêm bài viết mới
                $title = $_POST['title'];
                $author = $_POST['author'];
                $content = mysqli_real_escape_string($conn, $_POST['content']);
                $category = $_POST['category'];
                $currentTimestamp = time();
                $image = $_FILES['image'];
                $targetDirectory = "../uploads/blog/";
                $targetFileName = $targetDirectory . basename($image["name"]);
                $imageName = basename($image["name"]);
                if (move_uploaded_file($image["tmp_name"], $targetFileName)) {
                    $insertQuery = "INSERT INTO blog (title, author, image, content, category, status, timePost) VALUES ('$title', '$author', '$imageName', '$content', '$category', 1, '$currentTimestamp')";

                    if (mysqli_query($conn, $insertQuery)) {
                        echo '<script language="javascript">';
                        echo 'alert("Bạn đã thêm bài viết mới thành công!");';
                        echo 'window.location.href = "blog.php";';
                        echo '</script>';
                    } else {
                        echo '<script language="javascript">alert("Thêm bài viết mới thất bại.");</script>';
                    }
                } else {
                    echo '<script language="javascript">alert("Có lỗi khi tải lên tệp ảnh.");</script>';
                }
            } else {
                echo '<script language="javascript">alert("Vui lòng chọn tệp ảnh.");</script>';
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
                                            <h3 class="card-title" style="margin-top: 20px;">Quản Lý Bài Viết</h3>
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
                                        <!-- <div style="margin-top: 13px;">
                                            <button type="button" class="btn btn-secondary btn-sm btn-icon-text mr-3" id="btnAdd" style="display: flex; padding: 11px;">
                                                <i class="typcn typcn-document-add btn-icon-append" style="margin: -2px 2px 0 0;"></i> Thêm
                                            </button>
                                        </div> -->
                                    </nav>
                                    <div class="table-responsive">
                                        <table class="table table-striped project-orders-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tiêu Đề</th>
                                                    <th>Ảnh Bìa</th>
                                                    <th>Tác Giả</th>
                                                    <th>Nội Dung</th>
                                                    <th>Thể Loại</th>
                                                    <th>Ngày Đăng Bài</th>
                                                    <th>Cập Nhật Lần Cuối</th>
                                                    <th>Tình trạng</th>
                                                    <th>Hành Động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="danhsach">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT * FROM blog ORDER BY id DESC ");
                                                $i = 1;
                                                while ($row = mysqli_fetch_array($result)) {

                                                ?>
                                                    <tr>
                                                        <td style="display: none;"><?php echo $row['id']; ?></td>
                                                        <td><?php echo $i ?></td>
                                                        <td style="min-width: 200px;white-space: wrap;">
                                                            <p><?php echo $row['title'] ?></p>
                                                        </td>
                                                        <td><img style="max-width: 100%; max-height: 100%; min-width: 300px; min-height: 200px; object-fit: cover; border-radius: 0px;" src="../uploads/blog/<?php echo $row['image'] ?>" alt=""></td>
                                                        <td><?php echo $row['author'] ?></td>
                                                        <td style="min-width: 600px;white-space: wrap;">
                                                            <p><?php echo $row['content'] ?></p>
                                                        </td>
                                                        <td><?php
                                                            $result2 = mysqli_query($conn, "SELECT * FROM category_blog WHERE id = " . $row['category_id']);
                                                            $row2 = mysqli_fetch_assoc($result2);
                                                            echo $row2['name'];
                                                            ?></td>
                                                        <td><?php echo date("d-m-Y H:i:s", $row['timePost']) ?></td>
                                                        <td><?php if ($row['timeUpdate'] != "") {
                                                                echo date("d-m-Y H:i:s", $row['timeUpdate']);
                                                            } ?></td>
                                                        <td>
                                                            <?php if ($row['status'] == 0) { ?>
                                                                <button class="btn btn-secondary blog-status" id="btnStatus" data-blog-id="<?php echo $row['id']; ?>">Ẩn bài</button>
                                                            <?php } else { ?>
                                                                <button class="btn btn-success blog-status" id="btnStatus" data-blog-id="<?php echo $row['id']; ?>">Hiển thị</button>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <button name="delete-btn" id="delete-btn" data-blog-id="<?php echo $row['id']; ?>" type="button" class="btn btn-danger btn-sm btn-icon-text">
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

        <!-- Add Blog Form  -->
        <div class="col-md-6 grid-margin stretch-card" id="addBlogFormContainer" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" align="center">Thêm Bài Viết</h4>
                    <form class="forms-sample" action="blog.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Tiêu Đề</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="image">Ảnh Bìa</label>
                            <!-- <label for="image" class="btn-primary custom-file-upload">Upload file</label> -->
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="form-group">
                            <label for="author">Tác Giả</label>
                            <input type="text" class="form-control" id="author" name="author">
                        </div>
                        <div class="form-group">
                            <label for="content">Nội Dung</label>
                            <textarea class="form-control" id="content" name="content"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category">Thể Loại</label>
                            <select class="form-control" id="category" name="category">
                                <?php
                                $result = mysqli_query($conn,  "SELECT * FROM category_blog");

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">Không có dữ liệu</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="addBlog" value="true">
                        <button type="submit" class="btn btn-primary mr-2" id="btnAddBlog">Add</button>
                        <button type="button" class="btn btn-light" id="btnCloseAdd">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            // Hiển thị Form thêm bài viết
            $(document).ready(function() {
                $(document).on("click", "#btnAdd", function() {
                    $('.overlay').show();
                    $('.overlay').addClass("active");
                    $('#addBlogFormContainer').show();
                });
            });

            // xử lý tìm kiếm
            $('.timkiem').keyup(function() {
                var txt = $('.timkiem').val();
                $.post('xuly/timkiem-blog.php', {
                    data: txt
                }, function(data) {
                    $('.danhsach').html(data);
                })
            });

            // Cập nhật tình trạng tài khoản bài viết
            $(document).ready(function() {
                $(".blog-status").click(function() {
                    var blogId = $(this).data("blog-id");
                    var status = $(this).text().trim() === "Hiển thị" ? 0 : 1;
                    var clickedBtn = $(this);

                    $.ajax({
                        type: "POST",
                        url: "xuly/update-status.php",
                        data: {
                            blogId: blogId,
                            status: status
                        },
                        success: function(response) {
                            if (response === "success") {
                                var newStatus = status === 0 ? "Ẩn bài" : "Hiển thị";
                                // Thay đổi lớp CSS để chuyển màu và kiểu nút
                                if (status === 0) {
                                    clickedBtn.removeClass("btn-success").addClass("btn-secondary");
                                } else {
                                    clickedBtn.removeClass("btn-secondary").addClass("btn-success");
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

            // Xóa bài viết
            $(document).on("click", "#delete-btn", function() {
                var rowToDelete = $(this).closest("tr"); // Lưu trữ dòng để xóa
                var blogId = $(this).data("blog-id");
                var confirmation = confirm("Bạn có chắc chắn muốn xóa bài viết này không?");

                if (confirmation) {
                    $.ajax({
                        type: "POST",
                        url: "xuly/delete.php",
                        data: {
                            blogId: blogId
                        },
                        success: function(response) {
                            if (response === "success") {
                                rowToDelete.remove();
                                alert("Bài viết đã được xóa thành công!");
                            } else {
                                alert("Xóa bài viết không thành công!");
                            }
                        }
                    });
                }
            });

            // Close Button
            $('#btnCloseAdd').click(function() {
                $('.overlay').hide();
                $('#addBlogFormContainer').hide();
            });
            $('#btnCloseUpdate').click(function() {
                $('.overlay').hide();
                $('#updateBlogFormContainer').hide();
            });
        </script>
        <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#content'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        </script>

        <?php
        mysqli_close($conn);
        include "footer.php" ?>
</body>

</html>