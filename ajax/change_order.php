<?php

include('../../system/application_top.php');
$list_order = $obj->StringInputCleaner($_POST['list_order']);
$list = explode(',', $list_order);
$table = $_POST['table'];
$field = $_POST['field'];
$table = $_POST['table'];
$action = $_POST['action'];
    $primary_id = 'uin';
$i = 1;
foreach ($list as $id) {
    if($id!=""):
        $obj->db->query('UPDATE '.$table.'  SET '.$field.' =' . $i . ' WHERE '.$primary_id.' = ' . $id . '');
        $i++;
    endif;
}
?>