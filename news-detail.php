<?php require_once('inc/subnav.php') ?>

<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `news_list` n join `users` u on n.user_id = u.id where n.id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
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
        <div>
            <h1><?php echo $title ?></h1>
            <hr />
            <p>Ngày đăng: <?php echo $post_date ?></p>
        </div>
        <div class="row">
            <div class="col-12">
                <h4>
                    <?php echo $sub_title ?>
                    <hr />
                </h4>
                <!-- <div style="text-align: center">
                        <img class="img-news" style="width: 75%;" src="img/news-1.png" alt="Image">
                    </div> -->
                <div>
                    <?php echo $content ?>
                </div>
                <div class="mt-4" style="float:right;color:#000" >
                    <em>Tác giả: <b><?php echo $lastname ?></b> </em>
                </div>
            </div>
        </div>
    </div>