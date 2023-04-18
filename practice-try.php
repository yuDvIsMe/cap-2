<?php require_once('inc/header.php') ?>
<?php require_once('inc/subnav.php') ?>
<!-- Contact Start -->
<div class="contact mt-125">
    <div class="container">
        <ul class="breadcrumb">
            <li class="item-breadcrumb">
                <a  href="<?php echo base_url ?>">Trang chủ</a>
                <a style="padding-left: 10px">></a>
            </li>
            <li class="item-breadcrumb">
                <a  href="<?php echo base_url ?>?page=practice-try">Thi thử</a>
            </li>
        </ul>
        <h1 class="title-component">Thi thử về giao thông đường bộ</h1>
        <div class="row">
            <div class="col-md-6" style="border-right: rgb(160, 160, 160) 2px solid;">
                <div class="section-header">
                    <h4>Bạn cần hỗ trợ gì ?</h4>
                    <p>Yêu cầu của bạn sẽ được xử lý và phản hồi trong thời gian sớm nhất.</p>
                </div>
                <div class="contact-form">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate">
                        <div class="control-group">
                            <div>
                                Họ tên <span style="color: red">*</span>
                            </div>
                            <input type="text" class="form-control" id="name" required="required" data-validation-required-message="Vui lòng nhập họ tên" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <div>
                                Email <span style="color: red">*</span>
                            </div>
                            <input type="email" class="form-control" id="email" required="required" data-validation-required-message="Vui lòng nhập email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <div>
                                Nội dung <span style="color: red">*</span>
                            </div>
                            <textarea class="form-control" id="message" required="required" data-validation-required-message="Vui lòng nhập nội dung"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn-send-contact" type="submit" id="sendMessageButton">Gửi</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-md-6">
                <div class="section-header">
                    <h4>Liên hệ với chúng tôi</h4>
                    <p>
                        Đường dây nóng và thời gian làm việc của chúng tôi
                    </p>
                </div>
                <div class="contact-info" style="padding: 12px">
                    <div class="contact-icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="contact-text">
                        <h3>Email: </h3>
                        <p>support@csgt.vn</p>
                    </div>
                </div>
                <div class="contact-info" style="padding: 12px">
                    <div class="contact-icon">
                        <i class="fa fa-phone-alt"></i>
                    </div>
                    <div class="contact-text">
                        <h3>Hotline: </h3>
                        <p>069 2342593</p>
                    </div>
                </div>
                <div class="contact-info" style="padding: 12px">
                    <div class="contact-icon">
                        <i class="fa fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-text">
                        <h3>Fax:</h3>
                        <p>84 24 38220885</p>
                    </div>
                </div>
                <div class="contact-info" style="padding: 12px">
                    <div class="contact-icon">
                        <i class="fa fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-text">
                        <h3>Thời gian làm việc:</h3>
                        <p>8h - 21h (Thứ 2 - Thứ 7)</p>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
<!-- Contact End -->
<?php require_once('inc/footer.php') ?>