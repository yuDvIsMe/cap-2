<div class="d-none d-md-block">
    <div class="container-fluid">
        <div class="row" style = "display: flex; align-items: center;">
            <div class="col-md-8">
                <div class="top-bar-left">
                    <div class="text">
                        <h1 href="<?php echo base_url ?>" class="home-title">TVMS</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="top-bar-right">
                    <div class="social-login">
                        <a class="btn-login" href="<?php echo base_url . 'admin' ?>">
                            Đăng nhập
                        </a>
                        <a class="btn-login" href="<?php echo base_url ?>?page=sign-up">
                            Đăng ký
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse" style="display: flex!important;justify-content: center;">
            <div class="navbar-nav align-items-center">
                <a href="<?php echo base_url ?>" class="nav-item nav-link item-subnav" style="font-size: 28px;"><i class="fas fa-home"></i></a>
                <a href="<?php echo base_url ?>?page=about" class="nav-item nav-link item-subnav">Giới thiệu</a>
                <a href="<?php echo base_url ?>?page=news" class="nav-item nav-link item-subnav">Tin tức</a>
                <a href="<?php echo base_url ?>?page=information-lookup" class="nav-item nav-link item-subnav">Tra cứu thông tin</a>
                <a href="<?php echo base_url ?>?page=contact" class="nav-item nav-link item-subnav">Liên hệ</a>
            </div>
        </div>
    </div>
</div>