<?php
if($_GET['delete'] && $_GET['delete']!=""){
    $msg = "";
    $id =   (int)$_GET['delete'];
    $get_row = $obj->getDataByField("u01user",'uin',$id);
    if($get_row['u01image']!=""){
        $image = UPLOADS.'users/'.$get_row['u01image'];
        $thumb = UPLOADS.'thumbs/'.$get_row['u01image'];

       // unlink($image);
       // unlink($thumb);
    }

    $obj->tbl = "u01user";;
    $obj->cond = array('uin'=>$id);
    $obj->delete();

    $msg .= "User Successfully Deleted";
    $url = '?page=user';
}

$obj->alert($msg, $url);

?>