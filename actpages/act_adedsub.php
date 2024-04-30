<?php

if (isset($_POST['btn_submit'])) {
    $id = (int)$_POST['id'];
    $obj->tbl = "tbl_subscribe";
    $obj->val = array(
        "sub_email" => $_POST['email'],
        "sub_toll" => $_POST['toll'],
        "sub_phone" => $_POST['phone'],
        "sub_sub" => $_POST['sub'],
        "sub_sms" => $_POST['sms'],
        "sub_comp" => $_POST['comp']);
    $obj->cond = array("cat01id" => $id);
    $obj->update();
    $obj->redirect('?page=subscribe&id='.$id);
} else {
    echo "Problem Occured Please try again";
}
?>