<!DOCTYPE html>
<html lang="zxx">

<head>
    <link rel="stylesheet" href="css/form-booking.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
</head>

<body>
    <?php include("header.php");
    $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
    include("./connect.php");
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (isset($_POST['post'])) {
            $idUser = $_SESSION['idUser'];
            $result4 = mysqli_query($conn, "SELECT Fullname FROM user WHERE id = $idUser");
            $row4 = mysqli_fetch_assoc($result4);
            $author = $row4['Fullname'];

            $targetDirectory = "../uploads/blog/";
            $fileExtension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $idQuery = mysqli_query($conn, "SELECT MAX(id) AS max_id FROM blog");
            $idRow = mysqli_fetch_assoc($idQuery);
            $nextId = $idRow['max_id'] + 1;
            $targetFile = $targetDirectory . "blog-" . $nextId . "." . $fileExtension;
            $image = "blog-" . $nextId . "." . $fileExtension;

            if (empty($_POST['title']) || empty($_POST['content']) || empty($_POST['category'])) {
                echo '<script language="javascript">alert("Vui lòng điền đầy đủ thông tin.");</script>';
            } elseif (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $title = $_POST['title'];
                $content = $_POST['content'];
                $category = $_POST['category'];

                $currentTime = time();
                $insertQuery = "INSERT INTO blog (title, author, content, image, category_id, timePost, status) VALUES ('$title', '$author','$content', '$image', $category, $currentTime,1)";

                if (mysqli_query($conn, $insertQuery)) {
                    echo '<script language="javascript">';
                    echo 'alert("Bạn đã đăng bài thành công!");';
                    echo 'window.location.href = "blog.php";';
                    echo '</script>';
                } else {
                    echo '<script language="javascript">alert("Đăng bài không thành công.");</script>';
                }
            } else {
                echo "Error uploading file.";
            }
        }
    }

    ?>

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
                        <form action="post-blog.php" method="POST" enctype="multipart/form-data">
                            <div class="input-num">
                                <label for="title">Title:</label>
                                <input style="text-transform: none;" type="text" id="title" name="title" value="<?php echo isset($title) ? $title : ''; ?>">
                            </div>
                            <div class="input-num">
                                <label for="content">Content:</label>
                                <textarea style="min-width: 100%; color: black;" id="content" name="content"></textarea>
                            </div>
                            <div class="input-num">
                                <label for="image">Poster:</label>
                                <input style="text-transform: none;" type="file" id="image" name="image" value="<?php echo isset($image) ? $image : ''; ?>">
                            </div>
                            <div class="select-option">
                                <label for="category">Category:</label>
                                <select id="category" name="category" style="text-transform: none;">
                                    <?php
                                    $result4 = mysqli_query($conn, "SELECT * FROM category_blog");
                                    while ($row4 = mysqli_fetch_array($result4)) {
                                    ?>
                                        <option value="<?php echo $row4['id'] ?>"><?php echo $row4['name'] ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                            <div class="input-num">
                                <input type="hidden" id="post" name="post" value="true">
                            </div><br><br>
                            <div class="btn-form" style="margin-top: -20px;">
                                <input type="submit" value="Post" class="book-btn" id="btnPost" name="post">
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