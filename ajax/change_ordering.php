<?php

include('../../system/application_top.php');
$list_order = $obj->StringInputCleaner($_POST['page_order']);
$table = $obj->StringInputCleaner($_POST['tbl']);
$field = $obj->StringInputCleaner($_POST['of']);
$list = explode(',', $list_order);
$i = 1;
foreach ($list as $id) {
    if ($id != ""):

        $obj->db->query('UPDATE ' . $table . '  SET ' . $field . ' =' . $i . ' WHERE uin = ' . $id . '');
        $i++;
    endif;
}
