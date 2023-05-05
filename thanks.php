<?php
require_once('./config.php');
require_once('./classes/DBConnection.php');
require_once('inc/header.php');
require_once('inc/subnav.php');

if (isset($_GET['vnp_Amount'])) {
    $vnp_Amount = $_GET['vnp_Amount'] / 100;
    $vnp_BankCode = $_GET['vnp_BankCode'];
    $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
    $vnp_CardType = $_GET['vnp_CardType'];
    $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
    $vnp_PayDate = $_GET['vnp_PayDate'];
    $vnp_TmnCode = $_GET['vnp_TmnCode'];
    $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
    $vnp_ResponseCode = $_GET['vnp_ResponseCode'];
    $ticket_no = $_SESSION['ticket_no'];
}

if ($_GET['vnp_ResponseCode'] == '00') {
    $insert_vnpay = "INSERT INTO vnpay_payment(vnp_Amount, ticket_no, vnp_BankCode, vnp_BankTranNo, vnp_CardType, vnp_OrderInfo, vnp_PayDate, vnp_TmnCode, vnp_TransactionNo,vnp_ResponseCode) 
                     VALUE('" . $vnp_Amount . "','" . $ticket_no . "','" . $vnp_BankCode . "','" . $vnp_BankTranNo . "','" . $vnp_CardType . "','" . $vnp_OrderInfo . "','" . $vnp_PayDate . "','" . $vnp_TmnCode . "',
                     '" . $vnp_TransactionNo . "','" . $vnp_ResponseCode . "')";
    $query = $conn->query($insert_vnpay);
    $update_qry = $conn->query("UPDATE `violation_list` SET `status` = 1 WHERE `ticket_no` = '{$ticket_no}'");
    if (!$update_qry) {
        echo $conn->error;
    }
}



?>
<?php
if ($_GET['vnp_ResponseCode'] == '00') { ?>
    <div class="contact mt-125">
        <div class="container">
            <h1 class="title-payment">Thanh toán thành công</h1>

            <div class="row" style="margin-top: 30px">
                <div class="col-6">
                    <div style="display: flex;">
                        <label class="lb-payment">Mã giao dịch:</label>
                        <p><?php echo $vnp_BankTranNo ?></p>
                    </div>
                    <div style="display: flex;">
                        <label class="lb-payment">Số QĐXP:</label>
                        <p><?php echo $ticket_no ?></p>
                    </div>
                    <div style="display: flex;">
                        <label class="lb-payment">Số tiền phạt:</label>
                        <p><?php echo $vnp_Amount . ' VND' ?></p>
                    </div>
                    <div style="display: flex;">
                        <label class="lb-payment">Nội dung thanh toán:</label>
                        <p><?php echo $vnp_OrderInfo ?></p>
                    </div>

                    <div style="display: flex;">
                        <label class="lb-payment">Thời gian thanh toán:</label>
                        <p><?php echo $vnp_PayDate ?></p>
                    </div>
                    <div style="display: flex;">
                        <label class="lb-payment">Trạng thái:</label>
                        <p><?php
                            if ($_GET['vnp_ResponseCode'] == '00') {
                                echo "<span style='color:blue'>GD Thành công</span>";
                            } else {
                                echo "<span style='color:red'>GD Không thành công</span>";
                            }
                            ?></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="thanks mt-125">
        <div class="container">
            <h1 class="title-payment">Thanh toán thất bại</h1>
        </div>
    </div>
<?php } ?>