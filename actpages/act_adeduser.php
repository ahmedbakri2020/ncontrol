<?php

//print_r($_POST);die();
if ($_FILES['image']['error'] == 0) {
    $config['directory'] = '../uploads/user/';
    $config['thumb_width'] = 100;
    $config['thumb_height'] = 100;

    $image_obj = ImageManipulation::generateClass($config);
    $imageResult = $image_obj->upload_image($_FILES['image']);
} else {
    $imageResult = $_POST['image'];
}

if (isset($_POST['auth']) && is_array($_POST['auth'])) {
    foreach ($_POST['auth'] as $val) {
        $auth_type .= $val . ',';
    }
    $authen = substr($auth_type, 0, -1);
}

if($_POST['role']==1){
 $prev = 'All';
}else{
$prev = $authen;
}

if ($_POST['action'] == 'edit') {
    $userId = (int) $_POST['id'];
   // $username = $obj->StringInputCleaner($_POST['username']);

    $obj->tbl = "u01user";
    $obj->val = array("u01username" => $_POST['username'],
        "u01fullname" => $_POST['fullname'],
        "u01email" => $_POST['email'],
        "u01contact" => $_POST['contact'],
        "role" => $_POST['role'],
        "our_team" => $_POST['our_team'],
        "u01address" => $_POST['address'],
        "auth" => $prev
    );
    if ($imageResult != "") {
        $obj->val['u01image'] = $imageResult;
    }
    $obj->cond = array("uin" => $userId);
    $obj->update();

    $msg = "User Information successfully updated";
    $url = "?page=user";
} else {

    $username = $obj->StringInputCleaner($_POST['username']);
    $password = $usr->hashed_password($obj->StringInputCleaner($_POST['password']));

    $resultUser = $obj->db->query("select * from u01user where u01username = '" . $username . "'");
    if ($resultUser->rowCount() > 0) {
         $userError = 1;
    }

    $resultEmail = $obj->db->query("select * from u01user where u01email ='" . $_POST['username'] . "'");
    if ($resultEmail->rowCount() > 0) {
         $emailError = 1;
    }
    if (!isset($userError) && !isset($emailError)) {

        $obj->tbl = "u01user";
        $obj->val = array("u01username" => $username,
            "u01fullname" => $_POST['fullname'],
            "u01password" => $password,
            "u01email" => $_POST['email'],
            "u01contact" => $_POST['contact'],
            "role" => $_POST['role'],
            "auth" => $prev,
            "our_team" => $_POST['our_team'],
            "u01address" => $_POST['address'],
            "u01image" => $imageResult
        );
        $id = $obj->insert();
        $msg .= "User Successfully Added";
        $url = "?page=user";
    } else {

        $msg = "";
        if ($userError == 1) {
            $msg.= "Username Already Taken.";
        }
        if ($emailError == 1) {
            $msg.= "Email Already Taken";
        }
        $url = "?fol=form&page=add-user";
    }
   
    
}

if($_GET['delete'] && $_GET['delete']!=""){
    $msg = "";
 $id =   (int)$_GET['delete']; 
 $get_row = $obj->getDataByField("u01user",'uin',$id);
 if($get_row['u01image']!=""){
   $image = UPLOADS.'users/'.$get_row['u01image'];   
   $thumb = NEWS_IMAGE.'thumbs/'.$get_row['u01image'];
   
   unlink($image);   
   unlink($thumb);
 }
 
 $obj->tbl = "u01user";;
 $obj->cond = array('uin'=>$id);
 $obj->delete();
 
 $msg .= "User Successfully Deleted";
 $url = '?page=user';
}

$obj->alert($msg, $url);

?>