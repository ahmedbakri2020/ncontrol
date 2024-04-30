<?php

include '../../system/application_top.php';

$page = (int) $_POST['page'];
$perPage = (int) $_POST['perPage'];
if ($page == 1) {
    $start = 0;
} else {
    $start = ($page - 1) * $perPage;
}

$query = $obj->select("poll_quest", "*", NULL, array("uin" => "desc"), array($start, $perPage));
$count = $obj->countRow($obj->select("poll_quest", "uin"));
$numPage = ceil($count / $perPage);
$newslist = '';
if ($query->rowCount() > 0) {
    $newslist .='<thead>
                    <tr class="active">
                        <th><input type="checkbox" id="check-all" value="check-all"></th>
                        <th>Question</th>                        
                        <th>Updated On</th>                       
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="">';
    while ($data = $query->fetch()):
        $newslist .= '<tr>
    <th><input type="checkbox" id="check1" value="check1"></th>
    <td>' . $data['ques'] . '</td>      
    <td>' . $data['update_time'] . '</td>   
   
    <td><a href="?fol=form&page=add-poll&action=edit&id=' . $data['uin'] . '" title="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Edit</a>
        <a href="?fol=actpages&amp;page=act_adedpoll&delete=' . $data['uin'] . '" title="" class="btn btn-danger btn-xs"><i class="fa fa-close"></i>Delete</a></td>
</tr>';
    endwhile;
    $newslist .= '</tbody>';
}else {
    $newslist.='No Result Found!!';
}
echo json_encode(array("result" => $newslist, "numPage" => $numPage, "total_data" => $count));
