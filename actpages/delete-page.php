<?php
switch ($_GET['ad']){
    case 'news': $table=ADVERTISE; $img_src = UPLOADS.'advertise/'; $thumb = UPLOADS.'advertise/thumbs/'; 
    break;
    case  'photo': $table='';
}

$obj->tbl = $table;
$obj->val = array('uin'=>$id);
$obj->insert();