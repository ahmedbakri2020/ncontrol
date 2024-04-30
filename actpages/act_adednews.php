<?php
if ($previlage == 'All' || in_array(1, $arr_prev)) {

} else {
    $obj->redirect('?page=404.php');
}

if ($_GET['delete'] && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];
    $get_row = $obj->getDataByField(NEWS, 'uin', $id);
    $get_cat = $obj->getDataByField(NEWS_CAT, 'cat01id', $get_row['n01type']);

    $obj->tbl = NEWS;
    $obj->cond = array('uin' => $id);
    $obj->delete();

    Page_finder::set_message("News Successfully Deleted", 'success');
    $obj->redirect('?page=news' . $type); die();
}

if (isset($_GET['type'])) {
    $type = '&nid=' . $_GET['type'];
}
$category = $_POST['category'];
$author = $_POST['author'];
if (is_array($author)) {
    foreach ($author as $k => $v) {
        $author_type .= $v . ",";
    }
    $author_val = substr($author_type, 0, -1);
}

if (is_array($category)) {
    foreach ($category as $k => $v) {
        $val_type .= $v . ",";
    }
    $value = substr($val_type, 0, -1);
    // die();
} else {
    echo 'select category first';
}
//print_r($category);

if ($_POST['input_time'] != "") {
    $time = date("G:i", strtotime($_POST['input_time']));
} else {
    $time = date("H:i:s");
}

if ($_POST['date'] != "") {
    $date = $_POST['date'];
} else {
    $date = date('Y-m-d');
}

if ($_POST['action'] == "edit") {
    $row_date = $obj->select(NEWS, "mytime", array("uin" => $_POST['id']));
    $res_ex_date = $row_date->fetch();
    $post_time = $res_ex_date['input_time'];
    if ($_POST['input_time'] != "") {
        $date_time = $date . ' ' . $time;
    } else {
        $date_time = $post_time;
    }
} else {
    $date_time = $date . ' ' . $time;
}

if ($_FILES['auth_img']['error'] == 0) {
    $config['directory'] = '/home/nayapatrikadaily/public_html/public/uploads/news/dristi/';
    $config['thumb_width'] = 250;
    $config['thumb_height'] = 250;
    $image_obj = ImageManipulation::generateClass($config);
    $authImage = $image_obj->upload_image($_FILES['auth_img']);
} else {
    $authImage = $_POST['auth_img'];
}

//'/home/nayapatrikadaily/public_html/public/uploads/news/images/';
if ($_FILES['image']['error'] == 0) {
    $config['directory'] = '/home/nayapatrikadaily/public_html/public/uploads/news/images/';
    $config['copyright'] = $_POST['copyright'];
    $config['thumb_width'] = array('652');
    $config['thumb_height'] = array('435');
    $image_obj = ImageManipulation::generateClass($config);
    $imageResult = $image_obj->upload_image($_FILES['image']);
    //var_dump($imageResult);
} else {
    $imageResult = $_POST['image'];
}
//echo $imageResult; die();
if ($_FILES['pdf']['error'] == 0) {
    $pdf_type = $_FILES['pdf']['type'];
    $pdfname = rand() . str_replace('', '-', $_FILES['pdf']['name']);
    $temp_name = $_FILES['pdf']['tmp_name'];
    $path = '../uploads/news/files/';
    $obj->uploadFile($temp_name, $pdfname, $path);
} else {
    $pdfname = "";
}

$posted_by = $_POST['posted_by']!=""?$_POST['posted_by']:'';

