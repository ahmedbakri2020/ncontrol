<?php
$date = date('Y-m-d');
if($_FILES['image']['error']==0){
    $config['directory'] = '../uploads/candidate/';
    $config['thumb_width'] = 100;
    $config['thumb_height'] = 100;
    $image_obj  =  ImageManipulation::generateClass($config);
    $imageResult = $image_obj  -> upload_image($_FILES['image']);

}else{
    $imageResult = "";
}
$obj->tbl = "candidates";
if ($_POST['action'] == 'edit') {
    $id = (int) $_POST['id'];
    $obj->val = array(
        "election_type"=>$_POST['election_type'],
        "group_type"=>$_POST['group_type'],
        "party_id"=>$_POST['party'],
        "name" => $_POST['name'],
        "province_id" => $_POST['province_id'],
        "district_id" => $_POST['district_id'],
       "constituency_id" => $_POST['constituency_id'],
        "featured" => $_POST['featured'],
         "status" => ($_POST['winner']==1)?'completed':'finished'
    );
     if($imageResult!=""){
        $obj->val['cimage'] = $imageResult;
    }

    $obj->cond = array("uin" => $id);
    $obj->update();
       $etype = $_POST['election_type'];
       $egroup  = (isset($_POST['group_type']) && $_POST['group_type']>0)?$_POST['group_type']:'0';
       $eprovince = $_POST['province_id'];
       $edistrict = $_POST['district_id'];
       $econstituency = $_POST['constituency_id'];
       $res_check_data = $obj->db->query("select * from election_display where election_type='$etype' and province='$eprovince' and district='$edistrict' and const='$econstituency' and group_id='$egroup'");
      if($res_check_data->rowCount()>0):
        $obj->tbl = "election_display";
        $obj->val = array(
        "election_type"=>$etype,
        "province"=>$eprovince,
        "district"=>$edistrict,
        "const" => $econstituency,
        "group_id" => $egroup
    );
    $obj->cond = array("uin" => $id);
    $obj->update();
    else:
         $obj->tbl = "election_display";
        $obj->val = array(
        "election_type"=>$etype,
        "province"=>$eprovince,
        "district"=>$edistrict,
        "const" => $econstituency,
        "group_id" => $egroup
    );
     $id = $obj->insert();
    endif;
    Page_finder::set_message("Data successfully Edited.", 'success');
    $obj->redirect('?page=candidate');
} elseif ($_POST['action'] == 'add') {
    $obj->val = array(
        "election_type"=>$_POST['election_type'],
        "group_type"=>$_POST['group_type'],
        "party_id"=>$_POST['party'],
        "name" => $_POST['name'],
        "province_id" => $_POST['province_id'],
        "district_id" => $_POST['district_id'],
       "constituency_id" => $_POST['constituency_id'],
        "featured" => $_POST['featured'],
          "status" => ($_POST['winner']==1)?'completed':'finished',
         "cimage"=>$imageResult
    );

    $id = $obj->insert();
    if($id):
       $etype = $_POST['election_type'];
       $egroup  = (isset($_POST['group_type']) && $_POST['group_type']>0)?$_POST['group_type']:'0';
       $eprovince = $_POST['province_id'];
       $edistrict = $_POST['district_id'];
       $econstituency = $_POST['constituency_id'];
     $res_check_data = $obj->db->query("select * from election_display where election_type='$etype' and province='$eprovince' and district='$edistrict' and const='$econstituency' and group_id='$egroup'");
      if($res_check_data->rowCount()==0):
        $obj->tbl = "election_display";
        $obj->val = array(
        "election_type"=>$etype,
        "province"=>$eprovince,
        "district"=>$edistrict,
        "const" => $econstituency,
        "group_id" => $egroup
    );
       $id = $obj->insert();
      endif;
      endif;
    Page_finder::set_message("Data successfully Added.", 'success');
    $obj->redirect('?page=candidate');
}

if (isset($_GET['delete']) && $_GET['delete'] != "") {
    $id = (int) $_GET['delete'];
    $obj->cond = array('uin' => $id);
    $obj->delete();
    Page_finder::set_message("Data Successfully Deleted", 'success');
    $obj->redirect('?page=candidate');
}
?>