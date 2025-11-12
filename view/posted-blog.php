<!DOCTYPE html>
<html lang="zxx">

<head>

</head>

<body>
    <?php include("header.php");
    $_SESSION['return_to'] = $_SERVER['REQUEST_URI']; ?>

    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Blog</h2>
                        <div class="bt-option">
                            <a href="./index.php">Home</a>
                            <span>Blog Posted</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog-section blog-page spad">
        <div class="container">
            <div class="row">
                <?php
                include("connect.php");
                $idUser = $_SESSION['idUser'];
                if (isset($_GET['id'])) {
                    $result2 = mysqli_query($conn, "SELECT count(id) as total FROM blog");
                    $row2 = mysqli_fetch_assoc($result2);
                    $total = $row2['total'];
                    $result = mysqli_query($conn, "SELECT * FROM blog WHERE status=1 AND idUser = $idUser   ORDER BY id DESC LIMIT 9,$total");
                } else {
                    $result = mysqli_query($conn, "SELECT * FROM blog WHERE status=1 AND idUser = $idUser  ORDER BY id DESC LIMIT 9");
                }
                while ($row = mysqli_fetch_array($result)) {

                ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-item set-bg" data-setbg="../uploads/blog/<?php echo $row['image'] ?>">
                            <!-- <form action="edit-blog.php" method="POST"> -->
                                <!-- <input type="hidden" name="edit">
                                <input type="hidden" name="idBlog" value="<?php echo $row['id'] ?>"> -->
                                <a href="edit-blog.php?id=<?php echo $row['id'] ?>" class="edit-btn" onclick="editBlog(<?php echo $row['id']; ?>)"><i class="fa fa-edit"></i> Edit</a>
                            <!-- </form> -->
                            <div class="bi-text">
                                <span class="b-tag"><?php
                                                    $result3 = mysqli_query($conn, "SELECT * FROM category_blog WHERE id = " . $row['category_id']);
                                                    $row3 = mysqli_fetch_assoc($result3);
                                                    echo $row3['name'];
                                                    ?></span>
                                <h4><a href="blog-details.php?id=<?php echo $row['id']; ?>"><?php echo $row['title'] ?></a></h4>
                                <div class="b-time"><i class="icon_clock_alt"></i><?php echo date("d M, Y", $row['timePost']) ?></div>

                            </div>
                        </div>
                    </div>
                <?php  } ?>

                <?php if (isset($_GET['id'])) {
                ?>
                    <div class="col-lg-12">
                        <div class="load-more">
                            <a href="posted-blog.php" class="primary-btn">Return</a>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-lg-12">
                        <div class="load-more">
                            <a href="posted-blog.php?id=1" class="primary-btn">Load More</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

    <?php
    mysqli_close($conn);
    include("footer.php") ?>
</body>

</html>