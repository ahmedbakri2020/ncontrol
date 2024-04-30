<?php
include('../../system/application_top.php');
if(isset($_POST['id'])){
       $id = (int)$_POST['id'];
       $row_cat = $obj->getDataByField("ad_cat","cat01id",$id);
       echo $row_cat['details'];
}