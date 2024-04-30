<?php

//print_r($_POST);die();
$date = date('Y-m-d H:i:s');
if ($_FILES['image']['error'] == 0) {
    $config['directory'] = '../uploads/images/';
    $config['thumb_width'] = 194;
    $config['thumb_height'] = 194;
    $image_obj = ImageManipulation::generateClass($config);
    $imageResult = $image_obj->upload_image($_FILES['image']);
} else {
    $imageResult = $_POST['image'];
}
$date = date('Y-m-d');

if ($_POST['action'] == 'edit') {
    $id = (int) $_POST['id'];

    $obj->tbl = "tbl_images";
    $obj->val = $obj->val = array("caption" => $_POST['title'],
        "photo_by" => $_POST['by'],
        "description" => $_POST['desc'],
        "user" => $auth
    );
    if ($imageResult != "") {
        $obj->val['image'] = $imageResult;
    }
    $obj->cond = array("uin" => $id);
    $obj->update();
    Page_finder::set_message("Data successfully Edited.", 'success');
    $obj->redirect('?page=view-gallery&type=' . $_POST['type']);
} elseif ($_POST['action'] == 'add') {

    $obj->tbl = "tbl_images";
    $obj->val =  array("caption" => $_POST['title'],
        "type" => $_POST['type'],
        "photo_by" => $_POST['by'],
        "description" => $_POST['desc'],
        "user" => $auth,
        "image" => $imageResult,
        "posted_on"=>$date        
    );

    $id = $obj->insert();
    Page_finder::set_message("Data successfully Added.", 'success');
    $obj->redirect('?page=view-gallery&type=' . $_POST['type']);
}


if (isset($_GET['delete']) && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];
    $get_row = $obj->getDataByField("tbl_images", 'uin', $id);
    if ($get_row['image'] != "") {
        $image = '../uploads/images/' . $get_row['image'];
        $thumb = '../uploads/images/thumbs/' . $get_row['image'];
        unlink($image);
        unlink($thumb);
    }
    $obj->tbl = "tbl_images";
    $obj->cond = array('uin' => $id);
    $obj->delete();

    Page_finder::set_message("Data Successfully Deleted", 'success');
    $obj->redirect('?page=view-gallery&type=' . $_GET['type']);
}
?>