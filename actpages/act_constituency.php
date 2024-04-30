<?php

$obj->tbl = "constituency";

if ($_POST['action'] == "edit") {
            $obj->val = array("cat01category" => addslashes($_POST['constituency']));
            $obj->cond = array("cat01id" => $_POST['id']);
            $obj->update();
    Page_finder::set_message("Data Successfully Updated", 'success');
    $obj->redirect('?page=constituency');
} elseif($_POST['action'] == "add") {
            $obj->val = array("cat01category" => addslashes($_POST['constituency']));
            $obj->insert();
    Page_finder::set_message("Data Successfully Added", 'success');
    $obj->redirect('?page=constituency');
}elseif($_GET['action']=='delete' && $_GET['id']!=""){
$id = (int) $_GET['id'];
$obj->tbl = 'constituency'; 
$obj->cond = array("cat01id" => $id);
$obj->delete();
    Page_finder::set_message("Data Successfully Deleted", 'danger');
    $obj->redirect('?page=constituency');
}