<?php
if($_POST['action']=="edit")
{
    $obj->tbl = "tbl_subscribe_rate";
    $obj->val = array("cat01category"=>$_POST['name'],
        "cat01annual"=>$_POST['annual'],
        "cat01half"=>$_POST['half'],);
    $obj->cond = array("cat01id"=>$_POST['id']);
    $obj->update();
    Page_finder::set_message("Rate successfully Edited.",'check-64.png');
    $url = "?page=subscription";
    $obj->redirect($url);

}elseif($_POST['action']== "add")

{
    $obj->tbl = "tbl_subscribe_rate";
    $obj->val = array("cat01category"=>$_POST['name'],
        "cat01annual"=>$_POST['annual'],
        "cat01half"=>$_POST['half'],
    );
    $id = $obj->insert();

    Page_finder::set_message("Rate successfully Inserted.",'check-64.png');
    $url = "?page=subscription";
    $obj->redirect($url);

}
if (isset($_GET['delete']) && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];
    $obj->tbl = "tbl_subscribe_rate";
    $obj->cond = array('cat01id' => $id);
    $obj->delete();
    Page_finder::set_message("Data Successfully Deleted", 'check-64.png');
    $obj->redirect('?page=subscription');
}
?>