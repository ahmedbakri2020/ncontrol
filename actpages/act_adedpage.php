<?php

if (isset($_POST['btn_submit'])) {
    $id = (int)$_POST['id'];
    $obj->tbl = "p01pages";
    $obj->val = array(
        "p01desc" => $_POST['desc'],
        "p01address" => $_POST['address'],
        "p01email" => $_POST['email'],
        "app_link" => $_POST['app_link'],
        "p01fax" => $_POST['fax'],
        "p01contact" => $_POST['contact'],        
        "p01twitter" => $_POST['twitter'],
        "p01fb" => $_POST['fb'],
        "p01insta" => $_POST['instagram'],
        "p01yt" => $_POST['yt']);
    $obj->cond = array("cat01id" => $id);
    $obj->update();
   $obj->redirect('?page=about-company&id='.$id);
} else {
    echo "Problem Occured Please try again";
}
?>