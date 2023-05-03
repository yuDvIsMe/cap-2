<?php 
require_once('./config.php');
require_once('./classes/DBConnection.php');
require_once('inc/header.php');
require_once('inc/subnav.php');

if(isset($_GET['vnp_Amount'])){
    $vnp_Amount= $_GET['vnp_Amount'];
    $vnp_BankCode= $_GET['vnp_BankCode'];
    $vnp_BankTranNo= $_GET['vnp_BankTranNo'];
    $vnp_CardType= $_GET['vnp_CardType'];
    $vnp_OrderInfo= $_GET['vnp_OrderInfo'];
    $vnp_PayDate= $_GET['vnp_PayDate'];
    $vnp_TmnCode= $_GET['vnp_TmnCode'];
    $vnp_TransactionNo= $_GET['vnp_TransactionNo'];
    $vnp_ResponseCode= $_GET['vnp_ResponseCode'];
    $ticket_no = $_SESSION['ticket_no'];


    $insert_vnpay = "INSERT INTO vnpay_payment(vnp_Amount, ticket_no, vnp_BankCode, vnp_BankTranNo, vnp_CardType, vnp_OrderInfo, vnp_PayDate, vnp_TmnCode, vnp_TransactionNo,vnp_ResponseCode) 
                     VALUE('".$vnp_Amount."','".$ticket_no."','".$vnp_BankCode."','".$vnp_BankTranNo."','".$vnp_CardType."','".$vnp_OrderInfo."','".$vnp_PayDate."','".$vnp_TmnCode."',
                     '".$vnp_TransactionNo."','".$vnp_ResponseCode."')";
    $query = $conn->query($insert_vnpay);
    if($query){
        echo '<h3>Giao dich VNPAY thanh cong</h3>';
    }else{
        echo '<h3>Giao dich VNPAY that bai</h3>';
    }
    
}
if ($_GET['vnp_ResponseCode'] == '00') {
    $update_qry = $conn->query("UPDATE `violation_list` SET `status` = 1 WHERE `ticket_no` = '{$ticket_no}'");
    if (!$update_qry) {
        echo $conn->error;
    }
}



?>

<div class="contact mt-125">
    <div class="container">
        <h1 class="title-payment" style="display: flex; justify-content: center;">Đã thanh toán</h1>

        <div class="row" style="margin-top: 50px">
            <div class="col-6">
                <div style="display: flex;">
                    <label class="lb-payment">Số QĐXP:</label>
                    <p>G64657572</p>
                </div>
                <div style="display: flex;">
                    <label class="lb-payment">Số giấy phép lái xe:</label>
                    <p>G64657572</p>
                </div>
            </div>

            <div class="col-6">
                <div style="display: flex;">
                    <label class="lb-payment">Người điều khiển:</label>
                    <p>G64657572</p>
                </div>
                <div style="display: flex;">
                    <label class="lb-payment">Thời gian:</label>
                    <p>G64657572</p>
                </div>
            </div>

            <div class="col-6">
                <div style="display: flex;">
                    <label class="lb-payment">Mã vi phạm:</label>
                    <p>G64657572</p>
                </div>
                <div style="display: flex;">
                    <label class="lb-payment">Tên vi phạm:</label>
                    <p>G64657572</p>
                </div>
                <div style="display: flex;">
                    <label class="lb-payment">Tiền phạt:</label>
                    <p>G64657572</p>
                </div>
            </div>

            <div class="col-6" style="display: flex;">
                <label class="lb-payment">Nhận xét:</label>
                <p>G64657572</p>
            </div>
            
        </div>
        <a class="btn-login" style="display: flex; justify-content: center;">In biên bản</a>
    </div>
</div>
 