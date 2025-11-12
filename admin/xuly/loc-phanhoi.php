<?php
include "../connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['filter'])) {
    $filter = $_POST['filter'];

    $query = "SELECT * FROM phanhoi";

    if ($filter === 'unread') {
        $query .= " WHERE status = 0";
    } elseif ($filter === 'read') {
        $query .= " WHERE status = 1";
    }

    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $i = 1;
            while ($row = mysqli_fetch_array($result)) {
                $result2 = mysqli_query($conn, "SELECT * FROM user WHERE id = " . $row['idUser']);
                $row2 = mysqli_fetch_assoc($result2);
?>
                <tr>
                    <td style="display: none;"><?php echo $row['id']; ?></td>
                    <td><?php echo $i ?></td>
                    <td style="vertical-align: middle;  text-align: center; "><img src="../uploads/user/<?php echo $row2['Avatar'] ?>"><br><br>
                        <p><?php echo $row2['Fullname'] ?></p>
                    </td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['title'] ?></td>
                    <td style="min-width: 400px;white-space: wrap;text-align: center;">
                        <p><?php echo $row['message'] ?></p>
                    </td>
                    <td><?php echo date("d-m-Y H:i:s", $row['timeSend']) ?></td>
                    <td>
                        <?php if ($row['status'] == 0) { ?>
                            <button class="btn btn-secondary phanhoi-status" id="btnStatus" data-phanhoi-id="<?php echo $row['id']; ?>">Chưa đọc</button>
                        <?php } else { ?>
                            <button class="btn btn-success phanhoi-status" id="btnStatus" data-phanhoi-id="<?php echo $row['id']; ?>">Đã đọc</button>
                        <?php } ?>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <button type="button" data-phanhoi-id="<?php echo $row['id']; ?>" class="btn btn-info btn-sm btn-icon-text mr-3" id="btnShowFormSend">
                                <i class="typcn typcn-location-arrow-outline btn-icon-append"></i> Trả lời
                            </button>
                            <button name="delete-btn" id="delete-btn" data-phanhoi-id="<?php echo $row['id']; ?>" type="button" class="btn btn-danger btn-sm btn-icon-text">
                                <i class="typcn typcn-delete-outline btn-icon-append"></i>
                            </button>
                        </div>
                    </td>
                </tr>
<?php $i++;
            }
        } else {
            echo "<tr><td colspan='8'>No feedback found.</td></tr>";
        }
    } else {
        echo "<tr><td colspan='8'>Error fetching feedback.</td></tr>";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "<tr><td colspan='8'>Invalid request.</td></tr>";
}
?>