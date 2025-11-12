<?php
include "../connect.php";

if (isset($_POST['data'])) {
    $a = $_POST['data'];

    $query = mysqli_query($conn, "SELECT  blog.id, blog.title, blog.image, blog.author, blog.content, blog.timePost, blog.timeUpdate, blog.status, category_blog.name, blog.category_id
    FROM blog
    LEFT JOIN category_blog ON blog.category_id = category_blog.id
    WHERE blog.title LIKE '%$a%' OR blog.author LIKE '%$a%' OR category_blog.name LIKE '%$a%'
    ");

    $num = mysqli_num_rows($query);

    if ($num > 0) {
        $i = 1;
        while ($row = mysqli_fetch_assoc($query)) {
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

<?php
            $i++;
        }
    }
} else {
    echo "No data received"; // Thông báo nếu không nhận được dữ liệu từ POST
}
?>