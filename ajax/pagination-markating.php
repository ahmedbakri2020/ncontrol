<?php
include '../../system/application_top.php';

$page = (int) $_POST['page'];
$perPage = (int) $_POST['perPage'];
if ($page == 1) {
    $start = 0;
} else {
    $start = ($page - 1) * $perPage;
}

    $query = $obj->select("tbl_markating", "*",NULL,array("cat01id"=>"desc"), array($start, $perPage));
    $count = $obj->countRow($obj->select("tbl_markating", "cat01id"));

$c=1;
$numPage = ceil($count / $perPage);
$newslist = '';
if($query->rowCount()>0){
    while ($data = $query->fetch()):
        $newslist .= '<tr>
    <th>'.$c.'</th>
    <td>' . $data['m01fullname'] . '</td>  
    <td>' . $data['m01email'] . '</td>   
    <td>' . $data['m01post'] . '</td>
    <td><a href="?fol=form&page=add_markat&action=edit&id=' . $data['cat01id'] . '" title="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Edit</a>
      <a href="?fol=actpages&page=act_adedmarket&delete='.$data['cat01id'].'" title="" class="btn btn-danger btn-xs" onclick="return confirm(\'Delete / Uninstall cannot be undone! Are you sure you want to do this?\')"><i class="fa fa-close"></i>Delete</a></td>
</tr>';
        $c++;
    endwhile;
    $newslist .= '</tbody>';
}else{
    $newslist.='No Result Found!!';
}
echo json_encode(array("result" => $newslist, "numPage" => $numPage, "total_data" => $count));
