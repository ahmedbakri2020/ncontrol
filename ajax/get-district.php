<?php
include '../../system/application_top.php';

$sabha = $_POST['sabha'];
switch ($sabha) {
    case 1:
        $type = 'pratnidhi_sabha';
        break;
    case 2:
        $type = 'pradesh_sabha';
        break;

    case 3:
        $type = 'sthaniya_sabha';
        break;
}
ob_start();
?>

<select name="district" id="district" class="form-control">
    <option value=""> --जिल्ला --</label>
        <?php
        $res_dist = $obj->select("cat01category", "*", array("type" => "district", $type => 1));
        if ($res_dist->rowCount() > 0) {
            while ($row_dist = $res_dist->fetch()) {
                ?>
            <option value="<?php echo $row_dist['cat01id']; ?>" <?php if (isset($row) && $row['district'] == $row_dist['cat01id']) echo 'selected'; ?>> <?php echo $row_dist['cat01category'] ?></option>
            <?php
        }
    }
    ?>
</select>
<?php
$contents = ob_get_contents();
ob_end_clean();
echo $contents;
?>