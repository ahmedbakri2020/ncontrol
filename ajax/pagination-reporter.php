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
    $query = $obj->select("tbl_author","*",array("type"=>"$cat","s_order"=>"asc"),array($start,$perPage));
    $query->execute();
    $count = $obj->countRow($obj->select("tbl_author", "uin"));
} else {
    $query = $obj->select("tbl_author", "*",NULL,array("s_order"=>"asc"), array($start, $perPage));
    $count = $obj->countRow($obj->select("tbl_author", "cat01id"));
}

$c=1;
$numPage = ceil($count / $perPage);
$newslist = '';
if($query->rowCount()>0){
    while ($data = $query->fetch()):
        $newslist .= '<tr id="' . $data['cat01id'] . '">
          <td><span></span></td>
    <th>'.$c.'</th>
    <td>' . $data['cat01category'] . '</td>  
        <td>' . $data['fb'] . '</td>
            <td>' . $data['twitter'] . '</td> 
            <td>
                       ' . (($data['status'] == 0) ? '<a href="#"><img src="assets/images/publish_small.png" align="published" onclick="change_status(' . $data['cat01id'] . ',1,\'status\',\'tbl_author\',\'reporter\' )" /></a>' : '<a href="#"><img src="assets/images/unpublish_small.png" align="published" onclick="change_status(' . $data['cat01id'] . ',0,\'status\',\'tbl_author\',\'reporter\' )" /></a> ') . '
                        </td>
   
    <td><a href="?fol=form&page=add-reporter&action=edit&id=' . $data['cat01id'] . '&type='.$data['g01type'].'" title="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Edit</a>
      <a href="?fol=actpages&amp;page=act_adedreporter&delete='.$data['cat01id'].'&type='.$data['g01type'].'" title="" class="btn btn-danger btn-xs" onclick="return confirm(\'Delete / Uninstall cannot be undone! Are you sure you want to do this?\')"><i class="fa fa-close"></i>Delete</a></td>
</tr>';
        $c++;
    endwhile;
    $newslist .= '</tbody>';
}else{
    $newslist.='No Result Found!!';
}
echo json_encode(array("result" => $newslist, "numPage" => $numPage, "total_data" => $count));
