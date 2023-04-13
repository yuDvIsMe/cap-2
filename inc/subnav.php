<div class="navbar navbar-expand-lg bg-dark navbar-dark nav-sticky">
    <div class="container-fluid">
        <a href="<?php echo base_url ?>" class="navbar-brand">TVMS</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ml-auto align-items-center">
                <a href="<?php echo base_url ?>" class="nav-item nav-link" style="font-size: 24px;"><i class="fas fa-home"></i></a>
                <a href="<?php echo base_url ?>?page=about" class="nav-item nav-link">Giới thiệu</a>
                <a href="<?php echo base_url ?>?page=news" class="nav-item nav-link">Tin tức</a>
                <a href="<?php echo base_url ?>?page=information-lookup" class="nav-item nav-link">Tra cứu thông tin</a>
                <a href="<?php echo base_url ?>?page=contact" class="nav-item nav-link">Liên hệ</a>
                
            </div>
        </div>
    </div>
    <a class="btn-login" href="<?php echo base_url ?>?page=log-in">
        Đăng nhập
    </a>
    <a class="btn-login" href="<?php echo base_url ?>?page=sign-up">
        Đăng ký
    </a>
</div>