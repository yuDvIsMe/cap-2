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
        <h1>Trang cảm ơn</h1>
    </div>
</div>
 