<?php
include "../../system/application_top.php";
if(isset($_POST['id'])&& $_POST['id']!=""){
    if(isset($_POST['of'])&&$_POST['of']=="page"){
        $result = $obj->select("tbl_site",'*',array("cat01id"=>$_POST['id']));
        if($result->rowCount()){
            $row = $result->fetch();
            $image_name = $row['hlogo'];
            unlink("../../uploads/logo/".$image_name);
            unlink("../../uploads/logo/thumbs/".$image_name);

            $obj->tbl = "tbl_site";
            $obj->val = array("hlogo"=>"");
            $obj->cond = array("cat01id"=>$_POST['id']);
            $obj->update();
            echo json_encode(array("status"=>1));
        }else{
            echo json_encode(array("status"=>0));
        }

    }elseif(isset($_POST['of'])&&$_POST['of']=="footer"){
        $result = $obj->select("tbl_site",'*',array("cat01id"=>$_POST['id']));
        if($result->rowCount()){
            $row = $result->fetch();
            $image_name = $row['flogo'];
            unlink("../../uploads/logo/".$image_name);
            unlink("../../uploads/logo/thumbs/".$image_name);

            $obj->tbl = "tbl_site";
            $obj->val = array("flogo"=>"");
            $obj->cond = array("cat01id"=>$_POST['id']);
            $obj->update();
            echo json_encode(array("status"=>1));
        }else{
            echo json_encode(array("status"=>0));
        }

    }elseif(isset($_POST['of'])&&$_POST['of']=="category"){
        $result = $obj->select("n02news_cat",'*',array("cat01id"=>$_POST['id']));
        if($result->rowCount()){
            $row = $result->fetch();
            $image_name = $row['cat_image'];
            unlink("../../uploads/category/".$image_name);
            unlink("../../uploads/category/thumbs/".$image_name);

            $obj->tbl = "n02news_cat";
            $obj->val = array("cat_image"=>"");
            $obj->cond = array("cat01id"=>$_POST['id']);
            $obj->update();
            echo json_encode(array("status"=>1));
        }else{
            echo json_encode(array("status"=>0));
        }

    }
}