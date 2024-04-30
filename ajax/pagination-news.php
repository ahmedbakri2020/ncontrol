<?php

include '../../system/application_top.php';


$page = (int) $_POST['page'];
$perPage = (int) $_POST['perPage'];
if ($page == 1) {
    $start = 0;
} else {
    $start = ($page - 1) * $perPage;
}

$common_field = "n01title,uin,n01type,author,n01draft,scheduled,highlight,headline,featured,flash,view,user_id,posted_on";

if (isset($_POST['category'])) {
    $cat = (int) $_POST['category'];
     if($cat==10) {
    $query = $obj->select(NEWS, "*", array("n01type" => $cat), array("mytime" => "desc"), array($start, $perPage));
     }else{
     $query =$obj->db->query("select * from n01news where n01type=$cat   order  by mytime desc limit $start,$perPage");
     }
    $count = $obj->countRow($obj->select(NEWS, "uin", array("n01type" => $cat)));
    
} elseif (isset($_POST['draft'])) {
    $query = $obj->exec("select * from  " . NEWS . " where  posted_on > DATE_SUB(NOW(), INTERVAL 1 WEEK) and viewed!= 0 order by viewed desc limit " . $start . ", " . $perPage . " ");
    $count = $obj->count($obj->exec("select uin from  ".NEWS." where  posted_on > DATE_SUB(NOW(), INTERVAL 1 WEEK) and viewed!= 0"));
} elseif (isset($_POST['author'])) {
    $user= (int) $_POST['author'];
    //$query = $obj->select(NEWS, "*", array("user_id" => $user), array("mytime" => "desc"), array($start, $perPage));
      $query =$obj->db->query("select ".$common_field." from n01news where user_id=$user    order  by mytime desc limit $start,$perPage");
    $count = $obj->countRow($obj->select(NEWS, "uin", array("user_id" => $user)));

}
elseif (isset($_POST['flash'])) {
    $flash = (int) $_POST['flash'];
    $query = $obj->select(NEWS, $common_field, array("flash" => 1), array("news_order" => "asc", "mytime" => "desc"), array($start, $perPage));
    $count = $obj->countRow($obj->select(NEWS, "uin", array("flash" => 1)));
}elseif (isset($_POST['sub_flash'])) {
    $sub_flash = (int) $_POST['sub_flash'];
    $query = $obj->select(NEWS, $common_field, array("highlight" => 1), array("news_order" => "asc", "mytime" => "desc"), array($start, $perPage));
    $count = $obj->countRow($obj->select(NEWS, "uin", array("highlight" => 1)));
}elseif (isset($_POST['front_page'])) {
    $sub_flash = (int) $_POST['front_page'];
    $query = $obj->select(NEWS, $common_field, array("headline" => 1), array("news_order" => "asc", "mytime" => "desc"), array($start, $perPage));
    $count = $obj->countRow($obj->select(NEWS, "uin", array("headline" => 1)));
}
elseif (isset($_POST['search'])) {
    $searchid = $obj->StringInputCleaner($_POST['search']);
    $query = $obj->db->query("select ".$common_field." ,imp_news from " . NEWS . "  where n01title like '%$searchid%' limit " . $start . ", " . $perPage . "");
    $count = $obj->countRow($obj->db->query("select uin from " . NEWS . "  where n01title like '%$searchid%'"));
    if($count==0){
     $query = $obj->db->query("select ".$common_field." ,imp_news from news_backup  where n01title like '%$searchid%' limit " . $start . ", " . $perPage . "");
     $count = $obj->countRow($obj->db->query("select uin from news_backup  where n01title like '%$searchid%'"));
    }
} else {
    $query = $obj->db->query("select ".$common_field.",imp_news  from " . NEWS . "  order by mytime desc limit  $start, $perPage");
    $count = $obj->countRow($obj->select(NEWS, "uin"));
}
$previlage = $usrPrev->checkPrevilage($_SESSION['authid']);

