<?php
 $obj->tbl = "tbl_".$_POST['cat'];
$subtype = $_POST['type']!=""?'&id='.$_POST['type']:'';

if ($_POST['action'] == "edit") {
    //echo 'edit here';
    if (is_array($_POST['category'])) {
        foreach ($_POST['category'] as $key => $val) {
            
            if(isset($_POST['type']) && $_POST['type']!=""){
                $obj->val = array("cat01category" => addslashes($_POST['category'][$key]),"type" => addslashes($_POST['type']));
            }else{
                $obj->val = array("cat01category" => addslashes($_POST['category'][$key]));
            }
            $obj->cond = array("cat01id" => $_POST['id']);
            $obj->update();
        }
    }
    Page_finder::set_message("Data Successfully Updated", 'success');
    $obj->redirect('?page=category&cat='.$_POST['cat'].(($_POST['type']!="")?'&id='.$_POST['type'].'':'').'');
} else {
  //  echo 'add  here';
    if (is_array($_POST['category'])) {

        foreach ($_POST['category'] as $key => $val) {
            $obj->val = array("cat01category" => addslashes($_POST['category'][$key]));
            if(isset($_POST['type']) && $_POST['type']!=""){
                $obj->val = array("cat01category" => addslashes($_POST['category'][$key]),"type" => addslashes($_POST['type']));
            }else{
                $obj->val = array("cat01category" => addslashes($_POST['category'][$key]));
            }
           $obj->insert();
        }
    }

    Page_finder::set_message("Data Successfully Added", 'success');
    $obj->redirect('?page=category&cat='.$_POST['cat'].$subtype);
}