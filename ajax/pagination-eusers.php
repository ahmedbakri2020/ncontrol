<?php
include '../../system/application_top.php';

$page = (int) $_POST['page'];
$perPage = (int) $_POST['perPage'];
if ($page == 1) {
    $start = 0;
} else {
    $start = ($page - 1) * $perPage;
}


    $query = $obj->select("epaper_user", "*", "", array('uin' =>'desc'), array($start, $perPage));
    $count = $obj->countRow($obj->select("epaper_user", "uin"));

$numPage = ceil($count / $perPage);
$newslist = '';
if($query->rowCount()>0){
    while ($user = $query->fetch()):
        //$role = $obj->getDataByField('user_cat', 'cat01id', $user['role']);
        //$news = $obj->getAllDataByField(NEWS, 'user_id', $user['uin']);
     
        $newslist .= '<tr>
    <th><input type="checkbox" id="check1" value="check1"></th>
    <td>' . $user['fullname'] . '</td> 
    <td>' . $user['text_password'] . '</td> 
    <td>' . $user['email'] . '</td>
     <td>' . $user['source'] . '</td>
    </tr>';
    endwhile;
}else{
    $newslist.='No Result Found';
}
echo json_encode(array("result" => $newslist, "numPage" => $numPage, "total_data" => $count));
