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
            <div class="fail-bg" data-aos="fade-up" data-aos-duration="1500">
                <div class="align-items-center div-payment">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <img src="img/thanhcong.png" style="height: 145px;">
                        <h4 class="title-payment-success">Thanh toán thành công</h4>
                    </div>
                    <div class="row" style="margin-top: 30px">
                        <div class="col-12">
                            <div style="display: flex; justify-content: space-between;">
                                <label class="lb-payment">Mã giao dịch:</label>
                                <p><?php echo $vnp_BankTranNo ?></p>
                            </div>
                            <div class="divider-gray"></div>

                            <div style="display: flex; justify-content: space-between;">
                                <label class="lb-payment">Số QĐXP:</label>
                                <p><?php echo $ticket_no ?></p>
                            </div>
                            <div class="divider-gray"></div>

                            <div style="display: flex; justify-content: space-between;">
                                <label class="lb-payment">Số tiền phạt:</label>
                                <p><?php echo $vnp_Amount . ' VND' ?></p>
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
                                <p><?php echo $vnp_BankTranNo ?></p>
                            </div>
                            <div class="divider-gray"></div>

                            <div style="display: flex; justify-content: space-between;">
                                <label class="lb-payment">Số QĐXP:</label>
                                <p><?php echo $ticket_no ?></p>
                            </div>
                            <div class="divider-gray"></div>

                            <div style="display: flex; justify-content: space-between;">
                                <label class="lb-payment">Số tiền phạt:</label>
                                <p><?php echo $vnp_Amount . ' VND' ?></p>
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
        $ticket = '<?php echo $ticket_no; ?>';
        $('#print_btn').click(async function(e) {
            console.log(e)

            const response1 = await fetch(`view-detail.php?ticket_no= ${$ticket}`)

            const html1 = await response1.text();

            $("#modal").html(html1);
        })
    })
</script>