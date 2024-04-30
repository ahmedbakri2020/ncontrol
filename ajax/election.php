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
    $query = $obj->db->query("select * from election_display where election_type='$cat' order by sorts asc limit $start,$perPage");
    $count = $obj->countRow($obj->select('election_display', "uin", array("election_type" => $cat)));
}else{
    $query = $obj->db->query("select * from election_display order by sorts asc limit $start,$perPage");
    $count = $obj->countRow($obj->select('election_display', "uin"));
}

$sn = 1;
$numPage = ceil($count / $perPage);
$newslist = '';
if ($query->rowCount() > 0) {

    while ($row = $query->fetch()):
        $district=$obj->getDataByField('districts','uin',$row['district']);
        $const=$obj->getDataByField('constituency','cat01id',$row['const']);
        $newslist .='<tr id="'.$row['uin'].'">
                                <td><span></span></td>
                                <td>'.(($row['election_type'] == "1") ? 'प्रतिनिधि सभा' : ''.(($row['election_type'] == "2") ? 'प्रदेश सभा' : '')).'</td>
                                 <td>'.$district['district_name'].'</td>
             <td>'.$const['cat01category'].' '.(($row['election_type'] == "2" && $row['group_id']==1) ? '(क)' : ''.(($row['election_type'] == "2" && $row['group_id']==2) ? '(ख)':'')).'</td>
                               
                                
                                <td>
                                  <a href="index.php?fol=actpages&page=act_display_election&action=delete&id='.$row['uin'].'"class="btn btn-primary"><i class="fa fa-trash"></i></a>
                                </td>

                            </tr>';

        $sn++;
    endwhile;
}else {
    $newslist.='No Result Found';
}
$json_arr = array("newsList" => $newslist, "numPage" => $numPage, "count" => $count);

$result = json_encode($json_arr);

if ($result != "") {
    echo $result;
} else {
    echo 'error';
}
