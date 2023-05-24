<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php') ?>

<body>
    <?php 
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    $is404 = false;
    if (!file_exists($page . ".php") && !is_dir($page)) {
        $is404 = true;
        include '404.html';
    } else {
        if (is_dir($page))
            include $page . '/index.php';
        else
            include $page . '.php';
    }
    ?>
</body>

<?php 
if (!$is404) {
    require_once('inc/footer.php');
}
?>

</html>