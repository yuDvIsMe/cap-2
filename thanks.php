<?php
require_once('./config.php');
require_once('./classes/DBConnection.php');
require_once('inc/header.php');
require_once('inc/subnav.php');

if (isset($_GET['vnp_Amount'])) {
    $vnp_Amount = $_GET['vnp_Amount']/100;
    $vnp_BankCode = $_GET['vnp_BankCode'];
    $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
    $vnp_CardType = $_GET['vnp_CardType'];
    $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
    $vnp_PayDate = $_GET['vnp_PayDate'];
    $vnp_TmnCode = $_GET['vnp_TmnCode'];
    $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
    $vnp_ResponseCode = $_GET['vnp_ResponseCode'];
    $ticket_no = $_SESSION['ticket_no'];

    $insert_vnpay = "INSERT INTO vnpay_payment(vnp_Amount, ticket_no, vnp_BankCode, vnp_BankTranNo, vnp_CardType, vnp_OrderInfo, vnp_PayDate, vnp_TmnCode, vnp_TransactionNo,vnp_ResponseCode) 
                     VALUE('" . $vnp_Amount . "','" . $ticket_no . "','" . $vnp_BankCode . "','" . $vnp_BankTranNo . "','" . $vnp_CardType . "','" . $vnp_OrderInfo . "','" . $vnp_PayDate . "','" . $vnp_TmnCode . "',
                     '" . $vnp_TransactionNo . "','" . $vnp_ResponseCode . "')";
    $query = $conn->query($insert_vnpay);
    if ($query) {
        echo '<h3>Giao dich VNPAY thanh cong</h3>';
    } else {
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

<section class="page_404">
	<div class="container">
		<div class="row">	
            <div class="col-sm-12 ">
                <div class="col-sm-10 col-sm-offset-1  text-center">
                    <div class="four_zero_four_bg">
                        <h1 class="title-payment">Thanh toán thành công</h1>
                    </div>
                    
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
                                <p><?php echo $vnp_Amount.' VND' ?></p>
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
		</div>
	</div>
</section>

<div class="thanks mt-125">
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
                    <p><?php echo $vnp_Amount.' VND' ?></p>
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
        <button class="btn-submit" data-toggle="modal" data-target=".bd-example-modal-lg" id="printButton" >In biên bản</button>
    </div>
</div>

<script>
	$(document).ready(function(){
        $('#filter').click(function(){
            location.replace("./?page=reports&date_start="+($('#date_start').val())+"&date_end="+($('#date_end').val()));
        })

        $('#print').click(function(){
            start_loader()
            var _h = $('head').clone()
            var _p = $('#print_out').clone();
            var _el = $('<div>')
            _el.append(_h)
            _el.append('<style>html, body, .wrapper {min-height: unset !important;}</style>')
            var rdate = "";
            if('<?php echo $date_start ?>' == '<?php echo $date_end ?>')
                rdate = "<?php echo date("M d, Y",strtotime($date_start)) ?>";
            else
                rdate = "<?php echo date("M d, Y",strtotime($date_start)) ?> - <?php echo date("M d, Y",strtotime($date_end)) ?>";
            _p.prepend('<div class="d-flex mb-3 w-100 align-items-center justify-content-center">'+
            '<img class="mx-4" src="<?php echo validate_image($_settings->info('logo')) ?>" width="50px" height="50px"/>'+
            '<div class="px-2">'+
            '<h3 class="text-center"><?php echo $_settings->info('name') ?></h3>'+
            '<h3 class="text-center">Thống kê vi phạm</h3>'+
            '<h4 class="text-center">'+rdate+'</h4>'+
            '</div>'+
            '</div><hr/>');
            _el.append(_p)
            var nw = window.open("","_blank","width=1200,height=1200")
                nw.document.write(_el.html())
                nw.document.close()
                setTimeout(() => {
                    nw.print()
                    setTimeout(() => {
                        nw.close()
                        end_loader()
                    }, 300);
                }, 500);
        })
	})
	
</script>