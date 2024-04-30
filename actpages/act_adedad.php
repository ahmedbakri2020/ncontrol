<?php
if($previlage=='All' || in_array(2,$arr_prev)){
}else{
$obj->redirect('?page=404.php');
}

//print_r($_POST);die();
if ($_FILES['image']['error'] == 0) {
    $config['directory'] = '../uploads/advertise/';
    $config['thumb_width'] = 350;
    $config['thumb_height'] = 100;

    $image_obj = ImageManipulation::generateClass($config);
    $imageResult = $image_obj->upload_image($_FILES['image']);
} else {
    $imageResult = $_POST['image'];
}
if ($_FILES['mimage']['error'] == 0) {
    $config['directory'] = '../uploads/advertise/';
    $config['thumb_width'] = 350;
    $config['thumb_height'] = 100;

    $image_obj = ImageManipulation::generateClass($config);
    $imageResult1 = $image_obj->upload_image($_FILES['mimage']);
} else {
    $imageResult1 = $_POST['mimage'];
}

if ($_FILES['a01video']['error'] == 0) {

    $vid_type = $_FILES['a01video']['type'];
    $vidname = rand() . str_replace(' ', '-', $_FILES['a01video']['name']);
    $obj->uploadFile($_FILES['a01video']['tmp_name'], $vidname, '../uploads/advertise/video/');
} else {
    $vidname = "";
}

$date = date('Y-m-d');
    $code = htmlentities($_POST['code']);
if ($_POST['action'] == 'edit') {
    $id = (int) $_POST['id'];

    $obj->tbl = ADVERTISE;
    $obj->val = $obj->val = array("a01title" => $_POST['title'],
        "a01url" => $_POST['url'],
        "a01price" => $_POST['price'],
        "cat_id" => $_POST['category'],
        "follow_up" => $_POST['follow_up'],
        "start_date" => $_POST['s_date'],
        "end_date" => $_POST['e_date'],
        "code" => $code,
        "col" => $_POST['col'],
        "level" => $_POST['level'],
        "user" => $auth
    );
    
    if ($imageResult != "") {
        $obj->val['a01image'] = $imageResult;
    }
     if ($imageResult1 != "") {
        $obj->val['a01image_mobile'] = $imageResult1;
    }
    if ($vidname != "") {
        $obj->val['a01video'] = $vidname;
    }

    $obj->cond = array("uin" => $id);
    $obj->update();
    Page_finder::set_message("Data successfully Edited.", 'success');
    $obj->redirect('?page=advertisement');
    
} elseif ($_POST['action'] == 'add') {

    $obj->tbl = ADVERTISE;
    $obj->val = $obj->val = array("a01title" => $_POST['title'],
        "a01url" => $_POST['url'],
        "a01price" => $_POST['price'],
        "cat_id" => $_POST['category'],
        "follow_up" => $_POST['follow_up'],
        "start_date" => $_POST['s_date'],
        "end_date" => $_POST['e_date'],
        "code" => $code,
        "level" => $_POST['level'],
        "col" => $_POST['col'],
        "posted_on" => $date,
        "user" => $auth,
        "a01image" => $imageResult,
         "a01image_mobile" => $imageResult1,
          "a01video" => $vidname,

    );

    $id = $obj->insert();
    Page_finder::set_message("Data successfully Added.", 'success');
   $obj->redirect('?page=advertisement');
}


if (isset($_GET['delete']) && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];
    $get_row = $obj->getDataByField(ADVERTISE, 'uin', $id);
    if ($get_row['a01image'] != "") {
        $image = '../uploads/advertise/' . $get_row['a01image'];
        $thumb = '../uploads/advertise/thumbs/' . $get_row['a01image'];
        unlink($image);
        unlink($thumb);
    }
    $obj->tbl = ADVERTISE;
    $obj->cond = array('uin' => $id);
    $obj->delete();

    Page_finder::set_message("Data Successfully Deleted", 'success');
    $obj->redirect('?page=advertisement');
}
?>