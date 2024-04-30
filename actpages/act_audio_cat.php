<?php  
//echo $_POST['action'];
//echo $_POST['type'];
//print_r($_POST);
//print_r($_FILES);
if ($_POST['date'] != "") {
    $date = $_POST['date'];
} else {
    $date = date('Y-m-d');
}
if ($_FILES['image']['error'] == 0) {
    $config['directory'] = '../uploads/audio/images/';
    $config['thumb_width'] = 245;
    $config['thumb_height'] = 173;
    $image_obj = ImageManipulation::generateClass($config);
    $imageResult = $image_obj->upload_image($_FILES['image']);
} else {
    $imageResult = $_POST['image'];
}
if($_POST['action']=="edit")
{
    //echo "this is edit";
    $obj->tbl = "tbl_resources";
    $obj->val = array("title"=>$_POST['title'],"description"=>$_POST['description'],"posted_by"=>$_POST['author']);
     if ($imageResult != "") {
        $obj->val['file'] = $imageResult;
    }
    $obj->cond = array("r_id"=>$_POST['id']);
    $obj->update();           
    $url = "?page=audio-gallery&type=" . $_POST['type'];
    $obj->redirect($url);
   
}elseif ($_POST['action'] == 'add') {

    $obj->tbl = "tbl_resources";
    $obj->val = array("title" => $_POST['title'],
       "description" => $_POST['description'],
        "posted_on"=>$date,
        "posted_by"=>$_POST['author'],
        "type"=>$_POST['type'],
         "file" => $imageResult
    );

     $id=$obj->insert();
    Page_finder::set_message("Data successfully Added.", 'success');
    $obj->redirect('?page=audio-gallery&type=' . $_POST['type']);

}
?>