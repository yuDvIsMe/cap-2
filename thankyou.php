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
                            <div style="display: flex;">
                                <a href="<?php echo base_url ?>">Trở về trang chủ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</section>