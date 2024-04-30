<?php
$obj->tbl = "election_display";
if($_POST['action'] == "add") {
         $etype = $_POST['election_type'];
                $edistrict = $_POST['district_id'];
                $econst = $_POST['constituency_id'];
                $egroup_id = $_POST['group_id'];
                $eproid = $_POST['province_id'];
            $res_check_data = $obj->db->query("select * from election_display where election_type='$etype' and province='$eproid' and district='$edistrict' and const='$econst' and group_id='$egroup_id'");
          if($res_check_data->rowCount()==0):
            $obj->val = array(
                "election_type" => $_POST['election_type'],
                "district" =>$_POST['district_id'],
                "const" =>$_POST['constituency_id'],
                "group_id"=>$_POST['group_id'],
                 "province"=>$_POST['province_id']
                );
            $obj->insert();
            endif;
    Page_finder::set_message("Data Successfully Added", 'success');
    $obj->redirect('?page=election_display');
}elseif($_GET['action']=='delete' && $_GET['id']!=""){
$id = (int) $_GET['id'];
$obj->cond = array("uin" => $id);
$obj->delete();
    Page_finder::set_message("Data Successfully Deleted", 'danger');
    $obj->redirect('?page=election_display');
}