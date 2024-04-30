<?php

include('../../system/application_top.php');
$list_order = $obj->StringInputCleaner($_POST['list_order']);
$list = explode(',', $list_order);
$i = 1;
foreach ($list as $id) {
    if($id!=""):
//echo 'UPDATE nw01tbl_news  SET news_order =' . $i . ' WHERE nw01id = ' . $id . '';
        $obj->db->query('UPDATE n01news  SET news_order =' . $i . ' WHERE uin = ' . $id . '');
        $i++;
    endif;
}
?>