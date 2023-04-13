<div class="navbar navbar-expand-lg bg-dark navbar-dark nav-sticky nav-sticky" style="height: 78px;">
    <div class="container-fluid">
        <a href="<?php echo base_url ?>" class="navbar-brand">TVMS</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        
    </div>
    <a class="btn-login" href="<?php echo base_url . 'admin' ?>">
        Đăng nhập
    </a>
    <a class="btn-login" href="<?php echo base_url ?>?page=sign-up">
        Đăng ký
    </a>
</div>


<div class="carousel">

    <div class="carousel-item">
        <div class="carousel-img">
            <img src="img/trangchu.png" alt="Image">
        </div>
        <div class="carousel-text">
            <h1>Chào mừng TVMS</h1>
            <p>
                Giới thiệu
            </p>
        </div>
    </div>
</div>
<!-- Carousel End -->

<!-- Video Modal Start-->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- 16:9 aspect ratio -->
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Video Modal End -->


<!-- Fact Start -->
<div class="fact">
    <div class="container">
        <div class="row align-items-center">
            <a class="col-lg-3 col-md-6 " style="cursor: pointer;" href="<?php echo base_url ?>?page=about">
                <div class="fact-item">
                    <img src="img/icon-4.png" alt="Icon">
                    <h2>Giới thiệu</h2>
                </div>
            </a>
            <a class="col-lg-3 col-md-6" style="cursor: pointer;" href="<?php echo base_url ?>?page=news">
                <div class="fact-item">
                    <img src="img/icon-1.png" alt="Icon">
                    <h2>Tin tức</h2>
                </div>
            </a>
            <a class="col-lg-3 col-md-6" style="cursor: pointer;" href="<?php echo base_url ?>?page=information-lookup">
                <div class="fact-item">
                    <img src="img/icon-8.png" alt="Icon">
                    <h2>Tra cứu thông tin</h2>
                </div>
            </a>
            <a class="col-lg-3 col-md-6" style="cursor: pointer;" href="<?php echo base_url ?>?page=contact">
                <div class="fact-item">
                    <img src="img/icon-6.png" alt="Icon">
                    <h2>Liên hệ</h2>
                </div>
            </a>
        </div>
    </div>
</div>