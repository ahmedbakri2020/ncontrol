<?php
include '../../system/application_top.php';
$status = (int)$_POST['statusid'];
$id= (int)$_POST['id'];
$data = $obj->db->query("update candidates set winner=$status where uin=".$id."");

if($data->rowCount()>0){
    echo json_encode(array("status"=>1));
}