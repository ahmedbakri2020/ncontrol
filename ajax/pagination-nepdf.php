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
    $query = $obj->select("epaper_new_pdf", "*", array("e01type" => $cat), array("paper_date" => "desc"), array($start, $perPage));
    $query->execute();
    $count = $obj->countRow($obj->select("epaper_new_pdf", "eid"));
} else {
    $query = $obj->select("epaper_new_pdf", "*",NULL,array("paper_date"=>"desc"), array($start, $perPage));
    $count = $obj->countRow($obj->select("epaper_new_pdf", "eid"));
}

$c=1;
$numPage = ceil($count / $perPage);
$newslist = '';
if($query->rowCount()>0){
    while ($data = $query->fetch()):
        // var_dump($data);
        $newslist .= '<tr>
    <th>'.$c.'</th>
    <td>' . $data['epaper_name'] . '</td>  
  
    <td><a href="?fol=form&page=add_nepdf&action=edit&id=' . $data['eid'] . '" title="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Edit</a>
      <a href="?fol=actpages&amp;page=act_adednewepdf&delete='.$data['eid'].'" title="" class="btn btn-danger btn-xs" onclick="return confirm(\'Delete / Uninstall cannot be undone! Are you sure you want to do this?\')"><i class="fa fa-close"></i>Delete</a></td>
</tr>';
        $c++;
    endwhile;
    $newslist .= '</tbody>';
}else{
    $newslist.='No Result Found!!';
}
echo json_encode(array("result" => $newslist, "numPage" => $numPage, "total_data" => $count));
