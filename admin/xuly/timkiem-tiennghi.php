<?php
include "../connect.php";
$a = $_POST['data'];
$query = mysqli_query($conn, "SELECT * FROM tiennghi WHERE name LIKE '%$a%' ");
$num = mysqli_num_rows($query);
if ($num > 0) {
    $i = 1;
    while ($row = mysqli_fetch_array($query)) {
?>
        <tr>
            <td style="display: none;"><?php echo $row['id']; ?></td>
            <td><?php echo $i ?></td>
            <td><?php echo $row['name'] ?></td>
            <td>
                <?php if ($row['status'] == 0) { ?>
                    <button class="btn btn-secondary" id="btnStatus">Tạm ngừng</button>
                <?php } else { ?>
                    <button class="btn btn-primary" id="btnStatus">Hoạt động</button>
                <?php } ?>
            </td>
            <td>
                <div class="d-flex align-items-center">
                    <button type="button" data-tiennghi-id="<?php echo $row['id']; ?>" class="btn btn-info btn-sm btn-icon-text mr-3" id="btnShowFormUpdate">
                        <i class="typcn typcn-edit btn-icon-append"></i>
                    </button>
                    <button name="delete-btn" id="delete-btn" data-tiennghi-id="<?php echo $row['id']; ?>" type="button" class="btn btn-danger btn-sm btn-icon-text">
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