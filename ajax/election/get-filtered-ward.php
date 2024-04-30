<?php
include '../../system/application_top.php';
$dist = $_POST['position'];
ob_start();
?>

<select name="address" class="form-control">
    <option value=""> --स्थानीय तह  --</label>
        <?php
        $res_dist = $obj->select("area_sub_ward", "*", array("local_id" => $dist));
        if ($res_dist->rowCount() > 0) {
            while ($row_dist = $res_dist->fetch()) {
                ?>
            <option value="<?php echo $row_dist['uin']; ?>"> <?php echo $row_dist['cat01category'] ?></option>
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