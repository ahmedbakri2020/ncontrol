<?php

//print_r($_POST);die();
if ($_FILES['image']['error'] == 0) {
    $config['directory'] = '../uploads/images/';
    $config['thumb_width'] = 398;
    $config['thumb_height'] = 584;
    $image_obj = ImageManipulation::generateClass($config);
    $imageResult = $image_obj->upload_image($_FILES['image']);
} else {
    $imageResult = $_POST['image'];
}
$date = date('Y-m-d');

if ($_POST['action'] == 'edit') {
    $id = (int) $_POST['id'];

    $obj->tbl = GALLERY;
    $obj->val = $obj->val = array("g01title" => $_POST['title'],
        "g01by" => $_POST['by'],
        "g01desc" => $_POST['desc'],
        // "g01type" => $_POST['type'],
        //"posted_on" => $date,
        "user_id" => $auth
    );
    if ($imageResult != "") {
        $obj->val['g01image'] = $imageResult;
    }
    $obj->cond = array("uin" => $id);
    $obj->update();
    Page_finder::set_message("Data successfully Edited.", 'success');
    $obj->redirect('?page=photo-gallery&type=' . $_POST['type']);
} elseif ($_POST['action'] == 'add') {

    $obj->tbl = GALLERY;
    $obj->val = array("g01title" => $_POST['title'],
        "g01by" => $_POST['by'],
        "g01desc" => $_POST['desc'],
        "posted_on" => $date,
        "g01type" => $_POST['type'],
        "g01image" => $imageResult,
        "user_id" => $auth
    );

    $id = $obj->insert();
    Page_finder::set_message("Data successfully Added.", 'success');
    $obj->redirect('?page=photo-gallery&type=' . $_POST['type']);
}


if (isset($_GET['delete']) && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];
    $get_row = $obj->getDataByField(GALLERY, 'uin', $id);
    if ($get_row['g01image'] != "") {
        $image =  '../uploads/images/'.$get_row['g01image'];
        $thumb =  '../uploads/images/thumbs/' . $get_row['g01image'];
        unlink($image);
        unlink($thumb);
    }
    $obj->tbl = GALLERY;
    $obj->cond = array('uin' => $id);
    $obj->delete();

    Page_finder::set_message("Data Successfully Deleted", 'success');
    $obj->redirect('?page=photo-gallery&type=' . $_GET['type']);
}
?>