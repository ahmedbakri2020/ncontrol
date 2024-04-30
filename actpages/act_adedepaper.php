<?php
if ($_POST['action'] == 'edit') {
    $id = (int) $_POST['id'];

    $obj->tbl = "tbl_epaper";
    $obj->val = $obj->val = array("epaper_name" => $_POST['epaper_name'],
       // "g01by" => $_POST['by'],
        //"g01desc" => $_POST['desc'],
        // "g01type" => $_POST['type'],
        //"posted_on" => $date,
       // "user_id" => $auth
    );
   
    $obj->cond = array("epaper_id" => $id);
    $obj->update();
    Page_finder::set_message("Data successfully Edited.", 'check-64.png');
   $obj->redirect("?page=manage_paper&type=".$_POST['type']);
} elseif ($_POST['action'] == 'add') {


	$obj->tbl = "tbl_epaper";
	$obj->val = array("epaper_name"=>$_POST['epaper_name'],"date"=>$_POST['date'], "epaper_type"=>$_POST['type'],);
	$id = $obj->insert();
	$dir_name = $id;
        mkdir("../epaper/pages/".$dir_name,0777);
        mkdir("../epaper/pages/".$dir_name."/large",0777);
        mkdir("../epaper/pages/".$dir_name."/medium",0777);
        chmod("../epaper/pages/".$dir_name,0777);
        chmod("../epaper/pages/".$dir_name."/large",0777);
         chmod("../epaper/pages/".$dir_name."/medium",0777);
    	$obj->val = array("directory_name"=>$dir_name);
        $obj->cond =array("epaper_id"=>$id);
		$obj->update();
	$obj->redirect("?page=manage_paper&type=".$_POST['type']);
}
?>