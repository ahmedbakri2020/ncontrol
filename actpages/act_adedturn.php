<?php
 //ini_set('display_errors', 1);
  //ini_set('display_startup_errors', 1);
  //error_reporting(E_ALL);
if ($previlage == 'All' || in_array(1, $arr_prev)) {

} else {
    $obj->redirect('?page=404.php');
}

if (isset($_GET['delete']) && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];
    $get_row = $obj->getDataByField("epaper_turn", 'eid', $id);
    //$get_cat = $obj->getDataByField(NEWS_CAT, 'cat01id', $get_row['n01type']);

    $obj->tbl = "epaper_turn";
    $obj->cond = array('eid' => $id);
    $obj->delete();

    Page_finder::set_message("Epaper Successfully Deleted", 'success');
    $obj->redirect('?page=epaper-turn');
}

if (isset($_GET['type'])) {
    $type = '&nid=' . $_GET['type'];
}
$category = $_POST['category'];

if (is_array($category)) {
    foreach ($category as $k => $v) {
        $val_type .= $v . ",";
    }
    $value = substr($val_type, 0, -1);

} else {
    echo 'select category first';
}


if($_FILES['image']['error']==0){
    $config['directory'] = '../uploads/turn/images/';
    $config['thumb_width'] = 252;
    $config['thumb_height'] = 170;
    $image_obj  =  ImageManipulation::generateClass($config);
    $imageResult = $image_obj  -> upload_image($_FILES['image']);

}else{
    $imageResult = "";
}

if ($_FILES['pdf']['error'] == 0) {

    $pdf_type = $_FILES['pdf']['type'];
    $pdfname = rand().str_replace('', '-', $_FILES['pdf']['name']);
    $temp_name = $_FILES['pdf']['tmp_name'];
    $path = '../uploads/turn/pdf/';
    $pdf_file = $obj->uploadFile($temp_name, $pdfname, $path);
}
else {
    $pdfname = "";
}

/*if ($_FILES['pdf']['error'] == 0) {
    $pdf_type = $_FILES['pdf']['type'];
    $pdfname = rand().str_replace(' ', '-', $_FILES['pdf']['name']);
    $temp_name = $_FILES['pdf']['tmp_name'];
    $path = APP_ROOT."/uploads/paper/pdf/";
   $pdf_file = $obj->uploadFile($temp_name, $pdfname, $path); 

     if ($pdf_file != FALSE) {
        $conversionimg_name = substr($pdfname,0,-4); // remove extention .jpg from image name
        $image_path = APP_ROOT."/uploads/paper/images/$conversionimg_name.jpg";
        $imgck = new Imgck();
        
        $converted = $imgck->pdf_to_image($image_path, $pdf_file);
       // var_dump($converted);
        //die();
        
        if($converted==TRUE){
            $pdf_latestimg = $conversionimg_name.'.jpg';
        }else{
            $pdf_latestimg = '';
        }
    }
} else {
    $pdfname = "";
}*/



if ($_POST['action'] == "edit") {

    //echo "this is edit";
    if (is_array($category)) {
        foreach ($category as $val) {
            $obj->tbl = "epaper_turn";
            $obj->val = array("epaper_name" => $_POST['title'],"paper_date" => $_POST['date'],"emonth"=>$_POST['emonth'],
                "e01type"=>$val);

            if ($imageResult != "") {
                $obj->val['epaper_image'] = $imageResult;
            }
            if ($pdfname != "") {
                $obj->val['epaper_pdf'] = $pdfname;
            }
            $obj->cond = array("eid" => $_POST['id']);
            $obj->update();
        }
    }
    Page_finder::set_message("Pdf successfully Edited.", 'success');
    $obj->redirect('?page=epaper-turn');
} elseif ($_POST['action'] == 'add') {

    if ($category != "") {
        if (is_array($category)) {
            foreach ($category as $val) {
                $obj->tbl = "epaper_turn";
                $obj->val = array("epaper_name" => $_POST['title'],
                "paper_date" => $_POST['date'],
                "emonth"=>$_POST['emonth'],
                    "epaper_pdf" => $pdfname,
                    "e01type"=>$val,
                    "epaper_image" => $imageResult);

                $id = $obj->insert();
            }
        }
        Page_finder::set_message("Pdf Successfully Added", 'success');
       $obj->redirect('?page=epaper-turn');
    } else {
        $obj->alert('Please Select Category First', '?page=epaper-turn');
    }
}
?>







