<?php require_once('inc/header.php') ?>
<?php require_once('inc/subnav.php') ?>
<div class="feature mt-125">
    <div class="container">
        <ul class="breadcrumb">
            <li class="item-breadcrumb">
                <a  href="<?php echo base_url ?>?page=home">Trang chủ</a>
                <a style="padding-left: 10px">></a>
            </li>
            <li class="item-breadcrumb">
                <a  href="<?php echo base_url ?>?page=information-lookup">Tra cứu hồ sơ vi phạm</a>
            </li>
        </ul>
        <h1 class="title-component">Tra cứu hồ sơ vi phạm</h1>
        <div class="input-infor">
            <div class="enter-infor">
                <div>
                    <p style="margin: 0;">Số quyết định xử phạt <span style="color: red; margin: 0 !important;">*</span></p>
                    <input class="form-control" style="width: 450px" id="ticket_no" placeholder="Nhập số quyết định">
                    <p style="color: red; margin: 0;">Vui lòng nhập số quyết định xử phạt</p>
                </div>
            </div>
            <button class="btn-submit" data-toggle="modal" data-target=".bd-example-modal-lg" id="submitButton" >Tra cứu</button>
        </div>
        <div style="margin-top: 36px; border-bottom: rgb(160, 160, 160) 2px solid;"></div>
        
        <div style="margin-top: 60px; color: red;">
            <h6>
                Tra cứu, nộp phạt quyết định xử phạt vi phạm hành chính trong lĩnh vực giao thông đường bộ:
            </h6>
            <p>
                1. Thuộc thẩm quyền: Cục Cảnh sát giao thông, các đơn vị trực thuộc Cục Cảnh sát giao thông; Phòng Cảnh sát giao thông và các đơn vị đội/trạm thuộc Phòng Cảnh sát giao thông (theo danh sách Đội/Trạm).
            </p>
            <p>
                2. Thuộc thẩm quyền của thanh tra giao thông đường bộ.
            </p>
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
<?php require_once('inc/footer.php') ?>
<script>
    $(document).ready(function(){
        $ticketNo = $('#ticket_no')
		$('#submitButton').click(async function(e){
            console.log(e)

            const response = await fetch(`violation.php?ticket_no=${$ticketNo.val()}`)

            const html = await response.text();

            $("#modal").html(html);
		})
	})
</script>
