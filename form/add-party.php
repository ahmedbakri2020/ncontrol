<?php
if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField("tbl_party", 'uin', $id);
} else {
    $action = "add";
}
?>

<link href="assets/css/password.css" rel="stylesheet">
<form method="post" action="?fol=actpages&amp;page=act_party" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header>
                    <h2>Update Data</h2>
                </header>
                <section>
                    <div class="form-group">
                        <label for="userFirstName">पार्टी</label>
                        <input type="text" name="name" class="form-control" id="userFirstName" value="<?php if (isset($row)) echo stripslashes($row['name']); ?>">
                    </div>
                    
                </section>
            </article>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-3">
            <article class="module margin-top">
                <header>
                    <h2>Party Flag</h2>
                </header>
                <section>
                    <div class="bs-upload-image" id="thumbnail" <?php if($action=='add') echo 'style="display: none;"'; ?>>
                        <?php if (isset($row) && $row['image'] != ""): ?>
                            <img src="<?php echo UPLOADS ?>election/thumbs/<?php echo $row['image']; ?>">
                        <?php endif; ?>  
                    </div>
                    <div class="form-group">
                        <label for="userImage"></label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>
                </section>
            </article>
            
            
            <input type="hidden" name="id" value="<?php echo $id ?>" class="form-control">
            <input type="hidden" name="action" value="<?php echo $action ?>" class="form-control">
            <button type="submit" name="submit" class="btn margin-top btn-primary btn-lg btn-block">Save</button>

        </div>
    </div>
</form>
