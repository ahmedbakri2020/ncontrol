<?php
require_once('inc/headSec.php');
if ($obj->getREQUEST('page') || $obj->getREQUEST('fol')) {
    $pagename = Page_finder::pagefinder($_GET['page'], $_GET['fol']);
} else {
    $pagename = 'pages/news.php';
}
//$usr->createUser("sweety", "sweety@itech1234", "sweety@itechnepal.net");
?>

<body>
    <?php require_once('inc/header.php'); ?>
    <div class="col-md-10 content-wrapper expanded">
        <?php
        echo Page_finder::get_message();
        include $pagename;
        require_once('inc/footer.php');
        ?>
    </div>
</body>
</html>