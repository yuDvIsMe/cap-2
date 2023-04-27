<?php
require_once('config_vnpay.php');
$ticket_no = $_SESSION['ticket_no'];
if (isset($ticket_no)) {
    $qry = $conn->query("SELECT r.*,d.license_id_no, d.name as driver from `violation_list` r inner join `drivers_list` d on r.driver_id = d.id where r.ticket_no = '{$ticket_no}' ");
    if ($conn->error) {
        echo $conn->error . "\n";
        echo "SELECT r.*,d.license_id_no, d.name as driver from `violation_list` r inner join `drivers_list` on r.driver_id = d.id where r.ticket_no = '{$ticket_no}' ";
    }
    $qry2 = $conn->query("SELECT i.*,o.code,o.name from `violation_items` i inner join `violations` o on i.violation_id = o.id inner join `violation_list` vl on i.driver_violation_id = vl.id where vl.ticket_no = '{$ticket_no}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
    $violation_arr = array();
    if ($qry2->num_rows > 0) {
        while ($row = $qry2->fetch_assoc()) {
            $violation_arr[] = $row;
        }
    }
}

$vnp_TxnRef = $ticket_no; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
$vnp_OrderInfo = "Thanh toán vi phạm giao thông số {$ticket_no}";
$vnp_OrderType = 'billpayment';
$vnp_Amount = $total_amount *100;
$vnp_Locale = 'vn';
$vnp_BankCode = 'NCB';
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
//Add Params of 2.0.1 Version
$vnp_ExpireDate = $expire;
$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
    "vnp_ExpireDate"=>$vnp_ExpireDate
);

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}
// if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
//     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
// }

//var_dump($inputData);
ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}
header('Location: ' . $vnp_Url);
die();
// $returnData = array('code' => '00'
//     , 'message' => 'success'
//     , 'data' => $vnp_Url);
//     if (isset($_POST['redirect'])) {
//         header('Location: ' . $vnp_Url);
//         die();
//     } else {
//         echo json_encode($returnData);
//     }
// ?>