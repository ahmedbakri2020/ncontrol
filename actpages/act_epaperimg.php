<?php

//print_r($_POST);die();

$date = date('Y-m-d');

if (isset($_GET['delete']) && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];   
    $image = $obj->getDataByField('epaper_images','uin',$id);
    if(unlink(APP_ROOT.'/uploads/paper/images/'.$image['image'])){
        $obj->tbl = "epaper_images";
        $obj->cond = array('uin' => $id);
        $obj->delete();
        Page_finder::set_message("Data Successfully Deleted", 'success');
        
    }else{
        Page_finder::set_message("Data canot be Deleted", 'danger');
    }
    $obj->redirect('?page=epaper-images&pid=' . $_GET['pid']);
}

if ($_POST['action'] == 'add') {
     $obj->tbl = "epaper_images";
      $upload_path = '../uploads/paper/images/';
      $img_obj = new ImageManipulation();
      $image_res = $img_obj->upload_multiple_image($_FILES['images'],$upload_path);
      foreach($image_res as $image):
       $obj->val =  array("posted_date" => $date,"pdf_id"=>$_POST['pid'],"image"=>$image);
       $obj->insert();
      endforeach;
     
    Page_finder::set_message("Data successfully Added.", 'success');
    $obj->redirect('?page=epaper-images&pid=' . $_POST['pid']);
}



?>