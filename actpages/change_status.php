<?php

include '../../system/application_top.php';
$table = $obj->StringInputCleaner($_POST['table']);
$field = $obj->StringInputCleaner($_POST['field']);
$value = $obj->StringInputCleaner($_POST['value']);



if (isset($_POST['id'])) {
    $id = (int) $_POST['id'];

    if ($_POST['tbl_type'] == 'normal') {
        $uid = 'uin';
    } else {
        $uid = 'cat01id';
    }

//echo "update  ".$table." set ".$field."=".$value." where $uid=".$id."  ";
    $data = $obj->db->query("update  " . $table . " set " . $field . "=" . $value . " where $uid=" . $id . "  ");
} elseif (isset($_POST['dist'])) {
    $type = (int) $_POST['type'];
    $dist = (int) $_POST['dist'];
    $get_data = $obj->select("tbl_election_status", "uin", array("dist" => $dist, "area" => $_POST['area'], "type" => $type));
    if ($get_data->rowCount() > 0) {
        $fetch_data = $get_data->fetch();
        // echo "update  tbl_election_status  set status=".$value." where uin=".$_POST['el_id']."  ";
        $data = $obj->db->query("update  tbl_election_status  set status=" . $value . " where uin=" . $fetch_data['uin'] . "  ");
    } else {
        $obj->tbl = 'tbl_election_status';
        $obj->val = array("dist" => $dist, "area" => $_POST['area'], "type" => $type, "status" => $value);
        $obj->insert();
    }
}

echo json_encode(array("status" => 1));
