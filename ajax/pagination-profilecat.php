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
    $query = $obj->select("p02prof_cat","*",array("cat01id"=>"desc"),array($start,$perPage));
    $query->execute();
    $count = $obj->countRow($obj->select("p02prof_cat", "cat01id"));
} else {
    $query = $obj->select("p02prof_cat", "*",NULL,array("cat01id"=>"desc"), array($start, $perPage));
    $count = $obj->countRow($obj->select("p02prof_cat", "cat01id"));
}

$c=1;
$numPage = ceil($count / $perPage);
$newslist = '';
if($query->rowCount()>0){
while ($data = $query->fetch()):
    $newslist .= '<tr>
    <th>'.$c.'</th>
    <td>' . $data['cat01category'] . '</td> '; 
  
       $newslist .='<td><select onchange="return change_AdOrder(' . $data['cat01id'] . ',this.value,\'s_order\',\'p02prof_cat\',\'normal\')">';

        for ($i = 1; $i <= $count; ++$i) {
            $newslist .='<option value="' . $i . '" ' . (($data['s_order'] == $i) ? "selected" : "") . '>' . $i . '</option>';
        }
        $newslist .='</select></td>';
   $newslist.=' <td><a href="?fol=form&page=add-profilecat&id=' . $data['cat01id'] . '&type='.$data['g01type'].'" title="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Edit</a>
      <a href="?fol=actpages&amp;page=act_profilecat&delete='.$data['cat01id'].'&type='.$data['g01type'].'" title="" class="btn btn-danger btn-xs" onclick="return confirm(\'Delete / Uninstall cannot be undone! Are you sure you want to do this?\')"><i class="fa fa-close"></i>Delete</a></td>
</tr>';
$c++;
endwhile;
$newslist .= '</tbody>';
}else{
    $newslist.='No Result Found!!';
}
echo json_encode(array("result" => $newslist, "numPage" => $numPage, "total_data" => $count));
