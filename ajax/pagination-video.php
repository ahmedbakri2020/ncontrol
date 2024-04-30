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
    $query = $obj->select(VIDEO, "*", array("v01type" => $cat), array("uin" => "desc"), array($start, $perPage));
    $query->execute();
    $count = $obj->countRow($obj->select(VIDEO, "uin", array("v01type" => $cat)));
} else {
    $query = $obj->select(VIDEO, "*", NULL, array("uin" => "desc"), array($start, $perPage));
    $count = $obj->countRow($obj->select(VIDEO, "uin"));
}

$numPage = ceil($count / $perPage);
$newslist = '';
if ($query->rowCount() > 0) {
    $newslist .='<thead>
                    <tr class="active">
                        <th><input type="checkbox" id="check-all" value="check-all"></th>
                        <th>Title</th>
                        <th>Video Link</th>
                        <th>Posted 0n</th>
                        <th>Total Count</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="">';
    while ($data = $query->fetch()):
        $newslist .= '<tr>
    <th><input type="checkbox" id="check1" value="check1"></th>
    <td>' . $data['v01title'] . '</td>       
    <td> <a href="https://www.youtube.com/watch?v=' . $data['v01code'] . '" target="_blank">Go</a></td> 
    <td>' . $data['posted_on'] . '</td>   
    <td>' . $data['viewed'] . '</td>
    <td><a href="?fol=form&page=add-video&action=edit&id=' . $data['uin'] . '&type=' . $data['v01type'] . '" title="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Edit</a>
        <a href="?fol=actpages&amp;page=act_adedvideo&delete=' . $data['uin'] . '&type=' . $data['v01type'] . '" title="" class="btn btn-danger btn-xs"><i class="fa fa-close"></i>Delete</a></td>
</tr>';
    endwhile;
    $newslist .= '</tbody>';
}else {
    $newslist.='No Result Found!!';
}
echo json_encode(array("result" => $newslist, "numPage" => $numPage, "total_data" => $count));
