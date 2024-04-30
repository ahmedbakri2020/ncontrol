<?php
include('../../system/application_top.php');
if (isset($_POST['id'])) {
    ?>
    <div class="form-group">
        <label for="advertisementPosition">Level</label>
        <select class="form-control" name="level"  id="advertisementPosition">
            <?php
            $res_ad_lvl = $obj->getAllData("tbl_adlevel");
            while ($row_cat_lvl = $res_ad_lvl->fetch()):
                echo '<option value="' . $row_cat_lvl['cat01id'] . '" ' . (($row_cat_lvl['cat01id'] == $row['level']) ? 'checked' : '') . '>' . $row_cat_lvl['cat01category'] . '</option> ';
            endwhile;
            ?>
        </select>

    </div>

    <div class="form-group">
        <label for="advertisementFollowUp">Ad Type</label>
        <div class="input-group">
            <input type="radio" name="col" value="4" <?php if (isset($row) && $row['col'] == 4) echo 'checked'; ?> id="advertisementFollowUp" /> small 3 ads
            <input type="radio" name="col" value="6" <?php if (isset($row) && $row['col'] == 6) echo 'checked'; ?> id="advertisementFollowUp" />half 2 ads
            <input checked type="radio" name="col" value="12" <?php if (isset($row) && $row['col'] == 12) echo 'checked'; ?> id="advertisementFollowUp"/>full 1 ad
        </div>
    <?php } ?>