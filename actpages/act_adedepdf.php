<?php

$today = date('Y-m-d');
if ($previlage == 'All' || in_array(1, $arr_prev)) {
    
} else {
    $obj->redirect('?page=404.php');
}

if (isset($_GET['delete']) && $_GET['delete'] >0) {
    $id = (int) $_GET['delete'];
    $get_row = $obj->getDataByField("epaper_pdf", 'eid', $id);
    

    $obj->tbl = "epaper_pdf";
    $obj->cond = array('eid' => $id);
    $obj->delete();
    $res_image = $obj->select("epaper_images","image",array("pdf_id"=>$id));
    while($row_image = $res_image->fetch()):
      unlink(APP_ROOT.'/uploads/paper/image/'.$row_image ['image']);
    endwhile;
    
    $obj->tbl = "epaper_images";
    $obj->cond = array('pdf_id' => $id);
    $obj->delete();



    Page_finder::set_message("Epaper Successfully Deleted", 'success');
    $obj->redirect('?page=epaper-pdf'); die();
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


if ($_FILES['image']['error'] == 0) {
    $config['directory'] = '../uploads/paper/images/';
    $config['thumb_width'] = 252;
    $config['thumb_height'] = 170;
    $image_obj = ImageManipulation::generateClass($config);
    $imageResult = $image_obj->upload_image($_FILES['image']);
} else {
    $imageResult = "";
}

if ($_FILES['pdf']['error'] == 0) {

    $pdf_type = $_FILES['pdf']['type'];
    $pdfname = str_replace('', '-', $_FILES['pdf']['name']);
    $temp_name = $_FILES['pdf']['tmp_name'];
    $path = '../uploads/paper/pdf/';
    $upload_result = $obj->uploadFile($temp_name, $pdfname, $path);
} else {
    $upload_result = "";
}

/*if (!extension_loaded('imagick'))
    echo 'imagick not installed';

if ($pdfname == FALSE) {
    $pdfname = "";
} else {
    include APP_ROOT . '/classes/Imagick.php';
    $pdf_file = $upload_result;
    $conversionimg_name = substr($pdfname, 0, -4); // remove extention .jpg from image name 
    $conversionimg_name = str_replace(' ', '-', $conversionimg_name);
    $image_path = APP_ROOT . "/uploads/paper/images/$conversionimg_name.jpg";
    $imgck = new Imgck();

    $converted = $imgck->pdf_to_image($image_path, $pdf_file);
}
*/



if ($_POST['action'] == "edit") {

    //echo "this is edit";
    if (is_array($category)) {
        foreach ($category as $val) {
            $obj->tbl = "epaper_pdf";
            $obj->val = array("epaper_name" => $_POST['title'], "paper_date" => $_POST['date'], "emonth" => $_POST['emonth'],
                "e01type" => $val);

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
    $obj->redirect('?page=epaper-pdf');
} elseif ($_POST['action'] == 'add') {

    if ($category != "") {
        if (is_array($category)) {
            foreach ($category as $val) {
                $obj->tbl = "epaper_pdf";
                $obj->val = array("epaper_name" => $_POST['title'],
                    "paper_date" => $_POST['date'],
                    "emonth" => $_POST['emonth'],
                    "epaper_pdf" => $pdfname,
                    "e01type" => $val,
                    "epaper_image" => $imageResult);

                $id = $obj->insert();

               /* if ($converted > 0) {
                    $obj->tbl = 'epaper_images';
                    for ($i = 0; $i < $converted; $i++) {
                        $pdf_latestimg = $conversionimg_name . '-' . $i . '.jpg';
                        $obj->val = array("image" => $pdf_latestimg, "pdf_id" => $id, "posted_date" => $today);
                        $obj->insert();
                    }
                } */
            }
        }
        Page_finder::set_message("Pdf Successfully Added", 'success');
        $obj->redirect('?page=epaper-pdf');
    } else {
        $obj->alert('Please Select Category First', '?page=news&nid=' . $_POST['type']);
    }
}
?>







