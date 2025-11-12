<?php
include "../connect.php";
$a = $_POST['data'];
$query = mysqli_query($conn, "SELECT * FROM booking where name like '%$a%' OR phone like '%$a%' OR email like '%$a%' ");
$num = mysqli_num_rows($query);
if ($num > 0) {
    $i = 1;
    while ($row = mysqli_fetch_array($query)) {
        if ($row['status'] == 1) {
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
                    <p><b>Ngày đặt: </b><?php echo date("d-m-Y H:i:s", $row['timeBooking']) ?></p>
                </td>
                <td>
                    <button style="margin-bottom: 15px;" type="button" data-booking-id="<?php echo $row['id']; ?>" class="btn btn-info btn-sm btn-icon-text mr-3 btnXacNhan">
                        <i class="typcn typcn-tick-outline btn-icon-append"></i> Xác Nhận Đặt Phòng
                    </button><br>
                    <button name="delete-btn" id="delete-btn" data-booking-id="<?php echo $row['id']; ?>" type="button" class="btn btn-danger btn-sm btn-icon-text btnHuy">
                        <i class="typcn typcn-times-outline btn-icon-append"></i> Hủy Đặt Phòng
                    </button>
                </td>
            </tr>
<?php
            $i++;
        }
    }
}

?>