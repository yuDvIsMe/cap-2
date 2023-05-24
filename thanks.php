<?php
require_once('./config.php');
require_once('./classes/DBConnection.php');
require_once('inc/header.php');
require_once('inc/subnav.php');

if (isset($_GET['vnp_Amount'])) {
    $vnp_Amount = $_GET['vnp_Amount'] / 100;
    $vnp_BankCode = $_GET['vnp_BankCode'];
    if (isset($_GET['vnp_BankTranNo'])) {
        $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
    }
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
    $qry = $conn->query("SELECT * from `violation_list` where ticket_no = '{$ticket_no}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
    sendMail($driver_email, $ticket_no, $vnp_BankTranNo, $vnp_Amount, $vnp_OrderInfo, $vnp_PayDate);
}

function sendMail($mail_address, $ticket, $BankTranNo, $amount, $Order, $date)
{
    require "./PHPMailer/src/PHPMailer.php";
    require "./PHPMailer/src/SMTP.php";
    require './PHPMailer/src/Exception.php';
    $mail = new PHPMailer\PHPMailer\PHPMailer(true); //true:enables exceptions
    try {
        $mail->SMTPDebug = 0; //0,1,2: chế độ debug
        $mail->isSMTP();
        $mail->CharSet  = "utf-8";
        $mail->Host = 'smtp.gmail.com';  //SMTP servers
        $mail->SMTPAuth = true; // Enable authentication
        $mail->Username = 'tvms.contact.dn@gmail.com'; // SMTP username
        $mail->Password = 'rixdltzhkcwdxujf';   // SMTP password
        $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
        $mail->Port = 465;  // port to connect to                
        $mail->setFrom('tvms.contact.dn@gmail.com', 'Cổng dịch vụ TVMS');
        $mail->addAddress($mail_address);
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Hoàn tất thanh toán vi phạm hành chính về giao thông';
        $noidungthu = " Chào bạn,
		<p>Bạn đã hoàn tất việc thanh toán vi phạm hành chính về an toàn giao thông số <b>{$ticket}</b>. </p>
		<p>Dưới đây là nội dung chi tiết thanh toán vi phạm của bạn</p>
		<div class='table-responsive'>
                <div class='form-group'>
                    <label >Mã giao dịch: $BankTranNo</label>
                </div>    
                <div class='form-group'>

                    <label >Số tiền: $amount VNĐ</label>
                </div>  
                <div class='form-group'>
                    <label >Nội dung thanh toán: $Order</label>
                </div> 
                <div class='form-group'>
                    <label >Số quyết định xử phạt: $ticket</label>
                </div> 
                <div class='form-group'>
                    <label >Thời gian thanh toán: $date</label>
                </div> 
            </div>
            
        <p>Vui lòng cung cấp biên lai của biên bản xử phạt tại trang xử lý thanh toán hoặc email này tại cơ quan để có thể hoàn tất thủ tục.</p>
        <p>Trân trọng!</p>";
        $mail->Body = $noidungthu;
        $mail->smtpConnect(array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));
        $mail->send();
    } catch (Exception $e) {
        echo 'Error: ', $mail->ErrorInfo;
    }
}




?>
<?php
if ($_GET['vnp_ResponseCode'] == '00') { ?>
    <div class="contact mt-125">
        <div class="container">
            <div class="fail-bg" data-aos="fade-up" data-aos-duration="1500">
                <div class="align-items-center div-payment">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <img src="img/thanhcong.png" style="height: 145px;">
                        <h4 class="title-payment-success">Thanh toán thành công</h4>
                    </div>
                    <input type="hidden" id="ticket_no" value="<?php echo $ticket_no ?>"></input>
                    <div class="row" style="margin-top: 30px">
                        <div class="col-12">
                            <div style="display: flex; justify-content: space-between;">
                                <label class="lb-payment">Mã giao dịch:</label>
                                <p><?php echo 'a' ?></p>
                            </div>
                            <div class="divider-gray"></div>

                            <div style="display: flex; justify-content: space-between;">
                                <label class="lb-payment">Số QĐXP:</label>
                                <p><?php echo $ticket_no ?></p>
                            </div>
                            <div class="divider-gray"></div>

                            <div style="display: flex; justify-content: space-between;">
                                <label class="lb-payment">Số tiền phạt:</label>
                                <p><?php echo number_format($vnp_Amount) . ' VND' ?></p>
                            </div>
                            <div class="divider-gray"></div>

                            <div style="display: flex; justify-content: space-between;">
                                <label class="lb-payment">Nội dung thanh toán:</label>
                                <p><?php echo $vnp_OrderInfo ?></p>
                            </div>
                            <div class="divider-gray"></div>

                            <div style="display: flex; justify-content: space-between;">
                                <label class="lb-payment">Thời gian thanh toán:</label>
                                <p><?php echo $vnp_PayDate ?></p>
                            </div>
                            <div class="divider-gray"></div>

                            <div style="display: flex; justify-content: space-between;">
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
                    <button class="btn-submit" data-toggle="modal" data-target=".bd-example-modal-lg" id="print_btn">In biên bản</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body" id="modal" style="display: flex; justify-content: space-between;">
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="contact mt-125">
        <div class="container">
            <div class="fail-bg" data-aos="fade-up" data-aos-duration="1500">
                <div class="align-items-center div-payment">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <img class="payment-img" src="img/thatbai.png" alt="">
                        <h4 class="title-payment-fail">Thanh toán thất bại</h4>
                    </div>
                    <div class="row" style="margin-top: 30px">
                        <div class="col-12">
                            <div style="display: flex; justify-content: space-between;">
                                <label class="lb-payment">Mã giao dịch:</label>
                                <p><?php echo 'VNPAYFAIL'.$vnp_ResponseCode ?></p>
                            </div>
                            <div class="divider-gray"></div>

                            <div style="display: flex; justify-content: space-between;">
                                <label class="lb-payment">Số QĐXP:</label>
                                <p><?php echo $ticket_no ?></p>
                            </div>
                            <div class="divider-gray"></div>

                            <div style="display: flex; justify-content: space-between;">
                                <label class="lb-payment">Số tiền phạt:</label>
                                <p><?php echo number_format($vnp_Amount) . ' VND' ?></p>
                            </div>
                            <div class="divider-gray"></div>

                            <div style="display: flex; justify-content: space-between;">
                                <label class="lb-payment">Nội dung thanh toán:</label>
                                <p><?php echo $vnp_OrderInfo ?></p>
                            </div>
                            <div class="divider-gray"></div>

                            <div style="display: flex; justify-content: space-between;">
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
                    <a class="btn-return" href="<?php echo base_url ?>?page=information-lookup">Thanh toán lại</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>



<script>
    $(document).ready(function() {
        $ticketNo = $('#ticket_no')
        $('#print_btn').click(async function(e) {
            console.log($ticketNo)

            const response = await fetch(`view-detail.php?ticket_no=${$ticketNo.val()}`)

            const html = await response.text();

            $("#modal").html(html);
        })
    })
</script>