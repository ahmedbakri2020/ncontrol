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
    $count = $obj->countRow($obj->select("u01user", "uin", array("role" => $cat)));
} else {
    $query = $obj->select("u01user", "*", "uin not in(1,2,3)", NULL, array($start, $perPage));
    $count = $obj->countRow($obj->select("u01user", "uin", "uin not in(1,2,3)"));
}

$numPage = ceil($count / $perPage);
$newslist = '';
if($query->rowCount()>0){
    while ($user = $query->fetch()):
        //$role = $obj->getDataByField('user_cat', 'cat01id', $user['role']);
        //$news = $obj->getAllDataByField(NEWS, 'user_id', $user['uin']);
     
        $newslist .= '<tr>
    <th><input type="checkbox" id="check1" value="check1"></th>
    <td>' . $user['u01fullname'] . '</td>  
    <td>' . $user['u01username'] . '</td>
    <td>' . $user['u01email'] . '</td>
    <td>
                       ' . (($user['status'] == 0) ? '<a href="#"><img src="assets/images/publish_small.png" align="published" onclick="change_status(' . $user['uin'] . ',1,\'status\',\'u01user\',\'normal\' )" /></a>' : '<a href="#"><img src="assets/images/unpublish_small.png" align="published" onclick="change_status(' . $user['uin'] . ',0,\'status\',\'u01user\',\'normal\' )" /></a> ') . '
                        </td>
    <td><a href="?fol=form&page=add-user&action=edit&id=' . $user['uin'] . '" title="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Edit</a>
        <a href="?fol=actpages&amp;page=act_user_delete&delete=' . $user['uin'] . '" onclick="return confirm(\'Delete / Uninstall cannot be undone! Are you sure you want to do this?\')" title="" class="btn btn-danger btn-xs"><i class="fa fa-close"></i>Delete</a></td>
</tr>';
    endwhile;
}else{
    $newslist.='No Result Found';
}
echo json_encode(array("result" => $newslist, "numPage" => $numPage, "total_data" => $count));
