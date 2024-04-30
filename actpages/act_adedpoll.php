<?php

if (isset($_POST['btn_submit']) && !empty($_POST['btn_submit'])) {
    if ($_POST['action'] == 'add') {
        if ($_FILES['image']['error'] == 0) {
            $config['directory'] = '../uploads/poll/';
            $config['thumb_width'] = 335;
            $config['thumb_height'] = 290;
            $image_obj = ImageManipulation::generateClass($config);
            $imageResult = $image_obj->upload_image($_FILES['image']);
        } else {
            $imageResult = $_POST['image'];
        }
        $obj->tbl = "poll_quest";
        $obj->val = array("ques" => $_POST['poll_question'], "image" => $imageResult);
        $id = $obj->insert();
        //for Option
        $count = count($_POST['value']);
        for ($i = 0; $i < $count; $i++) {
            $poll_option = $_POST['value'][$i];
            $obj->tbl = "poll_answer";
            $obj->val = array("answer" => $poll_option, "quest_id" => $id);
            $obj->insert();
        }
    }
    $obj->redirect("?page=poll");
}

if (isset($_GET['delete']) && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];
    $get_row = $obj->getDataByField("poll_quest", 'uin', $id);
    if ($get_row['image'] != "") {
        $image = '../uploads/poll/' . $get_row['image'];
        $thumb = '../uploads/poll/thumbs/' . $get_row['image'];
        unlink($image);
        unlink($thumb);
    }
    $obj->tbl = "poll_quest";
    $obj->cond = array('uin' => $id);
    $obj->delete();

    $obj->tbl = "poll_answer";
    $obj->cond = array('quest_id' => $id);
    $obj->delete();
    
    Page_finder::set_message("Data Successfully Deleted", 'check-64.png');
    $obj->redirect('?page=poll');
}