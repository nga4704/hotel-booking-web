<!DOCTYPE html>
<html lang="zxx">

<head>
</head>

<body>
    <?php include "header.php";
    $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
    include "connect.php";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = mysqli_query($conn, "SELECT * FROM blog WHERE id=$id");
        $row = mysqli_fetch_assoc($result);
    }
    ?>

    <!-- Blog Details Hero Section Begin -->
    <section class="blog-details-hero set-bg" data-setbg="../uploads/blog/<?php echo $row['image'] ?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="bd-hero-text">
                        <span><?php
                                $result4 = mysqli_query($conn, "SELECT * FROM category_blog WHERE id = " . $row['category_id']);
                                $row4 = mysqli_fetch_assoc($result4);
                                echo $row4['name'];
                                ?></span>
                        <h2><?php echo $row['title'] ?></h2>
                        <ul>
                            <li class="b-time"><i class="icon_clock_alt"></i><?php echo date("d M, Y", $row['timePost']) ?></li>
                            <li><i class="icon_profile"></i> <?php echo $row['author'] ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="blog-details-text">
                        <div class="bd-title">
                            <p><?php echo $row['content'] ?></p>
                        </div>
                        <div class="comment-option" id="dsbinhluan">
                            <h4><?php
                                $result5 = mysqli_query($conn, "SELECT count(id) AS total FROM comment WHERE idBlog = $id");
                                $row5 = mysqli_fetch_assoc($result5);
                                echo $row5['total'];
                                ?> Comments</h4>
                            <?php
                            $result6 = mysqli_query($conn, "SELECT * FROM comment WHERE idBlog = $id");
                            while ($row6 = mysqli_fetch_array($result6)) {
                                $result7 = mysqli_query($conn, "SELECT * FROM user WHERE id = " . $row6['idUser']);
                                $row7 = mysqli_fetch_assoc($result7);
                            ?>
                                <div class="single-comment-item">
                                    <div class="sc-author">
                                        <img src="../uploads/user/<?php echo $row7['Avatar'] ?>" alt="">
                                    </div>
                                    <div class="sc-text">
                                        <span><?php echo date("d-M-Y", $row6['time']); ?></span>
                                        <h5><?php echo $row7['Fullname']; ?></h5>
                                        <p><?php echo $row6['message'] ?></p>
                                        <a href="#" class="comment-btn">Like</a>
                                        <a href="#" class="comment-btn">Reply</a>

                                    </div>
                                </div>
                            <?php } ?>
                            <!-- <div class="single-comment-item reply-comment">
                                <div class="sc-author">
                                    <img src="img/blog/blog-details/avatar/avatar-2.jpg" alt="">
                                </div>
                                <div class="sc-text">
                                    <span>27 Aug 2019</span>
                                    <h5>Brandon Kelley</h5>
                                    <p>Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                        adipisci velit, sed quia non numquam eius modi tempora. incidunt ut labore et
                                        dolore magnam.</p>
                                    <a href="#" class="comment-btn like-btn">Like</a>
                                    <a href="#" class="comment-btn reply-btn">Reply</a>
                                </div>
                            </div> -->
                        </div>
                        <?php if (isset($_SESSION['idUser'])) { ?>
                            <div class="leave-comment">
                                <h4>Your Comment</h4>
                                <div class="comment-form">
                                <!-- <form action="blog-details.php" class="comment-form"> -->
                                <input type="hidden" id="id" value="<?php echo $id ?>">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <textarea placeholder="Messages" id="message"></textarea>
                                        <button type="submit" class="site-btn" id="btnGui">Send Message</button>
                                    </div>
                                </div>
                                </div>
                                <!-- </form> -->
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Recommend Blog Section Begin -->
    <section class="recommend-blog-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Recommended</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $result2 = mysqli_query($conn, "SELECT * FROM blog WHERE id <> $id ORDER BY id LIMIT 3");
                    while ($row2 = mysqli_fetch_array($result2)) {
                ?>
                        <div class="col-md-4">
                            <div class="blog-item set-bg" data-setbg="../uploads/blog/<?php echo $row2['image'] ?>">
                                <div class="bi-text">
                                    <span class="b-tag"><?php
                                                        $result5 = mysqli_query($conn, "SELECT * FROM category_blog WHERE id = " . $row2['category_id']);
                                                        $row5 = mysqli_fetch_assoc($result5);
                                                        echo $row5['name'];
                                                        ?></span>
                                    <h4><a href="blog-details.php?id=<?php echo $row2['id'] ?>"><?php echo $row2['title'] ?></a></h4>
                                    <div class="b-time"><i class="icon_clock_alt"></i><?php echo date("d M, Y", $row2['timePost']) ?></div>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </section>
    <!-- Recommend Blog Section End -->
    <script>
        $("#btnGui").click(function() {
            $.ajax({
                method: "POST",
                url: 'check-login.php',
                success: function(response) {
                    if (response === 'loggedIn') {
                        $.ajax({
                                method: "POST",
                                url: 'add-comment.php',
                                data: {
                                    id: $('#id').val(),
                                    message: $('#message').val()
                                }
                            })
                            .done(function(data) {
                                var newComment = `
                                <div class="single-comment-item">
                                    <div class="sc-author">
                                        <img src="../uploads/user/<?php echo $row7['Avatar'] ?>" alt="">
                                    </div>
                                    <div class="sc-text">
                                        <span><?php echo date("d-M-Y") ?></span>
                                        <h5><?php echo $row7['Fullname']; ?></h5>
                                        <p>${$('#message').val()}</p>
                                        <a href="#" class="comment-btn">Like</a>
                                        <a href="#" class="comment-btn">Reply</a>

                                    </div>
                                </div>
                                `;

                                $('#dsbinhluan').append(newComment);
                                $('#message').val("");
                                alert("Bạn vừa để lại một bình luận.");
                            })
                            .fail(function(data) {
                                console.log("Gửi không thành công");
                            });
                    } else {
                        alert("Bạn chưa đăng nhập! Vui lòng đăng nhập để tiếp tục.");
                        window.location.href = 'login.php';
                    }
                },
                error: function() {
                    console.log("Lỗi khi kiểm tra đăng nhập");
                }
            });
            console.log('Sending data:', {
                id: $('#id').val(),
                message: $('#message').val()
            });
        });
    </script>
    <?php include "footer.php"; ?>
</body>

</html>