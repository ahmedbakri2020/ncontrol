<?php
//print_r($_POST);
$dob  = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
//print_r($_FILES);
if($_FILES['image']['error']==0){
    $config['directory'] = '../uploads/reporter/';
    $config['thumb_width'] = 100;
    $config['thumb_height'] = 100;
    $image_obj  =  ImageManipulation::generateClass($config);
    $imageResult = $image_obj  -> upload_image($_FILES['image']);

}else{
    $imageResult = "";
}
if($_POST['action']=="edit")
{
    //echo "this is edit";
    $obj->tbl = "tbl_author";
    $obj->val = array("cat01category"=>$_POST['fullname'],
        "eng_fullname"=>$_POST['eng_fullname'],
        "fb"=>$_POST['fb'],
        "post" =>$_POST['post'],
        "address" =>$_POST['address'],
        "email"=>$_POST['email'],
         "description" => $_POST['description'],
        "link"=>$_POST['link'],
        "twitter"=>$_POST['twitter']);


    if($imageResult!=""){
        $obj->val['image'] = $imageResult;
    }
    $obj->cond = array("cat01id"=>$_POST['id']);
    $obj->update();

    Page_finder::set_message("Profile successfully Edited.",'check-64.png');
    $url = "?page=reporter";
    $obj->redirect($url);

}elseif($_POST['action']== "add")
{

    $obj->tbl = "tbl_author";

    $obj->val = array("cat01category"=>$_POST['fullname'],
     "eng_fullname"=>$_POST['eng_fullname'],
        "fb"=>$_POST['fb'],
        "post" =>$_POST['post'],
        "address" =>$_POST['address'],
        "twitter"=>$_POST['twitter'],
         "email"=>$_POST['email'],
         "description" => $_POST['description'],
        "link"=>$_POST['link'],
        "image"=>$imageResult);
    $id = $obj->insert();

    Page_finder::set_message("Profile successfully Inserted.",'check-64.png');
    $url = "?page=reporter";
    $obj->redirect($url);
}
if (isset($_GET['delete']) && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];
    $get_row = $obj->getDataByField("tbl_author", 'cat01id', $id);
    if ($get_row['image'] != "") {
        $image =  '../uploads/reporter/'.$get_row['image'];
        $thumb =  '../uploads/reporter/thumbs/' . $get_row['image'];
        unlink($image);
        unlink($thumb);
    }
    $obj->tbl = "tbl_author";
    $obj->cond = array('cat01id' => $id);
    $obj->delete();

    Page_finder::set_message("Data Successfully Deleted", 'check-64.png');
    $obj->redirect('?page=reporter');
}

//$obj->redirect("index.php?page=news");
?>