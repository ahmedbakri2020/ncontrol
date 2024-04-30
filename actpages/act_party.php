<?php

//print_r($_POST);die();

$date = date('Y-m-d');
if ($_FILES['image']['error'] == 0) {
    $config['directory'] = '../uploads/election/';
    $config['thumb_width'] = 50;
    $config['thumb_height'] = 50;
    $image_obj = ImageManipulation::generateClass($config);
    $imageResult = $image_obj->upload_image($_FILES['image']);
} else {
    $imageResult = "";
}


if ($_POST['action'] == 'edit') {
    $id = (int) $_POST['id'];

    $obj->tbl = "tbl_party";
    $obj->val = $obj->val = array("name" => $_POST['name'],
    );
    if ($imageResult != "") {
        $obj->val['image'] = $imageResult;
    }
    $obj->cond = array("uin" => $id);
    $obj->update();
    Page_finder::set_message("Data successfully Edited.", 'success');
     $obj->redirect('?page=party');
} elseif ($_POST['action'] == 'add') {

    $obj->tbl = "tbl_party";
    $obj->val = $obj->val = array("name" => $_POST['name'],
        "image" => $imageResult,
    );

    $id = $obj->insert();
    Page_finder::set_message("Data successfully Added.", 'success');
    $obj->redirect('?page=party');
}


if (isset($_GET['delete']) && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];   
    $obj->tbl = "tbl_party";
    $obj->cond = array('uin' => $id);
    $obj->delete();
    Page_finder::set_message("Data Successfully Deleted", 'success');
     $obj->redirect('?page=party');
}
?>