<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tohoma";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 21cm;
            overflow: hidden;
            min-height: 297mm;
            padding: 2.5cm;
            margin-left: auto;
            margin-right: auto;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {
            padding: 1cm;
            border: 5px red solid;
            height: 237mm;
            outline: 2cm #FFEAEA solid;
        }

        @page {
            size: A4;
            margin: 0;
        }

        button {
            width: 100px;
            height: 24px;
        }

        .header {
            overflow: hidden;
            display: flex;
            justify-content: space-between;
        }

        .logo {
            background-color: #FFFFFF;
            /* text-align: left;
            float: left; */
            margin-top: 0px;
            /* width: auto; */
            /* min-height: 100px; */
        }

        .company {
            padding-top: 24px;
            /* text-transform: uppercase; */
            background-color: #FFFFFF;
            text-align: left;
            float: left;
            font-size: 16px;
        }

        .title {
            text-align: center;
            position: relative;
            /* color: #0000FF; */
            font-size: 24px;
            top: 1px;
        }

        .footer-left {
            text-align: center;
            /* text-transform: uppercase; */
            padding-top: 24px;
            position: relative;
            height: 150px;
            width: 50%;
            color: #000;
            float: left;
            font-size: 12px;
            bottom: 1px;
        }

        .footer-right {
            text-align: center;
            /* text-transform: uppercase; */
            padding-top: 24px;
            position: relative;
            height: 150px;
            width: 50%;
            color: #000;
            font-size: 12px;
            float: right;
            bottom: 1px;
        }

        .TableData {
            background: #ffffff;
            font: 11px;
            width: 100%;
            border-collapse: collapse;
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 12px;
            /* border: thin solid #d3d3d3; */
            border: 1px solid #fff;
        }

        .TableData TH {
            background: rgba(0, 0, 255, 0.1);
            text-align: center;
            font-weight: bold;
            color: #000;
            border: solid 1px #ccc;
            height: 24px;
            border: 1px solid #fff;
        }

        .TableData TR {
            height: 24px;
            border: thin solid #d3d3d3;
            border: 1px solid #fff;
        }

        .TableData TR TD {
            border: thin solid #d3d3d3;
            border: 1px solid #fff;
            padding: 5px;

        }

        .TableData TR:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .TableData .cotSTT {
            text-align: center;
            width: 10%;
        }

        .TableData .cotTenSanPham {
            text-align: left;
            width: 40%;
        }

        .TableData .cotHangSanXuat {
            text-align: left;
            width: 20%;
        }

        .TableData .cotGia {
            text-align: right;
            width: 120px;
        }

        .TableData .cotSoLuong {
            text-align: center;
            width: 50px;
        }

        .TableData .cotSo {
            text-align: right;
            width: 120px;
        }

        .TableData .tong {
            text-align: right;
            font-weight: bold;
            text-transform: uppercase;
            padding-right: 4px;
        }

        .TableData .cotSoLuong input {
            text-align: center;
        }

        @media print {
            @page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>

</head>

<body onload="window.print();">
    <div id="page" class="page">
        <div class="header">
            <div class="company">
                <div class="logo"><img src="../uploads/admin/logo.png" /></div>
                <p><b>Địa chỉ: </b>Đà Nẵng</p>
                <p><b>Số điện thoại: </b>0123456789</p>
            </div>
            <div class="company">
                <p><b>SONA HOTEL</b></p>
                <p><b>Email: </b>sona@gmail,com</p>
                <p><b>Website: </b>sona-master.com</p>
            </div>

        </div>
        <br />
        <div class="title">
            HÓA ĐƠN THANH TOÁN
            <br><br>
            <hr>
        </div>
        <table class="TableData">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['inHoaDon'])) {
                    include("./connect.php");
                    $id = $_POST['idBooking'];
                    $result = mysqli_query($conn, "SELECT * FROM booking WHERE id = $id");
                    $row = mysqli_fetch_assoc($result);
                    $result2 = mysqli_query($conn, "SELECT * FROM room WHERE id = " . $row['idRoom']);
                    $row2 = mysqli_fetch_assoc($result2);
            ?>
                    <tr>
                        <td><b>Hóa đơn số</b></td>
                        <td>: <?php echo $row['id'] ?></td>
                    </tr>
                    <tr>
                        <td><b>Tên khách hàng</b></td>
                        <td>: <?php echo $row['name'] ?></td>
                        <td><b>Số điện thoại</b></td>
                        <td>: <?php echo $row['phone'] ?></td>
                    </tr>
                    <tr>
                        <td><b>Email</b></td>
                        <td colspan="3">: <?php echo $row['email'] ?></td>
                    </tr>
                    <tr>
                        <td><b>Địa chỉ</b></td>
                        <td colspan="3">: <?php echo $row['address'] ?></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>

                    <tr>
                        <td><b>Số phòng</b></td>
                        <td>: <?php echo $row2['numberRoom'] ?></td>
                        <td><b>Giá</b></td>
                        <td>: $<?php echo $row['price'] ?>/đêm</td>
                    </tr>
                    <tr>
                        <td><b>Tên phòng</b></td>
                        <td>: <?php echo $row2['name'] ?></td>
                        <td><b>Số lượng</b></td>
                        <td>: <?php echo $row['quantity'] ?> phòng</td>
                    </tr>
                    <tr>
                        <td><b>Ngày vào</b></td>
                        <td>: <?php echo date("d/m/Y", strtotime($row['date-in'])) ?></td>
                        <td><b>Số ngày ở</b></td>
                        <td>: <?php echo $row['nights'] ?> ngày</td>

                    </tr>
                    <tr>
                        <td><b>Ngày ra</b></td>
                        <td>: <?php echo date("d/m/Y", strtotime($row['date-out'])) ?></td>
                        <td><b>Tổng tiền</b></td>
                        <td>: $<?php echo $row['total'] ?></td>
                    </tr>
            <?php   }
            }
            ?>
        </table>
        <br>
        <hr>

        <br>
        <?php
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $timestamp = time();
        $currentDate = date('\n\g\à\y d \t\há\n\g m \n\ă\m Y');
        ?>
        <div class="footer-left"> <i>Đà Nẵng, <?php echo $currentDate ?></i><br>
            <b> Khách hàng </b>
        </div>
        <div class="footer-right"><i> Đà Nẵng, <?php echo $currentDate ?></i><br>
            <b>Nhân viên </b>
        </div>
    </div>
</body>

</html>