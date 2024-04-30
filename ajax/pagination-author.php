<?php
include '../../system/application_top.php';
$searchid = $obj->StringInputCleaner($_POST['search']);
$query = $obj->db->query("select * from tbl_author  where status=0 and cat01category like '%$searchid%'");
$newslist = '';
if ($query->rowCount() > 0) {

    while ($row_news = $query->fetch()):
                $newslist .= '  <li>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="author[]"
                                                   value="' . $row_news['cat01id'] . '"> 
                                                 ' . $row_news['cat01category'] . '
                                        </label>
                                    </div>
                                </li>
                ';

         $sn++;
    endwhile;
}else {
    $newslist.='No Result Found';
}
$json_arr = array("newsList" => $newslist);

$result = json_encode($json_arr);

if ($result != "") {
    echo $result;
} else {
    echo 'error';
}
