<?php
include "../connect.php";
$a = $_POST['data'];
$query = mysqli_query($conn, "SELECT * FROM room WHERE name LIKE '%$a%' OR numberRoom LIKE '%$a%'");
$num = mysqli_num_rows($query);
if ($num > 0) {
    $i = 1;
    while ($row = mysqli_fetch_array($query)) {
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
                    <button type="button" data-room-id="<?php echo $row['id']; ?>" class="btn btn-secondary btn-sm btn-icon-text mr-3" id="btnShowFormUpdateImage">
                        <i class="typcn typcn-image-outline btn-icon-append"></i>
                    </button>
                    <button name="delete-btn" data-room-id="<?php echo $row['id']; ?>" id="delete-btn" type="button" class="btn btn-danger btn-sm btn-icon-text">
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