$sn = 1;
$numPage = ceil($count / $perPage);
$newslist = '';
if ($query->rowCount() > 0) {

    while ($row_news = $query->fetch()):
        $news_cat = $obj->getDataByField(NEWS_CAT, 'cat01id', $row_news['n01type']);
        $user = $obj->getDataByField("u01user", 'uin', $row_news['user_id']);


        $newslist .='<tr id="' . $row_news['uin'] . '">';
       if (isset($flash)|| isset($sub_flash)) {
            $newslist .= '  <td><span></span></td>';
        }
        $newslist .= '    <th>' . $sn . '</th>
                        <td width="15%"><a href="' . SITE_URL . 'news-details/' . $row_news['uin'] . '/' . $row_news['posted_on'] . '" target="_blank">' . stripslashes($row_news['n01title']) . ' ' . (($row_news['n01draft'] == 1) ? '<strong style="color:#f00;">Draft</strong>' : '') . ' ' . (($row_news['scheduled'] == 1) ? '<strong style="color:blue;">Scheduled</strong>' : '') . ' </a></td>
                        <td>' . $news_cat['cat01category'] . '</td>
                        <td>'.(($row_news['user_id']>1)?'' . $user['u01fullname'] . '' : 'Admin').'</td>
                        <td>' . $row_news['posted_on'] . '</td>';
        $newslist .= '<td>
                       ' . (($row_news['flash'] == 1) ? '<a href="#"><img src="assets/images/publish_small.png" align="published" onclick="change_status(' . $row_news['uin'] . ',0,\'flash\',\'n01news\',\'normal\' )" /></a>' : '<a href="#"><img src="assets/images/unpublish_small.png" align="published" onclick="change_status(' . $row_news['uin'] . ',1,\'flash\',\'n01news\',\'normal\' )" /></a> ') . '
                        </td>
                        <td>
                       ' . (($row_news['highlight'] == 1) ? '<a href="#"><img src="assets/images/publish_small.png" align="published" onclick="change_status(' . $row_news['uin'] . ',0,\'highlight\',\'n01news\',\'normal\' )" /></a>' : '<a href="#"><img src="assets/images/unpublish_small.png" align="published" onclick="change_status(' . $row_news['uin'] . ',1,\'highlight\',\'n01news\',\'normal\' )" /></a> ') . '
                        </td>
                         <td>
                       ' . (($row_news['headline'] == 1) ? '<a href="#"><img src="assets/images/publish_small.png" align="published" onclick="change_status(' . $row_news['uin'] . ',0,\'headline\',\'n01news\',\'normal\' )" /></a>' : '<a href="#"><img src="assets/images/unpublish_small.png" align="published" onclick="change_status(' . $row_news['uin'] . ',1,\'headline\',\'n01news\',\'normal\' )" /></a> ') . '
                        </td>
                        <td>
                       ' . (($row_news['imp_news'] == 1) ? '<a href="#"><img src="assets/images/publish_small.png" align="published" onclick="change_status(' . $row_news['uin'] . ',0,\'imp_news\',\'n01news\',\'normal\' )" /></a>' : '<a href="#"><img src="assets/images/unpublish_small.png" align="published" onclick="change_status(' . $row_news['uin'] . ',1,\'imp_news\',\'n01news\',\'normal\' )" /></a> ') . '
                        </td>
                         
                        ';
         if(isset($cat) && $cat==22):
         $newslist .= '<td>
                       ' . (($row_news['featured'] == 1) ? '<a href="#"><img src="assets/images/publish_small.png" align="published" onclick="change_status(' . $row_news['uin'] . ',0,\'featured\',\'n01news\',\'normal\' )" /></a>' : '<a href="#"><img src="assets/images/unpublish_small.png" align="published" onclick="change_status(' . $row_news['uin'] . ',1,\'featured\',\'n01news\',\'normal\' )" /></a> ') . '
                        </td>';     
                        endif;
                        
            $newslist .='<td>' . $row_news['view'] . '</td>';
            
        $newslist .='<td><a href="?fol=form&amp;page=add-news&action=edit&id=' . $row_news['uin'] . '&type=' . $row_news['n01type'] . '" title="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Edit</a>';
        if ($previlage=='All'):
            $newslist .='<a href="?fol=actpages&amp;page=act_adednews&delete=' . $row_news['uin'] . '&type=' . $row_news['n01type'] . '" title="" class="btn btn-danger btn-xs" onclick="return confirm(\'Delete / Uninstall cannot be undone! Are you sure you want to do this?\')"><i class="fa fa-close"></i>Delete</a></td>';
        endif;
        $newslist .= '</tr>';

        $sn++;
    endwhile;
}else {
    $newslist.='No Result Found';
}
$json_arr = array("newsList" => $newslist, "numPage" => $numPage, "count" => $count);

$result = json_encode($json_arr);

if ($result != "") {
    echo $result;
} else {
    echo 'error';
}
