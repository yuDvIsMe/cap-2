<?php require_once('inc/header.php') ?>
<?php require_once('inc/subnav.php') ?>
<!-- Feature Start -->
<div class="feature mt-125">
    <div class="container">
        <ul class="breadcrumb">
            <li class="item-breadcrumb">
                <a href="<?php echo base_url ?>?page=home">Trang chủ</a>
                <a style="padding-left: 10px">></a>
            </li>
            <li class="item-breadcrumb">
                <a href="<?php echo base_url ?>?page=news">Tin tức</a>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-6">
                <?php
                $qry = $conn->query("SELECT * from `news_list` order by unix_timestamp(post_date) desc limit 1 ");
                while ($row = $qry->fetch_assoc()) :
                ?>
                    <img src="<?php echo $row['image'] ?>" alt="" style="width: 100%; height: 100%;">
                    <a href="#" style="font-size: 24px; color: #000;">
                        <?php echo $row['title'] ?>
                    </a>
                <?php endwhile; ?>
            </div>
            <div class="col-md-6" style="display: flex; height: 100%; flex-direction: column;">
                <?php
                $qry = $conn->query("SELECT * from `news_list` order by unix_timestamp(post_date) desc ");
                while ($row = $qry->fetch_assoc()) :
                ?>
                    <a href="#" style="padding-bottom: 15px"><i class="fab fa-telegram-plane"></i> <?php echo $row['title'] ?>
                    </a>
                <?php endwhile; ?>
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
                            <a href="<?php echo base_url ?>?page=news-detail" class="news-content">
                                <?php echo $row['title'] ?>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('inc/footer.php') ?>