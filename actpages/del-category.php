<?php
$category = $_GET['category'];
$id = (int)$_GET['id'];
$type = (int)$_GET['cat_id'];
$obj->tbl = 'tbl_'.$category;
$obj->cond = array("cat01id"=>$id);
$obj->delete();
Page_finder::set_message("Data Successfully Deleted", 'success');
$obj->redirect('?page=category&cat='.$category.'&id=' . $type);