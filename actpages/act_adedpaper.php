<?php

if (isset($_POST['btn_gallary_image'])) {
    //print_r($_FILES);
    if ($_FILES['file']['error'] == 0) {
        $file_name = str_replace(' ', '_', $_FILES['file']['name']);
        $temp_name = $_FILES['file']['tmp_name'];
        $upload_path = '../epaper/pdf/';
        $pdf_file = $obj->UploadFile($temp_name, $file_name, $upload_path);
     
        if ($pdf_file != FALSE) {
            $conversionimg_name = substr($file_name,0,-4); // remove extention .jpg from image name
            $image_path = "../epaper/images/$conversionimg_name.jpg";
            $imgick = new Imagick($pdf_file);
            $num_pages = $imgick->getNumberImages();
            $imgck = new Imgck();
            $converted = $imgck->pdf_to_image($image_path, $pdf_file);
           
        }
    }
    if ($converted == TRUE) {
       
        $obj->tbl = 'tbl_paper';
        $cnt1 = $obj->db->query("select * from tbl_paper where epaper_id = '$_POST[epaper_id]'");
        $cnt = $cnt1->rowCount();
        $page_order = $cnt + 1;
        for ($i = 0; $i < $num_pages; $i++):
             $image_name = $conversionimg_name.'-'.$i.'.jpg';
            $obj->tbl = "tbl_paper";
            $obj->val = array("paper_name" => "", "paper_loc" => $image_name, "page_order" => $page_order, "epaper_id" => $_POST['epaper_id']);
            $id = $obj->insert();
        endfor;
    }else{
        Page_finder::set_message('Error While Converting...');
    }
    	$obj->redirect($_SERVER['HTTP_REFERER']);
}	
