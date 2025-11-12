<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
        include "connect.php";

        $targetDirectory = "../uploads/hero/";
        $fileExtension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION); // Get the file extension
        $idQuery = mysqli_query($conn, "SELECT MAX(id) AS max_id FROM slided");
        $idRow = mysqli_fetch_assoc($idQuery);
        $nextId = $idRow['max_id'] + 1;
        $targetFile = $targetDirectory . "hero-" . $nextId . "." . $fileExtension; // Use the original file extension

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $insertQuery = "INSERT INTO slided (image) VALUES ('hero-" . $nextId . "." . $fileExtension . "')";
            if (mysqli_query($conn, $insertQuery)) {
                echo '<script language="javascript">';
                echo 'alert("Thêm ảnh thành công!");';
                echo '</script>';
                header("location:slided.php");
            } else {
                echo '<script language="javascript">';
                echo 'alert("Thêm ảnh không thành công.");';
                echo '</script>';
            }
        } else {
            echo "Error uploading file.";
        }

        mysqli_close($conn);
        exit();
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
                                        <h3 class="card-title" style="margin-top: 20px;">Slides</h3>
                                    </div>

                                    <form action="slided.php" id="uploadForm" method="post" enctype="multipart/form-data">
                                        <div class="form-group" style="margin-top: 10px;display: flex;justify-content: right;">
                                            <label for="image" class="btn-primary custom-file-upload" style="display: flex;">
                                                <i class="typcn typcn-document-add btn-icon-append" style="margin: -1px 2px 0 0;"></i>Thêm
                                            </label>
                                            <input style="display: none;" type="file" class="form-control" id="image" name="image">
                                            <input type="submit" value="Xong"  class="form-control btn-light" id="image" name="image">
                                        </div>
                                    </form>

                                </nav>
                                <div class="table-responsive" style="margin-top: -15px;">
                                    <table class="table table-striped project-orders-table">
                                        <thead>
                                            <tr>
                                                <th>Ảnh</th>
                                                <th>Xóa</th>
                                            </tr>
                                        </thead>
                                        <tbody class="danhsach">
                                            <?php
                                            $result = mysqli_query($conn, "SELECT * FROM slided ORDER BY id DESC ");
                                            $i = 1;
                                            while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                                <tr>
                                                    <td><img style="min-width: 800px; height: auto; border-radius: 0px;" src="../uploads/hero/<?php echo $row['image']; ?>"></td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <button name="delete-btn" id="delete-btn" data-slided-id="<?php echo $row['id']; ?>" type="button" class="btn btn-danger btn-sm btn-icon-text">
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
        // Xóa slided
        $(document).on("click", "#delete-btn", function() {
            var rowToDelete = $(this).closest("tr"); // Lưu trữ dòng để xóa
            // var reviewId = rowToDelete.find("td:first").text().trim(); 
            var slidedId = $(this).data("slided-id");
            var confirmation = confirm("Bạn có chắc chắn muốn xóa slided này không?");

            if (confirmation) {
                $.ajax({
                    type: "POST",
                    url: "xuly/delete.php",
                    data: {
                        slidedId: slidedId
                    },
                    success: function(response) {
                        if (response === "success") {
                            rowToDelete.remove();
                            alert("Slided đã được xóa thành công!");
                        } else {
                            alert("Xóa slided không thành công!");
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