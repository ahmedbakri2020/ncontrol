<?php
include '../../system/application_top.php';

$dist = $_POST['district'];
$palika = $_POST['palika'];
ob_start();
?>

<select name="address" class="form-control">
    <option value=""> --स्थानीय तह  --</label>
        <?php
        $res_dist = $obj->select("area_subdivision", "*", array("cid" => $dist, 'palika_type' => $palika));
        if ($res_dist->rowCount() > 0) {
            while ($row_dist = $res_dist->fetch()) {
                ?>
            <option value="<?php echo $row_dist['address']; ?>"> <?php echo $row_dist['address'] ?></option>
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