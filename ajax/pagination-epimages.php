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
    $query = $obj->select("epaper_images", "*", array("pdf_id" => $cat), array("post_order"=>"asc","posted_date" => "desc"), array($start, $perPage));
    $query->execute();
    $count = $obj->countRow($obj->select("epaper_images", "uin",array("pdf_id"=>$cat)));
} else {
    $query = $obj->select("epaper_images", "*",NULL,array("paper_date"=>"desc"), array($start, $perPage));
    $count = $obj->countRow($obj->select("epaper_images", "uin"));
}

$c=1;
$numPage = ceil($count / $perPage);
$newslist = '';
if($query->rowCount()>0){
    while ($data = $query->fetch()):
        // var_dump($data);
        $newslist .= '<tr id="'.$data['uin'].'">
        <td><span></span></td>
    <th>'.$c.'</th>
    
    <td>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal'.$data['uin'].'">
  Preview Image
</button>


<div class="modal fade" id="exampleModal'.$data['uin'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">Close</button>
    </div>
      
      <div class="modal-body">
        <img src="'.SITE_URL.'uploads/paper/images/'.$data['image'].'"/>
      </div>
      
    </div>
  </div>
</div>
    </td>  
    <td>' . $data['posted_date'] . '</td>  
    <td>
        <a href="?fol=actpages&amp;page=act_epaperimg&delete=' . $data['uin'] . '&pid=' . $data['pdf_id'] . '" title="" class="btn btn-danger btn-xs" onclick="return confirm(\'Delete / Uninstall cannot be undone! Are you sure you want to do this?\')"><i class="fa fa-close"></i>Delete</a>
    </td>
  
      
</tr>';
        $c++;
    endwhile;
    $newslist .= '</tbody>';
}else{
    $newslist.='No Result Found!!';
}
echo json_encode(array("result" => $newslist, "numPage" => $numPage, "total_data" => $count));
