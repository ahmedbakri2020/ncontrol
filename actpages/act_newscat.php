<?php

if ($_FILES['cat_image']['error'] == 0) {
    $config['directory'] = '../uploads/category/';
    $config['thumb_width'] = 400;
    $config['thumb_height'] = 400;
    $image_obj = ImageManipulation::generateClass($config);
    $imageResult = $image_obj->upload_image($_FILES['cat_image']);
} else {
    $imageResult = $_POST['cat_image'];
}

$obj->tbl = NEWS_CAT;

if ($_POST['action'] == "edit") {
   // echo 'edit here';
    if (is_array($_POST['category'])) {
        foreach ($_POST['category'] as $key => $val) {
            $obj->val = array("cat01category" => addslashes($_POST['category'][$key]), "eng_title" => $_POST["eng_title"][$key]);
               if ($imageResult != "") {
                $obj->val['cat_image'] = $imageResult;
            }
            $obj->cond = array("cat01id" => $_POST['id']);
            $obj->update();
        }
    }
    Page_finder::set_message("Data Successfully Updated", 'success');
    $obj->redirect('?page=category&cat=' . $_POST['cat']);
} else {
    //echo 'add  here';
    if (is_array($_POST['category'])) {

        foreach ($_POST['category'] as $key => $val) {
            $obj->val = array("cat01category" => addslashes($_POST['category'][$key]), "eng_title" => $_POST["eng_title"][$key],"cat_image" => $imageResult);
            $obj->insert();
        }
    }

    Page_finder::set_message("Data Successfully Added", 'success');
    $obj->redirect('?page=category&cat=' . $_POST['cat']);
}