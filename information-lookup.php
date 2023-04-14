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
                <a  href="<?php echo base_url ?>?page=information-lookup">Tra cứu thông tin</a>
            </li>
        </ul>
        <h1>Tra cứu hồ sơ vi phạm</h1>
        <div class="input-infor">
            <div class="enter-infor">
                <div>
                    Số quyết định <span style="color: red">*</span>
                </div>

                <div>
                    <input class="form-control" style="width: 500px" placeholder="Nhập số quyết định">
                    <p id="" style="color: red; margin: 0;">Vui lòng nhập số quyết định</p>
                </div>
            </div>

            <div class="center">
                <div class="enter-infor">
                    <div >
                        Mã bảo mật <span style="color: red">*</span>
                    </div>

                    <div style="display: flex">
                        <div>
                            <input class="form-control" type="text" id="submit" style="width: 260px" placeholder="Mã bảo mật"/>
                            <p id="key" style="margin: 0;">Vui lòng nhập mã bảo mật</p>
                        </div>

                        <div class="code">
                            <div class="imagess" id="image" selectable="False"></div>
                            <div class="inline"  onclick="generate()" >
                                <i class="fas fa-sync"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn-submit" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="printmsg()" >Tra cứu</button>
        </div>
        <div style="margin-top: 84px; color: red;">
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
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Biên bản vi phạm</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="display: flex; justify-content: space-between;">
                <div class="col-md-8" style="display: flex">
                    <a style="color: #000; margin-right: 10px">Số quyết định: </a>
                    <p>G012312874123-5243312</p>
                </div>
                <div class="col-md-4" style="display: flex">
                    <a style="color: #000; margin-right: 10px">Ngày quyết định: </a>
                    <p>16/02/2023</p>
                </div>
            </div>

            <div class="modal-body"style="display: flex; justify-content: space-between;">
                
                <div class="col-md-8" style="display: flex">
                    <a style="color: #000; margin-right: 10px; width: 244px;">Hành vi vi phạm: </a>
                    <p>Điều khiển xe mô tô 2 bánh mang biển số: 92F1-19312 chuyển hướng không tín hiệu đèn giao thông</p>
                </div>
                <div class="col-md-4" style="display: flex">
                    <a style="color: #000; margin-right: 10px">Số tiền phạt: </a>
                    <p>500.000 VND</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary">Thanh toán</button>
            </div>
        </div>
    </div>
</div>
<?php require_once('inc/footer.php') ?>
