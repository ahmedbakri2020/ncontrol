<?php
include '../../system/application_top.php';
$searchid = $obj->StringInputCleaner($_POST['value']);
$table = $obj->StringInputCleaner($_POST['tbl']);
$field = $obj->StringInputCleaner($_POST['field']);
$res_sql = $obj->db->query("select * from $table where $field like '%$searchid%'");
?>

