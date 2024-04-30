<?php
$id = (int) $_GET['id'];
$pro = (int) $_GET['pro'];
$dist = (int) $_GET['dist'];
$category = $_GET['category'];
$obj->tbl = 'area_subdivision'; 
$obj->cond = array("aid" => $id);
$obj->delete();
$obj->redirect('index.php?page=palika_division&province='.$pro.'&district='.$dist); 