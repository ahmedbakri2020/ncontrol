<?php
$date = date('Y-m-d');
$ex = $obj->getNepaliDate($date);
$logged_rep = $obj->getDataByField("u01user","uin",$auth);
?>
<header id="site-header">
    <div class="header-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 date-info">
                    <span><?php echo $obj->convertNepaliUnicode($ex['year']) . " " . $ex['nmonth'] . " " . $obj->convertNepaliUnicode($ex['date']) . " " . $ex['day']; ?></span>
                    <span><?php echo date('jS F, Y', strtotime($date)); ?></span>
                </div>
                <div class="col-sm-6 user-control-wrap">
                    <div class="dropdown">
                        <a href="#" id="user-control" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hi, Administrator
                            <!--<img src="assets/images/img-avatar.jpg" alt="">-->
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu pull-right" aria-labelledby="user-control">                            
                            <li><a href="?page=logout" title="">Logout</a></li>
                            <li><a href="?page=changepassword" title="">Change password</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom" id="second-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <a class="logo-wrap" href="#">
                        <img src="<?php echo IMAGE_URL ?>logo-3.png" alt="">
                    </a>
                </div>
                <div class="col-md-9 col-xs-6">
                    <a href="<?php echo SITE_URL ?>" target="_blank" title="" class="btn btn-default btn-xs btn-visit-website"><i class="fa fa-globe"></i> Visit Website</a>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    
    document.getElementById('second-header').style.background = '#9C090D none repeat scroll 0 0';
</script>
<section>
    <div class="container-fluid">
        <div class="row">
            <?php require_once('inc/sidebar.php'); ?>
           