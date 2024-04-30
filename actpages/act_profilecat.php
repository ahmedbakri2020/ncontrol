<?php  
//echo $_POST['action'];
//echo $_POST['type'];
//print_r($_POST);
//print_r($_FILES);

if($_POST['action']=="edit")
{
    //echo "this is edit";
    $obj->tbl = "p02prof_cat";
    $obj->val = array("cat01category"=>$_POST['category']);
    $obj->cond = array("cat01id"=>$_POST['id']);
    $obj->update();           
    $url = "?page=profile_cat";
    $obj->redirect($url);
   
}elseif ($_POST['action'] == 'add') {

    $obj->tbl = "p02prof_cat";
    $obj->val = array("cat01category" => $_POST['category'], 
    );

     $id=$obj->insert();
    Page_finder::set_message("Data successfully Added.", 'success');
    $obj->redirect('?page=profile_cat');

}
elseif ($_GET['delete'] && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];
    
    $obj->tbl = "p02prof_cat";
    $obj->cond = array('cat01id' => $id);
    $obj->delete();

   Page_finder::set_message("Data successfully Removed.", 'success');
    $obj->redirect('?page=profile_cat');
}
?>