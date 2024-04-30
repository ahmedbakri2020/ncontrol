<?php  
echo $_POST['action'];
$num= $_POST['type'];
//print_r($_POST);
//print_r($_FILES); die();
if ($_POST['date'] != "") {
    $date = $_POST['date'];
} else {
    $date = date('Y-m-d');
}
//if($_POST['action']=="delete"){
if ($_GET['delete'] && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];
    $get_row = $obj->getDataByField(NEWS, 'uin', $id);
      if ($get_row['FILE'] != "") {
        $image = '../../uploads/audio/' . $get_row['file'];
        $thumb = '../../uploads/news/images/' . $thumb . '/' . $get_row['n01image'];
        unlink($thumb);
		 unlink($image);
       
    }

    $obj->tbl = "tbl_audio";
   $obj->cond = array('r_id' => $id);
    $obj->delete();

    Page_finder::set_message("News Successfully Deleted", 'success');
   $obj->redirect("?page=manage_audio&type=1&id=$num");
}
if($_POST['action']=="edit")
{
    //echo "this is edit";
    $obj->tbl = "tbl_audio";
    $obj->val = array("title"=>$_POST['title'],"type"=>$_POST['type'],"posted_on"=>$_POST['date']);
    $obj->cond = array("r_id"=>$_POST['id']);
    $obj->update();
    if(isset($_FILES['file']) && $_FILES['file']!='')
    {
      
       $type = $_FILES['file']['type'];
       
         $extention="audio/mpeg";
         if($extention!=""){ 
        $uploadPath = "../uploads/audio/";
        //for uploading file
        $temp_name = $_FILES['file']['tmp_name'];
        $file = $_POST['id'].".".$_FILES['file']['name'];
        $obj->UploadImage($temp_name, $extention, $file, $uploadPath);
        $obj->val = array("file"=>$file);
        $obj->cond = array("r_id"=>$_POST['id']);
       $obj->update();        
       Page_finder::set_message("Audio Successfully Added",'check-64.png');
       // $obj->redirect("?page=manage_audio&type=1&id=$num");
        
        
    }
    }
}if($_POST['action']=="add")
{

    $obj->tbl = "tbl_audio";
    $obj->val = array("title"=>$_POST['title'],"type"=>$_POST['type'],"posted_on"=>$date);
    $id = $obj->insert();
   
        $type = $_FILES['file']['type'];
     $extention="audio/mpeg";
          
        if($extention!=""){
        $uploadPath = "../uploads/audio/";
        //for uploading file
        $temp_name = $_FILES['file']['tmp_name'];
        $file = $id.".".$_FILES['file']['name'];
        $obj->UploadImage($temp_name, $extention, $file, $uploadPath);
        $obj->val = array("file"=>$file);
        $obj->cond = array("r_id"=>$id);
        $obj->update();        
         Page_finder::set_message("Audio Successfully Added",'check-64.png');
           $obj->redirect("?page=manage_audio&type=1&id=$num");
        
         }else{
         	echo 'error';
         }
         
}
