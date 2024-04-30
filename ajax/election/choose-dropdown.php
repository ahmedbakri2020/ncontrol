<?php
include('../../../system/application_top.php');

if (isset($_POST['action']) && $_POST['action']=='province') {
 $pro_id = $_POST['provinceId'];
 $query = $obj->select('districts', "*", array('province_id'=>$pro_id), array("uin" => "asc"));
 if ($query->rowCount() > 0) {
while ($row = $query->fetch()):
 echo '  <li>
                                        <div class="checkbox">
                                            <label>
                                                <input type="radio" name="district_id" value="'.$row['uin'].'"> '.$row['district_name'].'
                                            </label>
                                        </div>
                                    </li>';
 endwhile;
 } else {
 echo 'District Not Avilable';
 }
}
if (isset($_POST['action']) && $_POST['action']=='searchprovince') {
 $pro_id = $_POST['provinceId'];
 $query = $obj->select('districts', "*", array('province_id'=>$pro_id), array("uin" => "asc"));
 if ($query->rowCount() > 0) {
      echo '<option value="">--जिल्ला--</option>';
while ($row = $query->fetch()):
 echo ' <option value="'.$row['uin'].'">'.$row['district_name'].'</option>';
 endwhile;
 } else {
 echo 'District Not Avilable';
 }
}
?>
