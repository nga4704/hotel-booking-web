<?php
include "../connect.php";
$a = $_POST['data'];
$query = mysqli_query($conn, "SELECT * FROM services WHERE name LIKE '%$a%' ");
$num = mysqli_num_rows($query);
if ($num > 0) {
    $i = 1;
    while ($row = mysqli_fetch_array($query)) {
?>
        <tr>
            <td><?php echo $i ?></td>
            <td><i class="<?php echo $row['icon'] ?>"></i></td>
            <td><?php echo $row['name'] ?></td>
            <td style="max-width: 400px;white-space: wrap;">
                <p><?php echo $row['detail'] ?>
                </p>
            </td>
            <td>
                <?php if ($row['status'] == 0) { ?>
                    <button class="btn btn-secondary" id="btnStatus">Tạm ngừng</button>
                <?php } else { ?>
                    <button class="btn btn-primary" id="btnStatus">Hoạt động</button>
                <?php } ?>
            </td>
            <td>
                <div class="d-flex align-items-center">
                    <button type="button" data-service-id="<?php echo $row['id']; ?>" class="btn btn-info btn-sm btn-icon-text mr-3" id="btnShowFormUpdate">
                        <i class="typcn typcn-edit btn-icon-append"></i>
                    </button>
                    <button name="delete-btn" id="delete-btn" data-service-id="<?php echo $row['id']; ?>" type="button" class="btn btn-danger btn-sm btn-icon-text">
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