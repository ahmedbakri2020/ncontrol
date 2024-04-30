<?php
//print_r($_POST);
$dob  = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
//print_r($_FILES);
if($_FILES['image']['error']==0){
    $config['directory'] = '../uploads/paper/category/';
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
    $obj->tbl = "epaper_cat";
    $obj->val = array("cat01category"=>$_POST['cat_name']);

    if($imageResult!=""){
        $obj->val['cat_image'] = $imageResult;
    }
    $obj->cond = array("cat01id"=>$_POST['id']);
    $obj->update();

    Page_finder::set_message("Profile successfully Edited.",'check-64.png');
    $url = "?page=manage_category";
    $obj->redirect($url);

}elseif($_POST['action']== "add")
{

    $obj->tbl = "epaper_cat";

    $obj->val = array("cat01category"=>$_POST['cat_name'],
        "cat_image"=>$imageResult);
          $id = $obj->insert();

    Page_finder::set_message("Profile successfully Inserted.",'check-64.png');
    $url = "?page=manage_category";
    $obj->redirect($url);

}
if (isset($_GET['delete']) && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];
    $get_row = $obj->getDataByField("epaper_cat", 'cat01id', $id);
    if ($get_row['image'] != "") {
        $image =  '../uploads/paper/category'.$get_row['cat_image'];
        $thumb =  '../uploads/paper/category/thumbs/' . $get_row['cat_image'];
        unlink($image);
        unlink($thumb);
    }
    $obj->tbl = "epaper_cat";
    $obj->cond = array('cat01id' => $id);
    $obj->delete();

    Page_finder::set_message("Data Successfully Deleted", 'check-64.png');
    $obj->redirect('?page=manage_category');
}

?>