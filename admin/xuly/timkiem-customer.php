<?php
include "../connect.php";
$a = $_POST['data'];
$query = mysqli_query($conn, "SELECT * FROM User where Fullname like '%$a%' OR Phone like '%$a%' OR Email like '%$a%' ");
$num = mysqli_num_rows($query);
if ($num > 0) {
    $i = 1;
    while ($row = mysqli_fetch_array($query)) {
?>
        <tr>
            <td><?php echo $i ?></td>
            <td><img src="../uploads/user/<?php if (!empty($row['Avatar'])) {
                                                echo $row['Avatar'];
                                            } else {
                                                echo 'user.png'; // Hiển thị dữ liệu mặc định khi $row['img'] rỗng
                                            } ?>" alt=""></td>
            <td><?php echo $row['Fullname'] ?></td>
            <td><?php echo $row['Email'] ?></td>
            <td><?php echo $row['Phone'] ?></td>
            <td><?php echo $row['Address'] ?></td>
            <td><?php echo date("d-m-Y", strtotime($row['Birthday'])) ?></td>
            <td><?php echo date("d-m-Y H:i:s", strtotime($row['timeRegister'])) ?></td>
            <td>
                <?php if ($row['status'] == 0) { ?>
                    <button class="btn btn-danger">Vô hiệu hóa</button>
                <?php } else { ?>
                    <button class="btn btn-success">Hoạt động</button>
                <?php } ?>
            </td>
            <td>
                <div class="d-flex align-items-center">
                    <button type="button" data-customer-id="<?php echo $row['id']; ?>" class="btn btn-info btn-sm btn-icon-text mr-3" id="btnShowFormUpdate">
                        <i class="typcn typcn-edit btn-icon-append"></i>
                    </button>
                    <button name="delete-btn" id="delete-btn" data-customer-id="<?php echo $row['id']; ?>" type="button" class="btn btn-danger btn-sm btn-icon-text">
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