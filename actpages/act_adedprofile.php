<?php  
//print_r($_POST);
$dob  = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
//print_r($_FILES);
if($_FILES['image']['error']==0){
        $config['directory'] = '../uploads/profile/';
        $config['thumb_width'] = 252;
        $config['thumb_height'] = 170;
        $image_obj  =  ImageManipulation::generateClass($config);
        $imageResult = $image_obj  -> upload_image($_FILES['image']);
        
}else{
        $imageResult = "";
}
if($_POST['action']=="edit")
{
    //echo "this is edit";
    $obj->tbl = "tbl_profile";
    $obj->val = array("fullname"=>$_POST['fullname'],
                      "post"=>$_POST['post'],
                      "email"=>$_POST['email'],
                      "type"=>$_POST['type'],
            // "description"=>$_POST['description'],
        "contact"=>$_POST['contact'],
        "address"=>$_POST['address']);
    if($imageResult!=""){
       $obj->val['image'] = $imageResult;
    }
    $obj->cond = array("p_id"=>$_POST['id']);
    $obj->update();

        Page_finder::set_message("Profile successfully Edited.",'check-64.png');
       $url = "?page=profile";
        $obj->redirect($url);
    
}elseif($_POST['action']== "add")
{

    $obj->tbl = "tbl_profile";
   
    $obj->val = array("fullname"=>$_POST['fullname'],                     
                      "post"=>$_POST['post'],
                      "type"=>$_POST['type'],
                      "email"=>$_POST['email'],
                      "address"=>$_POST['address'],
        "contact"=>$_POST['contact'],
                     //"description"=>$_POST['description'],
                     "image"=>$imageResult);
    $id = $obj->insert();

        Page_finder::set_message("Profile successfully Inserted.",'check-64.png');
        $url = "?page=profile";
        $obj->redirect($url); 

}
if (isset($_GET['delete']) && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];
    $get_row = $obj->getDataByField("tbl_profile", 'p_id', $id);
    if ($get_row['image'] != "") {
        $image =  '../uploads/profile/'.$get_row['image'];
        $thumb =  '../uploads/profile/thumbs/' . $get_row['image'];
        unlink($image);
        unlink($thumb);
    }
    $obj->tbl = "tbl_profile";
    $obj->cond = array('p_id' => $id);
    $obj->delete();

    Page_finder::set_message("Data Successfully Deleted", 'check-64.png');
    $obj->redirect('?page=profile');
}

//$obj->redirect("index.php?page=news");
?>