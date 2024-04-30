<?php

//print_r($_POST);die();

$date = date('Y-m-d');

if ($_POST['action'] == 'edit') {
    $id = (int) $_POST['id'];

    $obj->tbl = VIDEO;
    $obj->val = $obj->val = array("v01title" => $_POST['title'],
        "v01code" => $_POST['code'],
        "v01desc" => $_POST['desc'],
        // "v01type" => $_POST['type'],
        //"posted_on" => $date,
        "user" => $auth
    );
    
    $obj->cond = array("uin" => $id);
    $obj->update();
    Page_finder::set_message("Data successfully Edited.", 'check-64.png');
    $obj->redirect('?page=video-gallery&type=' . $_POST['type']);
} elseif ($_POST['action'] == 'add') {

    $obj->tbl = VIDEO;
    $obj->val = $obj->val = array("v01title" => $_POST['title'],
        "v01code" => $_POST['code'],
        "v01desc" => $_POST['desc'],
        "v01type" => $_POST['type'],
        "posted_on" => $date,
        "user" => $auth
    );

    $id = $obj->insert();
    Page_finder::set_message("Data successfully Added.", 'check-64.png');
    $obj->redirect('?page=video-gallery&type=' . $_POST['type']);
}


if (isset($_GET['delete']) && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];   
    $obj->tbl = VIDEO;
    $obj->cond = array('uin' => $id);
    $obj->delete();
    Page_finder::set_message("Data Successfully Deleted", 'check-64.png');
    $obj->redirect('?page=video-gallery&type=' . $_GET['type']);
}
?>