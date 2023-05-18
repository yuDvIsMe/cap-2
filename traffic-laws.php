<?php require_once('inc/header.php') ?>
<?php require_once('inc/subnav.php') ?>
<!-- Contact Start -->
<div class="contact mt-125">
    <div class="container">
        <ul class="breadcrumb">
            <li class="item-breadcrumb">
                <a href="<?php echo base_url ?>">Trang chủ</a>
                <a style="padding-left: 10px">></a>
            </li>
            <li class="item-breadcrumb">
                <a href="<?php echo base_url ?>?page=traffic-laws">Luật giao thông</a>
            </li>
        </ul>
        <h1 class="title-component">Một số vi phạm giao thông đường bộ thường gặp</h1>
        <section class="travel-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="single-travel-boxes">
                            <div id="desc-tabs" class="desc-tabs">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#motorbike" class="vehicle-type" aria-controls="tours" role="tab" data-toggle="tab">
                                            <i class="fa fa-motorcycle"></i>
                                            Xe máy
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#car" class="vehicle-type" aria-controls="hotels" role="tab" data-toggle="tab">
                                            <i class="fa fa-car"></i>
                                            Ô tô
                                        </a>
                                    </li>
                                </ul>

                                <!-- Xe máy -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active fade in" id="motorbike">
                                        <div class="tab-para">
                                            <div class="row">
                                                <div class="fill-form">
                                                    <div class="row">
                                                        <?php
                                                        $moto_qry = $conn->query("SELECT * from `traffic_law` where type = 1");
                                                        while ($moto_row = $moto_qry->fetch_assoc()) :
                                                        ?>
                                                            <a class="col-lg-3" href="#detail-<?php echo $moto_row['id'] ?>" aria-controls="tours" role="tab" data-toggle="tab">
                                                                <div class="info-post">
                                                                    <div class="icon">
                                                                        <img src="img/luatgiaothong/<?php echo $moto_row['image'] ?>" alt="">
                                                                        <h5><?php echo $moto_row['law_name'] ?></h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        <?php endwhile; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    $moto_qry = $conn->query("SELECT * from `traffic_law` where type = 1");
                                    while ($row = $moto_qry->fetch_assoc()) :
                                    ?>
                                        <?php
                                        $qry1 = $conn->query("SELECT * from `violations` where `law_id` = {$row['id']}");
                                        ?>
                                        <div role="tabpanel" class="tab-pane fade in" id="detail-<?php echo $row['id'] ?>">
                                            <div class="tab-para">
                                                <a href="#motorbike" class="come-back" aria-controls="tours" role="tab" data-toggle="tab">
                                                    Quay lại
                                                </a>
                                                <div class="">
                                                    <div class="fill-form">
                                                        <?php
                                                        $violation = $conn->query("SELECT * FROM `violations` where `law_id` = {$row['id']}");
                                                        ?>
                                                        <h4>Có <?php echo $violation->num_rows ?> kết quả được tìm thấy</h4>
                                                        <?php
                                                        while ($law_row = $violation->fetch_assoc()) :
                                                        ?>
                                                            <div class="">
                                                                <a class="col-lg-3" href="#detail-content-car" aria-controls="tours" role="tab" data-toggle="tab">
                                                                    <div class="">
                                                                        <div class="detail-icon">
                                                                            <div class="title-law">
                                                                                <h5 style="color: #000">
                                                                                    <?php echo $law_row['name'] ?>
                                                                                </h5>
                                                                                <p style="color: red; margin: 0">Phạt tiền <?php echo $law_row['fine'] ?> đồng</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        <?php endwhile; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                    
                                    <!-- Noi dung tung luat -->
                                    <div role="tabpanel" class="tab-pane fade in" id="detail-content-motorbike">
                                        <div class="tab-para">
                                            <a href="#detail-motorbike" class="come-back" aria-controls="tours" role="tab" data-toggle="tab">
                                                Quay lại
                                            </a>
                                            <div class="">
                                                <div class="fill-form">
                                                    <div class="">
                                                        <div class="col-lg-12" aria-controls="tours" role="tab" data-toggle="tab">
                                                            <div class="">
                                                                <div class="detail-icon">
                                                                    <div class="title-law">
                                                                        <h5 style="color: #000">
                                                                            Không chấp hành hiệu lệnh, chỉ dẫn của biển bái hiệu, vạch kẻ đường, chỉ dẫn của biển bái hiệu
                                                                        </h5>
                                                                        <p>
                                                                            Người điều khiển xe mô tô, xe gắn máy (kể cả xe máy điện), các loại xe tương tự xe mô tô và các loại xe tương tự xe gắn máy
                                                                        </p>
                                                                        <p href="" style="text-decoration: revert;">Theo Điểm a Khoản 1 Điều 6 NĐ 100</p>
                                                                        <p style="color: red; margin: 0">
                                                                            Phạt tiền từ 100.000 đồng đến 200.000 đồng
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Xe ô tô -->
                                    <div role="tabpanel" class="tab-pane fade in" id="car">
                                        <div class="tab-para">
                                            <div class="row">
                                                <div class="fill-form">
                                                    <div class="row">
                                                        <?php
                                                        $car_qry = $conn->query("SELECT * from `traffic_law` where type = 2");
                                                        while ($car_row = $car_qry->fetch_assoc()) :
                                                        ?>
                                                            <a class="col-lg-3" href="#detail-<?php echo $car_row['id'] ?>" aria-controls="tours" role="tab" data-toggle="tab">
                                                                <div class="info-post">
                                                                    <div class="icon">
                                                                        <img src="img/luatgiaothong/<?php echo $car_row['image'] ?>" alt="">
                                                                        <h5><?php echo $car_row['law_name'] ?></h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        <?php endwhile; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- vong lap $row -->


                                    <!-- Thông tin chi tiết ô tô -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

</div>