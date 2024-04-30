<?php

if (isset($_POST['btn_submit'])) {
    if ($_FILES['himage']['error'] == 0) {
        $config['directory'] = '../uploads/logo/';
        $config['thumb_width'] = 210;
        $config['thumb_height'] = 60;
        $image_obj = ImageManipulation::generateClass($config);
        $imageResult = $image_obj->upload_image($_FILES['himage']);
    } else {
        $imageResult = $_POST['himage'];
    }

    if ($_FILES['fimage']['error'] == 0) {
        $config['directory'] = '../uploads/logo/';
        $config['thumb_width'] = 210;
        $config['thumb_height'] = 60;
        $image_obj = ImageManipulation::generateClass($config);
        $imageResult1 = $image_obj->upload_image($_FILES['fimage']);
    } else {
        $imageResult1 = $_POST['fimage'];
    }
    $id = (int)$_POST['id'];
    $obj->tbl = "tbl_site";
    $obj->val = array(
        "sname" => $_POST['site-name']);

    if ($imageResult != "") {
        $obj->val['hlogo'] = $imageResult;
    }
    if ($imageResult1 != "") {
        $obj->val['flogo'] = $imageResult1;
    }

    $obj->cond = array("cat01id" => $id);
    $obj->update();
    $obj->redirect('?page=site-setting&id='.$id);
} else {
    echo "Problem Occured Please try again";
}
?>
