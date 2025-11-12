<?php
include "../connect.php";
$a = $_POST['data'];
$query = mysqli_query($conn, "SELECT * FROM category_room where name like '%$a%'");
$num = mysqli_num_rows($query);
if ($num > 0) {
    $i = 1;
    while ($row = mysqli_fetch_array($query)) {
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


<?php
        $i++;
    }
}

?>