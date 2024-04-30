<?php
include '../../system/application_top.php';

$page = (int) $_POST['page'];
$perPage = (int) $_POST['perPage'];
if ($page == 1) {
    $start = 0;
} else {
    $start = ($page - 1) * $perPage;
}

if (isset($_POST['category'])) {
    $cat = (int) $_POST['category'];
    $query = $obj->db->query("select * from u01user where role=$cat and uin not in(1,2,3) limit  $start,$perPage");
    $query->execute();
    $count = $obj->countRow($obj->select("users", "uin", array("role" => $cat)));
} else {
    $query = $obj->select("users", "*", "", NULL, array($start, $perPage));
    $count = $obj->countRow($obj->select("users", "uin"));
}

$numPage = ceil($count / $perPage);
$newslist = '';
if($query->rowCount()>0){
    while ($user = $query->fetch()):
        $newslist .= '<tr>
    <th><input type="checkbox" id="check1" value="check1"></th>
    <td>' . $user['fullname'] . '</td>  
    <td>' . $user['username'] . '</td>
    <td>' . $user['email'] . '</td>
    <td>' . $user['last_login'] . '</td>
   
   
</tr>';
    endwhile;
}else{
    $newslist.='No Result Found';
}
echo json_encode(array("result" => $newslist, "numPage" => $numPage, "total_data" => $count));
