<?php

$obj->tbl = "cat01category";

if ($_POST['action'] == "edit") {
    if (is_array($_POST['category'])) {
        foreach ($_POST['category'] as $key => $val) {
            $obj->val = array("cat01category" => addslashes($_POST['category'][$key]), "pradesh_id" => $_POST["pradesh_id"],"type" => $_POST["type"]);
            $obj->cond = array("cat01id" => $_POST['id']);
            $obj->update();
        }
    }
    Page_finder::set_message("Data Successfully Updated", 'success');
    $obj->redirect('?page=manage_cat&category=' . $_POST['cat']);
} else {
    if (is_array($_POST['category'])) {

        foreach ($_POST['category'] as $key => $val) {
            $obj->val = array("cat01category" => addslashes($_POST['category'][$key]), "pradesh_id" => $_POST["pradesh_id"],"type" => $_POST["type"]);
            $obj->insert();
        }
    }

    Page_finder::set_message("Data Successfully Added", 'success');
    $obj->redirect('?page=manage_cat&category=' . $_POST['cat']);
}