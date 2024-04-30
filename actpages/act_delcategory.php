<?php

$id = (int) $_GET['id'];
$table = $_GET['t'];
$category = $_GET['category'];
$obj->tbl = 'cat01category'; // $table;
$obj->cond = array("cat01id" => $id);
$obj->delete();
$obj->redirect('index.php?page=manage_cat&category='.$category); //&cat='.$category