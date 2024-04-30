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
    $query = $obj->select(GALLERY,"*",array("g01type"=>$cat),array("uin"=>"desc"),array($start,$perPage));
    $query->execute();
    $count = $obj->countRow($obj->select(GALLERY, "uin", array("g01type" => $cat)));
} else {
    $query = $obj->select(GALLERY, "*",NULL,array("uin"=>"desc"), array($start, $perPage));
    $count = $obj->countRow($obj->select(GALLERY, "uin"));
}
$c=1;
$numPage = ceil($count / $perPage);
$newslist = '';
if($query->rowCount()>0){
   $newslist .='<thead>
                    <tr class="active">
                        <th>Sn.</th>
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
    <td>' . $data['g01title'] . '</td>     
    <td> <img src="' .UPLOADS.'images/thumbs/'. $data['g01image'] . '" /></td> 
    <td>' . $data['posted_on'] . '</td>
    <td>
        <a href="?page=view-gallery&type=' . $data['uin'] . '" title="" class="btn btn-success btn-xs"><i class="fa fa-edit"></i>Add more</a>
        <a href="?fol=form&page=add-photo&action=edit&id=' . $data['uin'] . '&type='.$data['g01type'].'" title="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Edit</a>
        <a href="?fol=actpages&amp;page=act_adedgallery&delete='.$data['uin'].'&type='.$data['g01type'].'" title="" class="btn btn-danger btn-xs"><i class="fa fa-close"></i>Delete</a></td>
</tr>';
$c++;
endwhile;
$newslist .= '</tbody>';
}else{
    $newslist.='No Result Found!!';
}
echo json_encode(array("result" => $newslist, "numPage" => $numPage, "total_data" => $count));
