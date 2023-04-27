<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php') ?>

<body>
    <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';  ?>
    <?php
    if (!file_exists($page . ".php") && !is_dir($page)) {
        include '404.html';
    } else {
        if (is_dir($page))
            include $page . '/index.php';
        else
            include $page . '.php';
    }
    ?>
</body>
<footer>
    <?php require_once('inc/footer.php') ?>
</footer>

</html>