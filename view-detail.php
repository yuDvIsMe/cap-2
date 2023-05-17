<?php
require_once('./inc/header.php');
require_once('./config.php');
if (isset($_GET['ticket_no'])) {
    $qry = $conn->query("SELECT r.*,d.license_id_no, d.name as driver from `violation_list` r inner join `drivers_list` d on r.driver_id = d.id where r.ticket_no = '{$_GET['ticket_no']}' ");
    if ($conn->error) {
        echo $conn->error . "\n";
        echo "SELECT r.*,d.license_id_no, d.name as driver from `violation_list` r inner join `drivers_list` on r.driver_id = d.id where r.ticket_no = '{$_GET['ticket_no']}' ";
    }
    $qry2 = $conn->query("SELECT i.*,o.code,o.name from `violation_items` i inner join `violations` o on i.violation_id = o.id inner join `violation_list` vl on i.driver_violation_id = vl.id where vl.ticket_no = '{$_GET['ticket_no']}' ");
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
    $qry3 = $conn->query("SELECT v.*,p.* from `violation_list` v join `vnpay_payment` p on v.ticket_no = p.ticket_no where v.ticket_no = '{$_GET['ticket_no']}' ");
    if ($qry3->num_rows > 0) {
        foreach ($qry3->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}

?>
<div class="container-fluid">
    <h2 class="text-center">Biên bản xử phạt vi phạm hành chính</h2>
    <div class="border border-dark px-2 py-2" style="overflow: hidden;" id="print_out">

        <style>
            img#cimg {
                height: 100%;
                width: 100%;
                object-fit: scale-down;
                object-position: center center;
            }

            p,
            label {
                margin-bottom: 5px;
            }

            #uni_modal .modal-footer {
                display: none !important;
            }
        </style>

        <table class="table boder-0">
            <tr class='boder-0'>
                <td width="80%" class='boder-0 align-bottom'>
                    <div class="row">
                        <div class="col-12">
                            <div class="row justify-content-between  w-max-100">
                                <div class="col-6 d-flex w-max-100">
                                    <label class="float-left w-auto whitespace-nowrap">Số QĐXP: </label>
                                    <p class="col-md-auto"><b><?php echo $ticket_no ?></b></p>
                                </div>
                                <div class="col-6 d-flex w-max-100">
                                    <label class="float-left w-auto whitespace-nowrap">Thời gian: </label>
                                    <p class="col-md-auto"><b><?php echo date("M d, Y h:i A", strtotime($date_created)) ?></b></p>
                                </div>
                            </div>
                            <div class="d-flex w-max-100">
                                <label class="float-left w-auto whitespace-nowrap">Số giấy phép lái xe:</label>
                                <p class="col-md-auto"><b><?php echo $license_id_no ?></b></p>
                            </div>
                            <div class="d-flex w-max-100">
                                <label class="float-left w-auto whitespace-nowrap">Người điều khiển:</label>
                                <p class="col-md-auto"><b><?php echo $driver ?></b></p>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan='2'>
                    <div class="d-flex w-max-100">
                        <label class="float-left w-auto whitespace-nowrap">ID người lập:</label>
                        <p class="col-md-auto"><b><?php echo $officer_id ?></b></p>
                    </div>
                    <div class="d-flex w-max-100">
                        <label class="float-left w-auto whitespace-nowrap">Tên người lập:</label>
                        <p class="col-md-auto"><b><?php echo $officer_name ?></b></p>
                    </div>
                    <hr>
                    <div class="d-flex w-max-100">
                        <label class="float-left w-auto whitespace-nowrap">Trạng thái:</label>
                        <p class="col-md-auto"><b><?php echo ($status == 1) ? "Đã thanh toán" : "Chưa thanh toán" ?></b></p>
                    </div>
                    <div class="d-flex w-max-100">
                        <label class="float-left w-auto whitespace-nowrap">Số biên lai:</label>
                        <p class="col-md-auto"><b><?php echo $vnp_BankTranNo ?></b></p>
                    </div>
                    <div class="d-flex w-max-100">
                        <label class="float-left w-auto whitespace-nowrap">Thời gian thanh toán:</label>
                        <p class="col-md-auto"><b><?php echo date("M d, Y h:i A", strtotime($date_pay)) ?></b></p>
                    </div>
                </td>
            </tr>
        </table>
        <hr class='bg-dark border-dark'>
        <h4 class="text-center"><b>Danh sách vi phạm</b></h4>
        <table class='table table-stripped px-4'>
            <thead>
                <tr>
                    <th>Mã vi phạm</th>
                    <th>Tên vi phạm</th>
                    <th class="text-right">Tiền phạt</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($violation_arr as $row) :
                ?>
                    <tr>
                        <th><?php echo $row['code'] ?></th>
                        <th><?php echo $row['name'] ?></th>
                        <th class='text-right'><?php echo number_format($row['fine']) ?></th>
                    </tr>
                <?php endforeach; ?>
                <?php if (count($violation_arr) <= 0) : ?>
                    <tr>
                        <th class="text-center" colspan="3">Không tìm thấy vi phạm</th>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class='text-center' colspan="2">Tổng cộng</th>
                    <th class="text-right"><?php echo number_format($total_amount) ?></th>
                </tr>
            </tfoot>
        </table>
        <hr class="bg-dark border-dark">
        <div class="card-body">
            <div class="container-fluid">
                <table class="table table-hover table-stripped">
                    <colgroup>
                        <col width="40%">
                        <col width="60%">
                    </colgroup>
                    <thead>
                        <tr class="text-center">
                            <th>NGƯỜI NỘP TIỀN</th>
                            <th class="text-danger">CÔNG TY CP DV DI ĐỘNG TRỰC TUYẾN VNPAY</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <th class="text-danger"></br><em>&lt;Nộp tiền điện tử&gt;</em></th>
                            <th class="text-danger">Ký bởi: <small>CÔNG TY CP DV DI ĐỘNG TRỰC TUYẾN VNPAY</small></br><em>&lt;Ký ngày: <?php echo date("M d, Y", strtotime($date_pay)) ?> &gt;</em></p></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="w-100 d-flex justify-content-end mb-2 mt-2">
        <button class="btn btn-info" type="button" id="print" style="margin-right: 8px;"><i class="fa fa-print"></i> In biên bản</button>
        <button class="btn btn-danger" data-dismiss="modal" style="font-size: 0.9rem;"><i class="fa fa-times"></i> Đóng</button>
    </div>
</div>

<script>
    $(function(){
        $('#print').click(function(){
            start_loader()
            var _h = $('head').clone()
            var _p = $('#print_out').clone();
            var _el = $('<div>')
            _p.prepend('<div class="d-flex mb-3 w-100 align-items-center justify-content-center">'+
            '<div class="px-2">'+
            '<h5 class="text-center"><?php echo $_settings->info('name') ?></h5>'+
            '<h5 class="text-center">Biên bản vi phạm giao thông</h5>'+
            '</div>');
            _el.append(_h)
            _el.append('<style>html, body, .wrapper {min-height: unset !important;}#print_out{width:100% !important;}</style>')
            _el.append(_p)
            var nw = window.open("","_blank","width=1500,height=1500")
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