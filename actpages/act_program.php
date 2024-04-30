<?php 
//echo $_POST['action'];
//echo $_POST['type'];
//print_r($_POST);
//print_r($_FILES);
if($_GET['id']!=""){
	//	echo $_GET['action'];
	$obj->tbl = 'tbl_program';	
	$obj->cond = array("id"=>$_GET['id']);
	$obj->delete();
	$url = "?page=program&day=".$_GET['day'];
	$obj->redirect($url);
	}
    

if($_POST['action']=="edit")
{
	
	$obj->tbl = "tbl_program";
    //$days = array("01"=>"Sunday","02"=>"Monday","03"=>"Tuesday","04"=>"Wednesday","05"=>"Thursday","06"=>"Friday","07"=>"Saturday");
	//$day = $_POST['daySele'];
	//$pgmday = $days[$day];
	$start_time = $_POST['start_hour'].":".$_POST['start_min'].":"."00";
    $end_time = $_POST['end_hour'].":".$_POST['end_min'].":"."00";
    $obj->val = array("title"=>$_POST['title'],
        "start_time"=>$start_time,
        "presenter"=>$_POST['presenter'],
        "end_time"=>$end_time);
    $obj->cond = array("id"=>$_POST['id']);
    $id=$obj->update();
  	 Page_finder::set_message("Data successfully Updated.", 'success');
    $obj->redirect("?page=program");
	
}elseif ($_POST['action'] == 'add') {

     $days = array("01"=>"Sunday","02"=>"Monday","03"=>"Tuesday","04"=>"Wednesday","05"=>"Thursday","06"=>"Friday","07"=>"Saturday");
	foreach($_POST['dayselect'] as $key=>$value)
	{
	
		$day = $value;
		$pgmday = $days[$day];
 	$obj->tbl = tbl_program;
	$start_time = $_POST['start_hour'].":".$_POST['start_min'].":"."00";
    $end_time = $_POST['end_hour'].":".$_POST['end_min'].":"."00";
	$obj->val = array("day"=>$pgmday,"title"=>$_POST['title'],
            "start_time"=>$start_time,
            "presenter"=>$_POST['presenter'],
            "end_time"=>$end_time);
	
     $id=$obj->insert();
        }
    Page_finder::set_message("Data successfully Added.", 'success');
    $obj->redirect("?page=program");

}
?>

