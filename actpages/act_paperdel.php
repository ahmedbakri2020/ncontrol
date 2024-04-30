<?php
if (isset($_GET['delete']) && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];    
    $type=(int) $_GET['type'];
    
    $obj->tbl = "tbl_epaper";
    $obj->cond = array('epaper_id' => $id);
    $obj->delete();
    
    Page_finder::set_message("Data Successfully Deleted", 'check-64.png');
     $obj->redirect("?page=manage_paper&type=$type");
}
?><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

