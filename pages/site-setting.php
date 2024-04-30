<?php
if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    // var_dump($id);
    $row = $obj->getDataByField('tbl_site', 'cat01id', $id);
    //var_dump($row);
} else {
    $action = "add";
}
?>

<form method="post" action="?fol=actpages&amp;page=act-site" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header>
                    <h2>Site Setting</h2>
                </header>
                <section>
                    <div class="form-group">
                        <label for="companyAddress">Site Name</label>
                        <input type="text" name="site-name" value="<?php if (isset($row)) echo stripslashes($row['sname']); ?>" class="form-control" id="companyAddress">
                    </div>
                </section>
            </article>

        </div>
        <div class="col-sm-4 col-md-4 col-lg-3">
            <article class="module margin-top">
                <header>
                    <h2>Favicone Logo</h2>
                    <?php
                    if (isset($row) && $row['hlogo'] != "") {
                        echo '<img src="assets/images/Trash.png" onclick="delete_image(' . $row['cat01id'] . ')" class="pull-right" />';
                    }
                    ?>
                </header>
                <section>
                    <div class="bs-upload-image" id="thumbnail" <?php if($action=='add') echo 'style="display: none;"'; ?>>
                        <?php if (isset($row) && $row['hlogo'] != ""): ?>
                            <img src="<?php echo UPLOADS ?>logo/<?php echo $row['hlogo']; ?>">
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="userImage"></label>
                        <input type="file" name="himage" onchange="readURL(this);" class="form-control" id="image">
                    </div>

                </section>
            </article>
                    <input type="hidden" name="id" value="<?php echo $id ?>" />
                    <button type="submit" name="btn_submit" class="btn margin-top btn-primary btn-lg btn-block">Publish</button>

        </div>
    </div>
</form>
<script src="<?php echo EDITIOR ?>ckeditor.js"></script>
<script src="<?php echo SITE_URL;?>admin-control/assets/js/jscolor.js"></script>
<script>
    function delete_image(image_id) {
        if (confirm('Sure to perfom the action'))
        {
            $.ajax({
                url: 'ajax/delete_img.php',
                type: 'post',
                data: {"id": image_id, "of": 'page'},
                dataType: 'json',
                success: function (response)
                {
                    if (response.status == 1)
                    {
                        location.reload();
                    }
                }
            });
        }
    }

    function delete_image1(image_id) {
        if (confirm('Sure to perfom the action'))
        {
            $.ajax({
                url: 'ajax/delete_img.php',
                type: 'post',
                data: {"id": image_id, "of": 'footer'},
                dataType: 'json',
                success: function (response)
                {
                    if (response.status == 1)
                    {
                        location.reload();
                    }
                }
            });
        }
    }

</script>

