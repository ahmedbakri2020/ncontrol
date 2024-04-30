<?php

$obj->tbl = "ward";

if ($_POST['action'] == "edit") {
    if (is_array($_POST['ward'])) {
        foreach ($_POST['ward'] as $key => $val) {
            $obj->val = array("ward" => addslashes($_POST['ward'][$key]),"district_id" => $_POST["district_id"],"pradesh_id" => $_POST["pradesh_id"],"local_id" => $_POST["local_id"]);
            $obj->cond = array("uin" => $_POST['id']);
            $obj->update();
        }
    }
    Page_finder::set_message("Data Successfully Updated", 'success');
    $obj->redirect('?page=ward');
} else {
    if (is_array($_POST['ward'])) {

        foreach ($_POST['ward'] as $key => $val) {
            $obj->val = array("ward" => addslashes($_POST['ward'][$key]), "district_id" => $_POST["district_id"],"pradesh_id" => $_POST["pradesh_id"],"local_id" => $_POST["local_id"]);
            $obj->insert();
        }
    }

    Page_finder::set_message("Data Successfully Added", 'success');
    $obj->redirect('?page=ward');
}