<!DOCTYPE html>
<html lang="zxx">

<head>
    <link rel="stylesheet" href="css/form-booking.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
</head>

<body>
    <?php
    include("header.php");
    $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
    include("./connect.php");
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result5 = mysqli_query($conn, "SELECT * FROM blog WHERE id=$id");
        $row5 = mysqli_fetch_assoc($result5);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['post'])) {
                $title = $_POST['title'];
                $category = $_POST['category'];

                // Kiểm tra nếu có file ảnh được tải lên
                if ($_FILES['image']['size'] > 0) {
                    $targetDirectory = "../uploads/blog/";
                    $fileExtension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                    $targetFile = $targetDirectory . "blog-" . $id . "." . $fileExtension;

                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                        // Nếu tải ảnh lên thành công, cập nhật tên ảnh vào cơ sở dữ liệu
                        $image = "blog-" . $id . "." . $fileExtension;
                        $updateQuery = "UPDATE blog SET title='$title', category_id=$category, image='$image' WHERE id=$id";

                        if (mysqli_query($conn, $updateQuery)) {
                            // Thực hiện redirect hoặc thông báo cập nhật thành công
                            header("Location: edit-blog.php?id=$id"); // Điều hướng đến trang chỉnh sửa blog đã cập nhật
                            exit();
                        } else {
                            echo "Cập nhật không thành công";
                        }
                    } else {
                        echo "Lỗi khi tải file ảnh lên";
                    }
                } else {
                    // Nếu không có file ảnh được tải lên, chỉ cập nhật title và category
                    $updateQuery = "UPDATE blog SET title='$title', category_id=$category WHERE id=$id";

                    if (mysqli_query($conn, $updateQuery)) {
                        // Thực hiện redirect hoặc thông báo cập nhật thành công
                        header("Location: edit-blog.php?id=$id"); // Điều hướng đến trang chỉnh sửa blog đã cập nhật
                        exit();
                    } else {
                        echo "Cập nhật không thành công";
                    }
                }

                // Xử lý cập nhật dữ liệu cho nội dung content
                $content = $_POST['content'];
                // Cập nhật nội dung content vào cơ sở dữ liệu
                $updateContentQuery = "UPDATE blog SET content='$content' WHERE id=$id";
                if (mysqli_query($conn, $updateContentQuery)) {
                    // Thực hiện redirect hoặc thông báo cập nhật thành công
                    header("Location: edit-blog.php?id=$id"); // Điều hướng đến trang chỉnh sửa blog đã cập nhật
                    exit();
                } else {
                    echo "Cập nhật nội dung không thành công";
                }
            }
        }
    }
    ?>

    <!-- ... (Phần HTML code hiển thị form và các thông tin khác) ... -->


    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Post Blog</h2>
                        <div class="bt-option">
                            <a href="./index.html">Home</a>
                            <span>Post Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Room Booking Section Begin -->
    <section class="room-booking-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="room-booking" style="margin-top: -40px;">
                        <h3 align="center">Your Blog</h3>
                        <form action="edit-blog.php?id=<?php if(isset( $_GET['id'])) {echo $_GET['id'] ;}?>" method="POST" enctype="multipart/form-data">
                            <div class="input-num">
                                <label for="title">Title:</label>
                                <input style="text-transform: none;" type="text" id="title" name="title" value="<?php echo $row5['title']; ?>">
                            </div>
                            <div class="input-num">
                                <label for="content">Content:</label>
                                <textarea style="min-width: 100%; color: black;" id="content" name="content" value="<?php echo htmlspecialchars($row5['content']); ?>"></textarea>
                            </div>
                            <div class="input-num">
                                <label for="image">Poster:</label>
                                <input style="text-transform: none;" type="file" id="image" name="image" value="">
                            </div>
                            <div class="select-option">
                                <label for="category">Category:</label>
                                <select id="category" name="category" style="text-transform: none;">
                                    <?php
                                    $result4 = mysqli_query($conn, "SELECT * FROM category_blog");
                                    while ($row4 = mysqli_fetch_array($result4)) {
                                        $selected = ($row4['id'] == $row5['category_id']) ? 'selected' : '';
                                    ?>
                                        <option value="<?php echo $row4['id'] ?>" <?php echo $selected ?>><?php echo $row4['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="input-num">
                                <input type="hidden" id="post" name="post" value="true">
                                <input type="hidden" id="idBlog" name="idBlog" value="<?php echo $row5['id']; ?>">
                            </div><br><br>
                            <div class="btn-form" style="margin-top: -20px;">
                                <input type="submit" value="Update" class="book-btn" id="btnPost" name="post">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Room Booking Section End -->
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
    include "footer.php"; ?>
</body>

</html>