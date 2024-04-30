<?php

$obj->tbl = "area_subdivision";

if ($_POST['action'] == "edit") {
    if (is_array($_POST['address'])) {
        foreach ($_POST['address'] as $key => $val) {
            $obj->val = array("address" => addslashes($_POST['address'][$key]),"palika_type" => addslashes($_POST['palika'][$key]),"cid" => $_POST["district_id"],"pradesh_id" => $_POST["pradesh_id"]);
            $obj->cond = array("aid" => $_POST['id']);
            $obj->update();
        }
    }
    Page_finder::set_message("Data Successfully Updated", 'success');
    $obj->redirect('?page=palika_division');
} else {
    if (is_array($_POST['address'])) {

        foreach ($_POST['address'] as $key => $val) {
            $obj->val = array("address" => addslashes($_POST['address'][$key]),"palika_type" => addslashes($_POST['palika'][$key]), "cid" => $_POST["district_id"],"pradesh_id" => $_POST["pradesh_id"]);
            $obj->insert();
        }
    }

    Page_finder::set_message("Data Successfully Added", 'success');
    $obj->redirect('?page=palika_division');
}