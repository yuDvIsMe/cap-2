<?php require_once('inc/header.php') ?>
<?php require_once('inc/subnav.php') ?>
<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `news_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="single mt-125">
    <div class="container">
        <ul class="breadcrumb">
            <li class="item-breadcrumb">
                <a href="<?php echo base_url ?>?page=home">Trang chủ</a>
                <a style="padding-left: 10px">></a>
            </li>
            <li class="item-breadcrumb">
                <a href="<?php echo base_url ?>?page=news">Tin tức</a>
                <a style="padding-left: 10px"></a>
            </li>
        </ul>
        <div class="title-component">
            <h1><?php echo $title?></h1>
            <p><?php echo $post_date?></p>
        </div>
            <div class="row">
                <div class="col-12">
                    <h4>
                        Trong thời gian gần đây, lực lượng CSGT toàn quốc liên tiếp phát hiện ô tô sử dụng tem kiểm định, Giấy đăng kiểm giả lưu thông trên đường. Đây là hành vi rất nguy hiểm, tiềm ẩn nguy cơ tai nạn giao thông và vi phạm pháp luật.
                    </h4>
                    <!-- <div style="text-align: center">
                        <img class="img-news" style="width: 75%;" src="img/news-1.png" alt="Image">
                    </div> -->
                    <div>
                    <?php echo $content?>
                    </div>
                </div>
            </div>
    </div>

    <?php require_once('inc/footer.php') ?>