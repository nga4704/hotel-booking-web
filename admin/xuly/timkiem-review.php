<?php
include "../connect.php";

// Kiểm tra xem dữ liệu đã được gửi từ form POST hay chưa
if (isset($_POST['data'])) {
    $a = $_POST['data'];

    // Truy vấn tìm kiếm trong bảng User
    $query = mysqli_query($conn, "SELECT user.Fullname AS UserName, room.name AS RoomName, review.star, review.content, review.timePost, review.id
    FROM review
    LEFT JOIN user ON review.idUser = user.id
    LEFT JOIN room ON review.idRoom = room.id
    WHERE user.Fullname LIKE '%$a%' OR room.name LIKE '%$a%'
    ");

    $num = mysqli_num_rows($query);

    if ($num > 0) {
        $i = 1;
        while ($row = mysqli_fetch_assoc($query)) {
?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['RoomName'] ?></td>
                <td><?php echo $row['UserName'] ?></td>
                <td><?php
                    $star = $row['star'];
                    if ($star == 5) {
                        echo 'Rất tốt';
                    } elseif ($star == 4) {
                        echo 'Tốt';
                    } elseif ($star == 3) {
                        echo 'Bình thường';
                    } elseif ($star == 2) {
                        echo 'Tệ';
                    } elseif ($star == 1) {
                        echo 'Rất tệ';
                    }
                    ?></td>
                <td><?php echo $row['content'] ?></td>
                <td><?php echo date("d-m-Y H:i:s", $row['timePost']) ?></td>
                <td style="display: none;"><?php echo $row['id']; ?></td>
                <td>
                    <div class="d-flex align-items-center">
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
} else {
    echo "No data received"; 
}
?>