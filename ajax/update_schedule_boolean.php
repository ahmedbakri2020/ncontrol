<?php
include '../../system/application_top.php';
$curDate =  date('Y-m-d H:i:s');
$res_true_date  = $obj->select(NEWS,"mytime,uin",array("scheduled"=>1));
while($row_true_data = $res_true_date->fetch()):
$scheduled_date = $row_true_data['mytime'];
if($scheduled_date<= $curDate){
$obj->tbl= NEWS;
$obj->val = array("scheduled"=>0);
$obj->cond = array("uin"=>$row_true_data['uin']);
$obj->update();

}else{
echo 'Some  Time is Left';
}

endwhile;
?>