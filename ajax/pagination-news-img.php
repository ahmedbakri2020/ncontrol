<?php

if (file_exists('../../system/application_top.php')) {
    include '../../system/application_top.php';
}
//ini_set('display_errors', 1);
 // ini_set('display_startup_errors', 1);
 // error_reporting(E_ALL);


$page = (int)$_POST['page'];
$perPage = (int)$_POST['perPage'];
if ($page == 1) {
    $start = 0;
} else {
    $start = ($page - 1) * $perPage;
}

$i=1;
//echo "select  DISTINCT(nw01image) from nw01tbl_news limit $start,$perPage  "; die();
$query = $obj->db->query("select DISTINCT(n01image) from n01news where n01image order by uin desc limit $start,$perPage");
 
$count = $obj->countRow($obj->select(NEWS, "DISTINCT(n01image)"));
$numPage = ceil($count / $perPage);
$newslist = '';
if($query->rowCount()>0){
while ($row_img_news = $query->fetch()):
 

    $title = substr($row_img_news['n01image'], 0, -4);
    $img= preg_replace("/[^a-zA-Z]+/", "", $title);
   // $final_title = substr($title, 0, strrpos($title, '-'));
    $newslist .='<li class="col-md-3 mediaItem">
    <label>
        <input type="radio" name="mediaSelect" value="'.$row_img_news['n01image'].'" />
        <img src="'.NEWS_IMAGE.'large/'.$row_img_news['n01image'].'" id="img1"  onclick="getName(\''.$row_img_news['n01image'].'\')">
        <p>'.$img.'</p>
    </label>
</li>'.(($i%4==0)?'<li class="clearfix"></li>':'').'';

$i++; endwhile;
}else{
    echo '<strong>Image Not Found!!</strong>';
}
$json_arr = array("newsList" => $newslist, "numPage" => $numPage);
echo json_encode($json_arr);
