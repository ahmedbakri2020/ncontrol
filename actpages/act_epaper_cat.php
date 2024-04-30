<?php

if (isset($_POST['btn_submit']) && !empty($_POST['btn_submit'])) {
    if ($_POST['action'] == 'edit') {
        $obj->tbl = "tbl_epaper_cat";
        $obj->val = array("title" => $_POST['title'], "paper_date" => $_POST['date']);
        $obj->cond = array('uin' => $_POST['id']);
        $id = $obj->update();
        $msg = 'Data Successfully Updated';
    } elseif ($_POST['action'] == 'add') {
        $obj->tbl = "tbl_epaper_cat";
        $obj->val = array("title" => $_POST['title'], "paper_date" => $_POST['date']);
        $id = $obj->insert();
        $msg = 'Data Successfully Edited';
    }
}

if (isset($_GET['delete']) && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];
    $obj->tbl = "tbl_epaper_cat";
    $obj->cond = array('uin' => $id);
    $obj->delete();
}

Page_finder::set_message($msg, 'success');
$obj->redirect('?page=epaper-cat');