if ($_POST['action'] == "edit") {

    //echo "this is edit";
    if (is_array($category)) {
        foreach ($category as $val) {
            $obj->tbl = NEWS;
            $obj->val = array("n01title" => $_POST['title'],

                "sub_title" => $_POST['sub_title'],
                "n01desc" => $_POST['desc'],
                "shortdesc" => $_POST['shortdesc'],
                "n01draft" => $_POST['draft'],
                "posted_on" => $date,
                "mytime" => $date_time,
                "keyword" => $_POST['keyword'],
                 "p_type" => $_POST['p_type'],
                "location" => $_POST['location'],
                 "trend" => $_POST['trend'],
                "ribbon_news" => $_POST['ribbon_news'],
                 "temp_loc" => $_POST['temp_loc'],
                //"app_pub" => $_POST['app_url'],
               "author" => $author_val,
                "rtnews" => $_POST['rtnews'],
                    "rmnews" => $_POST['rmnews'],
                "n01type" => $val,
                "yt_code" => $_POST['yt_code'],
                "fb_code" => $_POST['fb_code'],
                "posted_by" => $posted_by,
                "sub_cat" => $_POST['sub_cat'],
                "img_caption" => $_POST['img_caption'],
                "instant_fb" =>$_POST['instant_fb'],
                "img_status" =>$_POST['img_status'],
                "img_display" =>$_POST['img_display'],
                "show_title" => $_POST['show_title'],
                "scheduled" => $_POST['schedule']);
            if ($imageResult != "") {
                $obj->val['n01image'] = $imageResult;
            }
             if ($authImage != "") {
                $obj->val['auth_img'] = $authImage;
            }
            
            if ($_POST['img_path'] != "") {
                $obj->val['img_path'] = $_POST['img_path'];
            }
            $obj->cond = array("uin" => $_POST['id']);
           $id =  $obj->update();
           
            if($id == 'TRUE'){
                   $desc=$obj->filterWords($_POST['desc'],30);
                       $obj->tbl = "news_feed";
                   $obj->val = array("n01title" => $_POST['title'],
                      "n01desc" => $desc,
                        "posted_on" => $date,
                    "posted_time" => $time,
                    "mytime" => $date_time,
                    "news_id" =>  $_POST['id'],
                      "n01draft" => $_POST['draft'],
                     "scheduled" => $_POST['schedule'],
                       "n01image" => $imageResult);
                            $obj->cond = array("news_id" => $_POST['id']);
                          $obj->update();
                      
                     
               }
        }
    }
    Page_finder::set_message("News successfully Edited.", 'success');
    $obj->redirect('?page=news' . $type);
} elseif ($_POST['action'] == 'add') {

    if ($category != "") {
        if (is_array($category)) {
            foreach ($category as $val) {
                $obj->tbl = NEWS;
                $obj->val = array("n01title" => $_POST['title'],
                    "sub_title" => $_POST['sub_title'],
                    "n01desc" => $_POST['desc'],
                    "shortdesc" => $_POST['shortdesc'],
                       "temp_loc" => $_POST['temp_loc'],
                        "trend" => $_POST['trend'],
                    "n01draft" => $_POST['draft'],
                    "posted_on" => $date,
                    "img_path" => $_POST['img_path'],
                    "posted_time" => $time,
                    "mytime" => $date_time,
                   "p_type" => $_POST['p_type'],
                    "keyword" => $_POST['keyword'],
                    "location" => $_POST['location'],
                    "ribbon_news" => $_POST['ribbon_news'],
                    "instant_fb" =>$_POST['instant_fb'],
                    "n01type" => $val,
                     "rtnews" => $_POST['rtnews'],
                    "rmnews" => $_POST['rmnews'],
                    "yt_code" => $_POST['yt_code'],
                     "fb_code" => $_POST['fb_code'],
                    "author" => $author_val,
                    "posted_by" => $posted_by,
                    "sub_cat" => $_POST['sub_cat'],
                    "scheduled" => $_POST['schedule'],
                    "img_caption" => $_POST['img_caption'],
                    "img_status" =>$_POST['img_status'],
                    "img_display" =>$_POST['img_display'],
                    "show_title" => $_POST['show_title'],
                     "auth_img" =>$authImage,
                    "user_id" => $auth,
                    "n01image" => $imageResult);

                $id = $obj->insert();
               if($id > 0){
                   $desc=$obj->filterWords($_POST['desc'],30);
                       $obj->tbl = "news_feed";
                   $obj->val = array("n01title" => $_POST['title'],
                      "n01desc" => $desc,
                        "posted_on" => $date,
                    "posted_time" => $time,
                      "n01draft" => $_POST['draft'],
                    "mytime" => $date_time,
                    "news_id" => $id,
                     "scheduled" => $_POST['schedule'],
                       "n01image" => $imageResult);
                       $obj->insert();
               }
            }
        }
        Page_finder::set_message("News Successfully Added", 'success');
     $obj->redirect('?page=news' . $type);
    } else {
        $obj->alert('Please Select Category First', '?page=news&nid=' . $_POST['type']);
    }
}
?>







