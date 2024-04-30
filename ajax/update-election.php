<?php

include '../../system/application_top.php';

if (isset($_POST['id']) && (int) $_POST['id'] != "") {
    $id = (int) $_POST['id'];
    $obj->tbl = "tbl_party";
    $obj->val = array("prati_win" => $_POST['prati_win'],
        "prati_agrata" => $_POST['prati_agrata'],
        "pradesh_win" => $_POST['pradesh_win'],
        "pradesh_agrata" => $_POST['pradesh_agrata'],
         "samanupatik" => $_POST['samanupatik'],
    );
    $obj->cond = array("uin" => $id);
    $query = $obj->update();

    if ($query == 1) {
        echo '<strong style="color:rgb(15, 81, 37);">Updated!</strong>';
    } else {
        echo '<strong style="color:#f00;">Failed</strong>';
    }
} else {
    die('Error');
}
?>