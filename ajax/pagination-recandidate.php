<?php
include '../../system/application_top.php';
$page = (int) $_POST['page'];
$perPage = (int) $_POST['perPage'];
if ($page == 1) {
    $start = 0;
} else {
    $start = ($page - 1) * $perPage;
}

if (isset($_POST['filter'])) {
    $cond = '';
    if ($_POST['election_type'] != "") {
        $cond .= 'election_type=' . (int) $_POST['election_type'] . ' and';
    }if ($_POST['district_id'] != "") {
        $cond .= ' district_id=' . (int) $_POST['district_id'] . ' and';
    }if ($_POST['constituency_id'] != "") {
        $cond .= ' constituency_id=' . (int) $_POST['constituency_id'] . ' and';
    } if ($_POST['party_id'] != "") {
        $cond .= ' party_id=' . (int) $_POST['party_id'] . ' and';
    }if ($_POST['province_id'] != "") {
        $cond .= ' province_id=' . (int) $_POST['province_id'] . '';
    }

    $last_word = substr($cond, strrpos($cond, ' ') + 1);
    if ($last_word == 'and') {
        $condition = preg_replace('/\W\w+\s*(\W*)$/', '$1', $cond);
    } else {
        $condition = $cond;
    }

    $query = $obj->db->query("select * from recandidates where $condition limit " . $start . ", " . $perPage . " ");
    $count = $obj->countRow($obj->db->query("select * from recandidates where $condition"));
     $displayRecords = $obj->countRow($query);
} elseif (isset($_POST['search'])) {
    $searchid = $obj->StringInputCleaner($_POST['search']);
    $query = $obj->db->query("select * from recandidates where name like '$searchid%' limit " . $start . ", " . $perPage . "");
    $count = $obj->countRow($obj->db->query("select * from recandidates where name like '%$searchid%' "));
     $displayRecords = $obj->countRow($query);
} else {
    $query = $obj->select('recandidates', "*", NULL, array('vote_count'=>'desc'), array($start, $perPage));
    $count = $obj->countRow($obj->select("recandidates", "uin"));
     $displayRecords = $obj->countRow($query);
}


$sn = 1;
$numPage = ceil($count / $perPage);
$newslist = '';
if ($query->rowCount() > 0) {
   
    while ($row = $query->fetch()):
        $party = $obj->getDataByField('tbl_party', 'uin', $row['party_id']);
        $district = $obj->getDataByField('districts', 'uin', $row['district_id']);
        $pradesh = $obj->getDataByField('pradesh', 'uin', $row['province_id']);
        $election_type = ($row['election_type']=='1')?'प्रतिनिधि सभा':'प्रदेश सभा';
        $group = (($row['group_type'] == "1") ? '(क)' : ''.(($row['group_type'] == "2") ? '(ख)' : ''));
        $constituency = $obj->getDataByField('constituency', 'cat01id', $row['constituency_id']);
     $newslist .= '<tr>
                        <th>' . $sn . '</th>   
                         <td>' .$election_type. '</td>
                        <td><img src="' . UPLOADS . 'election/thumbs/' . $party['image'] . '" /></td>
                        <td>' . $row['name'] . ' '.(($row['cimage']!="")?'<img class="candi-image" src="' . UPLOADS . 'candidate/thumbs/' . $row['cimage'] . '" />':'').'</td>
                        <td>' . $pradesh['cat01category'] . '</td>
                        <td>' . $district['district_name'] . '</td>
                        <td>' . $constituency['cat01category'].' '.$group.'</td>
                        <td>
                          <input type="text" name="vote" value="' . $row['vote_count'] . '" id="' . $row['uin'] . '" />
                          <input type="button" id="update_vote" onclick="updateVote(' . $row['uin'] . ',)" value="Update">
                           <span id="spinner' . $row['uin'] . '"></span>
                         </td>
                           <td>
                           <select id="change_status" class="form-control">
                           <option data-id="'.$row['uin'].'" value="0">--Choose--</option>
                            <option data-id="'.$row['uin'].'" value="1" '.(($row['winner']==1)?'selected':'').'>बिजय</option>
                             <option data-id="'.$row['uin'].'" value="2" '.(($row['winner']==2)?'selected':'').'>पराजय</option>
                           </select>
                        </td>
                      
                          <td>
                          <a href="index.php?fol=form&page=add-recandidates&id=' . $row['uin'] . '"class="btn btn-primary"><i class="fa fa-edit"></i></a>
                          <a href="index.php?fol=actpages&page=act_recandidates&delete=' . $row['uin'] . '" onclick="return confirm(\'Delete / Uninstall cannot be undone! Are you sure you want to do this?\')"  class="btn btn-danger"><i class="fa fa-trash" ></i></a>
                        </td>
                         
                        
                        
                    </tr>';

        $sn++;
         
    endwhile;
  

}else {
    $newslist .= 'No Result Found';
}

$json_arr = array("result" => $newslist, "numPage" => $numPage, "total_count" => $count, "showing_count" => $displayRecords);


$result = json_encode($json_arr, JSON_UNESCAPED_UNICODE);

if ($result != "") {
    echo $result;
} else {
    echo 'error';
}
