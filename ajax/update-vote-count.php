<?php

include '../../system/application_top.php';

if (isset($_POST['id']) && (int) $_POST['id'] != "") {
    $id = (int) $_POST['id'];
    $vote = (int) $_POST['vote'];
    $obj->tbl = "candidates";
    $obj->val = array("vote_count" => $vote);
    $obj->cond = array("uin" => $id);
    $query = $obj->update();
    if ($query!=FALSE) {
        echo '<strong style="color:rgb(15, 81, 37);">Updated!</strong>';
    } else {
        echo '<strong style="color:#f00;">Failed</strong>';
    }
} else {
    die('Error');
}
?>