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

                                <div class="tab-content">
                                    <!-- Xe máy -->
                                    <div role="tabpanel" class="tab-pane active fade in" id="motorbike">
                                        <div class="tab-para">
                                            <div class="row">
                                                <div class="fill-form">
                                                    <div class="row">
                                                        <?php
                                                        $moto_qry = $conn->query("SELECT * from `traffic_law` where type = 1");
                                                        while ($moto_row = $moto_qry->fetch_assoc()) :
                                                        ?>
                                                            <a class="col-lg-3" href="#moto-detail-<?php echo $moto_row['id'] ?>" aria-controls="tours" role="tab" data-toggle="tab">
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
                                        $moto_vio = $conn->query("SELECT * from `violations` where `law_id` = {$row['id']}");
                                        ?>
                                        <div role="tabpanel" class="tab-pane fade in" id="moto-detail-<?php echo $row['id'] ?>">
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
                                                                <a class="col-lg-3" href="#content-motorbike-<?php echo $law_row['id'] ?>" aria-controls="tours" role="tab" data-toggle="tab">
                                                                    <div class="">
                                                                        <div class="detail-icon">
                                                                            <div class="title-law">
                                                                                <h5 style="color: #000">
                                                                                    <?php echo $law_row['name'] ?>
                                                                                </h5>
                                                                                <p style="color: red; margin: 0">Phạt tiền từ <?php echo number_format($law_row['min_fine']) ?> đến <?php echo number_format($law_row['max_fine']) ?> đồng</p>
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

                                        <?php
                                        $violation_detail = $conn->query("SELECT * FROM `violations` where `law_id` = {$row['id']}");
                                        while ($law_detail = $violation_detail->fetch_assoc()) :
                                        ?>
                                            <!-- Noi dung tung luat -->
                                            <div role="tabpanel" class="tab-pane fade in" id="content-motorbike-<?php echo $law_detail['id'] ?>">
                                                <div class="tab-para">
                                                    <a href="#moto-detail-<?php echo $row['id'] ?>" class="come-back" aria-controls="tours" role="tab" data-toggle="tab">
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
                                                                                    <?php echo $law_detail['name'] ?>
                                                                                </h5>
                                                                                <div>
                                                                                    <?php echo $law_detail['description']; ?>
                                                                                </div>
                                                                                <p style="color: red; margin: 0">Phạt tiền từ <?php echo number_format($law_detail['min_fine']) ?> đến <?php echo number_format($law_detail['max_fine']) ?> đồng</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endwhile; ?>
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
                                                            <a class="col-lg-3" href="#car-detail-<?php echo $car_row['id'] ?>" aria-controls="tours" role="tab" data-toggle="tab">
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
                                    <?php
                                    $car_qry = $conn->query("SELECT * from `traffic_law` where type = 2");
                                    while ($rows = $car_qry->fetch_assoc()) :
                                    ?>
                                        <?php
                                        $car_vio = $conn->query("SELECT * from `violations` where `law_id` = {$rows['id']}");
                                        ?>
                                        <div role="tabpanel" class="tab-pane fade in" id="car-detail-<?php echo $rows['id'] ?>">
                                            <div class="tab-para">
                                                <a href="#car" class="come-back" aria-controls="tours" role="tab" data-toggle="tab">
                                                    Quay lại
                                                </a>
                                                <div class="">
                                                    <div class="fill-form">
                                                        <?php
                                                        $violations = $conn->query("SELECT * FROM `violations` where `law_id` = {$rows['id']}");
                                                        ?>
                                                        <h4>Có <?php echo $violations->num_rows ?> kết quả được tìm thấy</h4>
                                                        <?php
                                                        while ($law_rows = $violations->fetch_assoc()) :
                                                        ?>
                                                            <div class="">
                                                                <a class="col-lg-3" href="#content-car-<?php echo $law_rows['id'] ?>" aria-controls="tours" role="tab" data-toggle="tab">
                                                                    <div class="">
                                                                        <div class="detail-icon">
                                                                            <div class="title-law">
                                                                                <h5 style="color: #000">
                                                                                    <?php echo $law_rows['name'] ?>
                                                                                </h5>
                                                                                <p style="color: red; margin: 0">Phạt tiền từ <?php echo number_format($law_rows['min_fine']) ?> đến <?php echo number_format($law_rows['max_fine']) ?> đồng</p>
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
                                        <?php
                                        $violation_details = $conn->query("SELECT * FROM `violations` where `law_id` = {$rows['id']}");
                                        while ($law_details = $violation_details->fetch_assoc()) :
                                        ?>
                                            <!-- Noi dung tung luat -->
                                            <div role="tabpanel" class="tab-pane fade in" id="content-car-<?php echo $law_details['id'] ?>">
                                                <div class="tab-para">
                                                    <a href="#car-detail-<?php echo $rows['id'] ?>" class="come-back" aria-controls="tours" role="tab" data-toggle="tab">
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
                                                                                    <?php echo $law_details['name'] ?>
                                                                                </h5>
                                                                                <div>
                                                                                    <?php echo $law_details['description']; ?>
                                                                                </div>
                                                                                <p style="color: red; margin: 0">Phạt tiền từ <?php echo number_format($law_details['min_fine']) ?> đến <?php echo number_format($law_details['max_fine']) ?> đồng</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

</div>