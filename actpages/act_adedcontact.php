<?php
if($_POST['action']=="edit")
{
    $obj->tbl = "tbl_region_contact";
    $obj->val = array("cat01category"=>$_POST['name'],
        "cat01contact"=>$_POST['contact'],
      );
    $obj->cond = array("cat01id"=>$_POST['id']);
    $obj->update();
    Page_finder::set_message("Rate successfully Edited.",'check-64.png');
    $url = "?page=regional";
    $obj->redirect($url);

}elseif($_POST['action']== "add")

{
    $obj->tbl = "tbl_region_contact";
    $obj->val = array("cat01category"=>$_POST['name'],
        "cat01contact"=>$_POST['contact'],

    );
    $id = $obj->insert();

    Page_finder::set_message("Rate successfully Inserted.",'check-64.png');
    $url = "?page=regional";
    $obj->redirect($url);

}
if (isset($_GET['delete']) && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];
    $obj->tbl = "tbl_region_contact";
    $obj->cond = array('cat01id' => $id);
    $obj->delete();
    Page_finder::set_message("Data Successfully Deleted", 'check-64.png');
    $obj->redirect('?page=regional');
}
?>