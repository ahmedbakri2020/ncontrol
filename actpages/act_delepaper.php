<?php
if (isset($_GET['delete']) && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];    
    $type=(int) $_GET['type'];
    
    $obj->tbl = "tbl_paper";
    $obj->cond = array('id' => $id);
    $obj->delete();
    
    Page_finder::set_message("Data Successfully Deleted", 'check-64.png');
     $obj->redirect("?page=add_paper&epaper_id=$type&type=1");
}
?>