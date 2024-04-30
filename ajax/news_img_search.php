<?php
include '../../system/application_top.php';
$i=1;
$searchid = $obj->StringInputCleaner($_POST['search']);
$res_sql = $obj->db->query("select DISTINCT(n01image),posted_on  from " . NEWS . " GROUP BY n01image HAVING n01image like '$searchid%' and n01image<>'' order by uin desc");
?>
<ul class="row" id="search-list">
    <?php
    if($res_sql->rowCount()>0){
    while ($row_img_news = $res_sql->fetch()):
            $title = substr($row_img_news['n01image'], 0, -4);
     $final_title= preg_replace('/[0-9]+/', '', $title);
      echo '<li class="col-md-3 mediaItem">
            <label>
                <input type="radio" name="mediaSelect" value="'.$row_img_news['n01image'].'" />
        <img src="'.NEWS_IMAGE.'large/'.$row_img_news['n01image'].'" id="img1"  onclick="getName(\''.$row_img_news['n01image'].'\')">
<p>'.$final_title.'_'.$row_img_news['posted_on'].'</p>
            </label>
        </li>';
if($i%4==0) echo '<li class="clearfix"></li>';
$i++;
    endwhile; }else{
        echo '<div class="alert alert-danger margin-top"><strong>Not Found!</strong></div>';

    } ?>
</ul>

