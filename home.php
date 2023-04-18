
<div>
    <div class="d-none d-md-block">
        <div class="container-fluid">
            <div class="row" style="display: flex; align-items: center;">
                <div class="col-md-8">
                    <div class="top-bar-left">
                        <div class="text">
                            <a href="<?php echo base_url ?>" class="home-title">
                                <h1>TVMS</h1>
                            </a>
                            <a href="<?php echo base_url ?>" class="home-title">
                                <h2>Cổng dịch vụ công thành phố</h2>
                            </a>
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
    
    <div class="single">
        <div style="margin-top: 40px;">
            <div class="display-flex">
                <div class="fact single-item-home" data-aos="fade-up" data-aos-duration="2000">
                    <div class="container">
                        <div class="display-flex">
                            <a class="col-lg-3" style="cursor: pointer;" href="<?php echo base_url ?>?page=about">
                                <div class="fact-item">
                                    <i class="fas fa-user icon-home"></i>
                                    <h2>Giới thiệu</h2>
                                </div>
                            </a>
                            <a class="col-lg-3" style="cursor: pointer;" href="<?php echo base_url ?>?page=news">
                                <div class="fact-item">
                                    <i class="fas fa-newspaper icon-home"></i>
                                    <h2>Tin tức</h2>
                                </div>
                            </a>
                            <a class="col-lg-3" style="cursor: pointer;" href="<?php echo base_url ?>?page=information-lookup">
                                <div class="fact-item">
                                    <i class="fas fa-credit-card icon-home"></i>
                                    <h2>Tra cứu thông tin</h2>
                                </div>
                            </a>
                            <a class="col-lg-3" style="cursor: pointer;" href="<?php echo base_url ?>?page=contact">
                                <div class="fact-item">
                                    <i class="fas fa-address-card icon-home"></i>
                                    <h2>Liên hệ</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <img class="img-home" src="img/trangchu.png" alt="Image">
        </div>
    </div>
    <div class="testimonial">
        <div class="container">
            <div class="section-header">
            </div>
            <div class="owl-carousel testimonials-carousel">
                <?php
                $qry = $conn->query("SELECT * from `news_list` order by unix_timestamp(post_date) desc ");
                while ($row = $qry->fetch_assoc()) :
                ?>
                    <div class="testimonial-item-news">
                        <img class="img-testimonial-item-news" src="<?php echo $row['image'] ?>" alt="Image">
                        <a href="<?php echo base_url ?>?page=news-detail&id=<?php echo $row['id']?>">
                            <?php echo $row['title'] ?>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>