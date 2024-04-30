<?php
include('../../../system/application_top.php');

if (isset($_POST['provinceId']) && !empty($_POST['provinceId'])) {
 $pro_id = $_POST['provinceId'];
 $query = $obj->select('cat01category', "*", array('pradesh_id'=>$pro_id), array("cat01id" => "asc"));
 if ($query->rowCount() > 0) {
 echo '<option value="">------जिल्ला छान्नुहोस------</option>';
 while ($row = $query->fetch()):
 echo '<option value="'.$row['cat01id'].'">'.$row['cat01category'].'</option>';
 endwhile;
 } else {
 echo '<option value="">District not available</option>';
 }
} elseif(isset($_POST['districtId']) && !empty($_POST['districtId'])) {
 $dis_id = $_POST['districtId'];
 $query = $obj->select('area_subdivision', "*", array('cid'=>$dis_id), array("aid" => "asc"));
 if ($query->rowCount() > 0) {
 echo '<option value="">--Local Level</option>';
 while ($row = $query->fetch()) {
 echo '<option value="'.$row['aid'].'">'.$row['address'].'</option>';
 }
 } else {
 echo '<option value="">local Level not available</option>';
 }
}
elseif(isset($_POST['localId']) && !empty($_POST['localId'])) {
 $dis_id = $_POST['localId'];
 $query = $obj->select('ward', "*", array('local_id'=>$dis_id), array("uin" => "asc"));
 if ($query->rowCount() > 0) {
 echo '<option value="">--Ward--</option>';
 while ($row = $query->fetch()) {
 echo '<option value="'.$row['uin'].'">'.$row['ward'].'</option>';
 }
 } else {
 echo '<option value="">ward Not Avilable</option>';
 }
}
?>