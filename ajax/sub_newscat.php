<?php
include '../../system/application_top.php';
$id = (int) $_POST['id'];
$res_news_type = $obj->select("tbl_sub_cat_news", "*", array("type" => $id));
if ($res_news_type->rowCount() > 0) {
    ?>
    <label for="Subnews">News Sub Category</label>
    <select name="sub_cat" id="Subnews" class="form-control">
        <option selected disabled>--Select--</option>
        <?php while ($row_type = $res_news_type->fetch()) { ?>                
            <option value ="<?php echo $row_type['cat01id']; ?>"> <?php echo $row_type['cat01category']; ?></option>                
        <?php } ?> 
    </select>
<?php } ?>  