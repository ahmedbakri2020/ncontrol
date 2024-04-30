<?php

include '../../system/application_top.php';

$page = (int) $_POST['page'];
$perPage = (int) $_POST['perPage'];
if ($page == 1) {
    $start = 0;
} else {
    $start = ($page - 1) * $perPage;
}

if (isset($_POST['level'])) {
    $level = (int) $_POST['level'];
    $cid = (int) $_POST['cid'];
    $query = $obj->select(ADVERTISE, "*", array("level" => $level), array("uin" => "desc"), array($start, $perPage));
    $count = $obj->countRow($obj->select(ADVERTISE, "uin", array("level" => $level)));
} elseif (isset($_POST['category'])) {
    $cat = (int) $_POST['category'];
    $cid = (int) $_POST['cid'];
    //var_dump($cid);
    $query = $obj->select(ADVERTISE, "*", array("cat_id" => $cat), array("uin" => "desc"), array($start, $perPage));
    $query->execute();
    $count = $obj->countRow($obj->select(ADVERTISE, "uin", array("cat_id" => $cat)));
} else {
    $query = $obj->select(ADVERTISE, "*", NULL, array("uin" => "desc"), array($start, $perPage));
    $count = $obj->countRow($obj->select(ADVERTISE, "uin"));
}

$numPage = ceil($count / $perPage);
$newslist = '';
$sn = 1;
if ($query->rowCount() > 0) {
    $newslist .='<thead>
                <tr class="active">
                    <th>' . $sn . '</th>
                    <th>Name</th>
                    <th>Preview</th>
                    <th>Position</th>
                    ';
    if (isset($_POST['level'])): $newslist .=' <th>Level</th>';
    endif;
    $newslist .=' 
            <th>Url</th>             
                    <th>Ordering</th>
                   
                    <th>Show(web)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="">';
    while ($data = $query->fetch()):
        $level = $obj->getDataByField('tbl_adlevel', 'cat01id', $data['level']);
        $cat = $obj->getDataByField('ad_cat', 'cat01id', $data['cat_id']);

        $newslist .= '<tr>
        <th>' . $sn . '</th>
        <td>' . $data['a01title'] . '</td>
         <td> ' . (($data['m01image'] != "") ? '<img src="' . UPLOADS . 'advertise/thumbs/' . $data['m01image'] . '" alt="preview" />' : ' ' . (($data['a01image'] != "") ? '<img src="' . UPLOADS . 'advertise/thumbs/' . $data['a01image'] . '" alt="preview" />' : '') . ' ' ) . '  
           </td>
       
         <td>' . $cat['cat01category'] . '</td>';
        if (isset($_POST['level'])): $newslist .='<td>' . $level['cat01category'] . '</td> ';
        endif;

        $newslist .='  <td> <a href="' . $data['a01url'] . '" target="_blank">Go</a></td>
        <td><select onchange="return change_AdOrder(' . $data['uin'] . ',this.value,\'position\',\'a01ad\',\'normal\')">';

        for ($i = 1; $i <= $count; $i++) {
            $newslist .='<option value="' . $i . '" ' . (($data['position'] == $i) ? "selected" : "") . '>' . $i . '</option>';
        }
        $newslist .='</select></td>';

        $newslist .='
          
           <td>
        ' . (($data['display_ad'] == 1) ? '<a href="#"><img src="assets/images/publish_small.png" align="published" onclick="change_status(' . $data['uin'] . ',0,\'display_ad\',\'a01ad\',\'normal\' )" /></a>' : '<a href="#"><img src="assets/images/unpublish_small.png" align="published" onclick="change_status(' . $data['uin'] . ',1,\'display_ad\',\'a01ad\',\'normal\' )" /></a> ') . '
         </td>
         
        <td><a href="?fol=form&page=add-advertisement&action=edit&id=' . $data['uin'] . '&cid=' . $data['uin'] . '&cat=' . $data['cat_id'] . '" title="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Edit</a>
            <a href="?fol=actpages&amp;page=act_adedad&delete=' . $data['uin'] . '&cid=' . $data['uin'] . '&cat=' . $data['cat_id'] . '" title="delete" class="btn btn-danger btn-xs" onclick="return confirm(\'Delete / Uninstall cannot be undone! Are you sure you want to do this?\')"><i class="fa fa-close"></i>Delete</a></td>
    </tr>
        ';
        $sn++;
    endwhile;
    $newslist .= '</tbody>';
} else {
    $newslist.='No Result Found!!';
}
echo json_encode(array("result" => $newslist, "numPage" => $numPage, "total_data" => $count));
