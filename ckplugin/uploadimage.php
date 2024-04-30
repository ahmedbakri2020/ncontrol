<?php

require_once '../../system/application_top.php';

if (!$usr->is_loggedin()) {
    $obj->redirect('login.php');
}
$error = '';
$uploaded_Image = '';
//print_r($_FILES);
$info = pathinfo($_FILES["file"]["name"]);
$ext = $info['extension'];
$target_dir = '/home/nayapatrikadaily/public_html/public/uploads/news/images/';

$imagename = $_FILES["file"]["name"];
$uploaded_date = date('Y-m-d');
$filename = "$imagename'_'.$uploaded_date.$ext";
$target_file = $target_dir . $filename;
$ckfile = $target_file;
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


$check = getimagesize($_FILES["file"]["tmp_name"]);
if ($check !== false) {
    $uploadOk = 1;
} else {
    $error .= "File Uploading error in image";
    $uploadOk = 0;
}
/*
// Check if file already exists
if (file_exists($target_file)) {
    $error .= "File already exists with the same name";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["file"]["size"] > 5000000) {
    $error .= "Sorry! image size is larger than 2 MB. ";
    $uploadOk = 0;
}
 */

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "ico") {
    $error .= "Invalid Image";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    $error .= "Image Upload Process Failed. ";
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $uploaded_Image .= "https://nayapatrikadaily.com/uploads/news/images/" . $filename;
        if (isset($_GET['CKEditorFuncNum'])) {
            $CKEditorFuncNum = $_GET['CKEditorFuncNum'];
            $ckFunc = "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$ckfile', '');</script>";
        }
    } else {
        $error .= " Image uploading failed in " . $target_file . "'";
    }
}

echo json_encode(array("url" => $uploaded_Image, "error" => $error));
