<?php
include "../connect.php";
$a = $_POST['data'];
$query = mysqli_query($conn, "SELECT * FROM booking where name like '%$a%' OR phone like '%$a%' OR email like '%$a%' ");
$num = mysqli_num_rows($query);
if ($num > 0) {
    $i = 1;
    while ($row = mysqli_fetch_array($query)) {
            $result2 = mysqli_query($conn, "SELECT * FROM room WHERE id = " . $row['idRoom']);
            $row2 = mysqli_fetch_assoc($result2);
?>
            <tr>
                <td style="display: none;"><?php echo $row['id']; ?></td>
                <td><?php echo $i ?></td>
                <td>
                    <p><b>Họ tên: </b><?php echo $row['name'] ?></p>
                    <p><b>Số điện thoại: </b><?php echo $row['phone'] ?></p>
                    <p><b>Email: </b><?php echo $row['email'] ?></p>
                </td>
                <td>
                    <p><b>Tên phòng: </b><?php echo $row2['name'] ?></p>
                    <p><b>Giá phòng: </b>$<?php echo $row['price'] ?></p>
                    <p><b>Số lượng phòng: </b><?php echo $row['quantity'] ?> phòng</p>
                    <p><b>Tổng tiền: </b>$<?php echo $row['total'] ?></p>
                </td>
                <td>
                    <p><b>Ngày vào: </b><?php echo date("d-m-Y", strtotime($row['date-in'])) ?></p>
                    <p><b>Ngày ra: </b><?php echo date("d-m-Y", strtotime($row['date-out'])) ?></p>
                    <p><b>Số ngày ở: </b><?php echo $row['nights'] ?> ngày</p>
                    <p><b>Thanh toán: </b>$<?php echo $row['thanhToan'] ?></p>
                </td>
                <td><?php
                    if ($row['status'] == 1) {
                        echo '<span class="btn btn-inverse-info btn-fw tags">Đang Chờ Xác Nhận</span>';
                    } elseif ($row['status'] == 2) {
                        echo '<span class="btn btn-inverse-danger btn-fw tags">Đã Hủy</span>';
                    } elseif ($row['status'] == 3) {
                        echo '<span class="btn btn-inverse-success btn-fw tags">Đã Xác Nhận</span>';
                    } elseif (($row['status'] == 4) || ($row['status'] == 5)) {
                        echo '<span class="btn btn-inverse-primary btn-fw tags">Đã Thanh Toán</span>';
                    }
                    ?></td>
                <td>
                    <?php if (($row['status'] == 4) || ($row['status'] == 5)) { ?>
                        <button type="button" data-booking-id="<?php echo $row['id']; ?>" class="btn btn-primary btn-sm btn-icon-text mr-3 btnInHoaDon">
                            <i class="typcn typcn-upload btn-icon-append"></i> In Hóa Đơn
                        </button>
                    <?php } ?>
                </td>
            </tr>
<?php
            $i++;
        
    }
}

?>