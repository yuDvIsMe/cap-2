<h1><?php echo "Thống kê hệ thống" ?></h1>
<hr class="bg-light">
<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-light elevation-1"><i class="fas fa-calendar-day"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Số vi phạm hôm nay</span>
        <span class="info-box-number text-right">
          <?php
          $violation = $conn->query("SELECT * FROM `violation_list` where date(date_created) = '" . date('Y-m-d') . "' ")->num_rows;
          echo number_format($violation);
          ?>
          <?php ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-light elevation-1"><i class="fas fa-money-bill"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Số biên bản được thanh toán hôm nay</span>
        <span class="info-box-number text-right">
          <?php
          $violation = $conn->query("SELECT * FROM `vnpay_payment` where date(date_created) = '" . date('Y-m-d') . "' ")->num_rows;
          echo number_format($violation);
          ?>
          <?php ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-lightblue elevation-1"><i class="fas fa-id-card"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Thông tin người vi phạm</span>
        <span class="info-box-number text-right">
          <?php
          $drivers = $conn->query("SELECT id FROM `drivers_list` ")->num_rows;
          echo number_format($drivers);
          ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-lightblue elevation-1"><i class="fas fa-book"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Tổng số biên bản vi phạm</span>
        <span class="info-box-number text-right">
          <?php
          $records = $conn->query("SELECT id FROM `violation_list` ")->num_rows;
          echo number_format($records);
          ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-green elevation-1"><i class="fas fa-check"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Số biên bản vi phạm đã thanh toán</span>
        <span class="info-box-number text-right">
          <?php
          $records = $conn->query("SELECT id FROM `violation_list` where `status`=1")->num_rows;
          echo number_format($records);
          ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-red elevation-1"><i class="fas fa-window-close"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Số biên bản vi phạm chưa thanh toán</span>
        <span class="info-box-number text-right">
          <?php
          $records = $conn->query("SELECT id FROM `violation_list` where `status`= 0")->num_rows;
          echo number_format($records);
          ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-lightblue elevation-1"><i class="fas fa-newspaper"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Tổng số bài viết</span>
        <span class="info-box-number text-right">
          <?php
          $news = $conn->query("SELECT id FROM `news_list` ")->num_rows;
          echo number_format($news);
          ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <!-- fix for small devices only -->
  <div class="clearfix hidden-md-up"></div>

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-lightblue elevation-1"><i class="fas fa-traffic-light"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Tổng số lỗi vi phạm</span>
        <span class="info-box-number text-right">
          <?php
          $to = $conn->query("SELECT id FROM `violations` where status = 1 ")->num_rows;
          echo number_format($to);
          ?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>