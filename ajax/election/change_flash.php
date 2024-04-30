<?php
include '../../../system/application_top.php';
$table = $obj->StringInputCleaner($_POST['table']);
$field = $obj->StringInputCleaner($_POST['field']);
$value = $obj->StringInputCleaner($_POST['value']);
$id = (int)$_POST['id'];
if($_POST['tbl_type']=='normal'){
  $uid = 'uin';
}else{
   $uid = 'cat01id'; 
}

$data = $obj->db->query("update  ".$table." set ".$field."=".$value." where $uid=".$id."");
if($data->rowCount()){
    echo json_encode(array("status"=>1));
}