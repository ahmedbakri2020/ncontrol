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
    $query = $obj->select("tbl_images","*",array("type"=>$cat),array("uin"=>"desc"),array($start,$perPage));
    $query->execute();
    $count = $obj->countRow($obj->select("tbl_images", "uin", array("type" => $cat)));
} else {
    $query = $obj->select("tbl_images", "*",NULL,array("uin"=>"desc"), array($start, $perPage));
    $count = $obj->countRow($obj->select("tbl_images", "uin"));
}

$c=1;
$numPage = ceil($count / $perPage);
$newslist = '';
if($query->rowCount()>0){
   $newslist .='<thead>
                    <tr class="active">
                        <th><input type="checkbox" id="check-all" value="check-all"></th>
                        <th>Title</th>

                        <th>Image</th>
                        <th>Posted Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="">';
while ($data = $query->fetch()):
    $newslist .= '<tr>
    <th>'.$c.'</th>
    <td>' . $data['caption'] . '</td>  
  
    <td> <img src="' .UPLOADS.'images/thumbs/'. $data['image'] . '" /></td> 
    <td>' . $data['posted_on'] . '</td>
    <td><a href="?fol=form&page=add-images&action=edit&id=' . $data['uin'] . '&type='.$data['type'].'" title="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Edit</a>
        <a href="?fol=actpages&amp;page=act_adedimage&delete='.$data['uin'].'&type='.$data['type'].'" title="" class="btn btn-danger btn-xs"><i class="fa fa-close"></i>Delete</a></td>
</tr>';
$c++;
endwhile;
$newslist .= '</tbody>';
}else{
    $newslist.='No Result Found!!';
}
echo json_encode(array("result" => $newslist, "numPage" => $numPage, "total_data" => $count));

