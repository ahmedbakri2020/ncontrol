<?php
if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField(GALLERY, 'uin', $id);
} else {
    $action = "add";
}
$type = (int)$_GET['type'];
$res_user = $usrPrev->current_loggedin_user($auth);
?>
<form method="post" action="?fol=actpages&amp;page=act_adedgallery" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header>
                    <h2>Add Photo</h2>
                </header>
                <section>
                    <div class="form-group">
                        <label for="photoTitle">Name/Title</label>
                        <input type="text" name="title" value="<?php if (isset($row)) echo stripslashes($row['g01title']); ?>" class="form-control" id="photoTitle">
                    </div>
                    <!--<div class="form-group">
                        <label for="photoGrapher">Photographer</label>
                        <input type="text" name="by" class="form-control" value="<?php if (isset($row)) echo stripslashes($row['g01by']); ?>" id="photoGrapher">
                    </div>                    
                    <div class="form-group">
                        <label for="content-editor">Content</label>
                        <textarea id="content-editor" name="desc" class="form-control"><?php if (isset($row)) echo stripslashes($row['g01desc']); ?></textarea>
                    </div>-->
                </section>
            </article>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-3">
           <!-- <div class="form-group">
                        <label for="datePicker">Date</label>
                        <input type="text" name="date" class="form-control" id="datePicker"/>
                    </div>-->
            <article class="module">
                <header>
                    <h2>Image </h2>
                </header>
                <section>
                    <div class="bs-upload-image" id="thumbnail" <?php if($action=='add') echo 'style="display: none;"'; ?>>
                        <?php if (isset($row) && $row['g01image'] != ""): ?>
                            <img src="<?php echo UPLOADS ?>images/thumbs/<?php echo $row['g01image']; ?>">
                        <?php endif; ?>  
                    </div>
                    <p><span>(Please Upload Image With Equal Height)</span></p>
                    <div class="form-group">
                        <label for="userImage"></label>
                        <input type="file" name="image" onchange="readURL(this);" class="form-control" id="image">
                    </div>

                </section>
            </article>
             <input type="hidden" name="id" value="<?php echo $id ?>" />
             <input type="hidden" name="action" value="<?php echo  $action ?>" />
             <input type="hidden" name="type" value="<?php echo  $type ?>" />
            <button type="submit" class="btn margin-top btn-primary btn-lg btn-block">Publish</button>
        </div>
    </div>
</form>

<script src="assets/js/bootstrap-tokenfield.min.js"></script>
<script src="<?php echo EDITIOR ?>ckeditor.js"></script>
<script src="assets/js/require.js"></script>
<script>
    $('.tokenfield').tokenfield();
     CKEDITOR.replace('content-editor', {
                    toolbar: 'toolbar_Basic',
                    filebrowserBrowseUrl: '<?php echo CKFINDER; ?>ckf.php',
                    filebrowserUploadUrl: '<?php echo IMAGE_URL; ?>'
                });
    function readURL(input) {

        $('#thumbnail').show();
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#thumbnail').html('<img src="' + e.target.result + '"  height="200"/>');

            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
