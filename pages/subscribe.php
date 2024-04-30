<?php
if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField("tbl_subscribe", 'cat01id', $id);
} else {
    $action = "add";
}
?>

<form method="post" action="?fol=actpages&amp;page=act_adedsub" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header>
                    <h2>Subscription Contacts</h2>
                    <a href="?page=subscription" title=""><i class="fa fa-plus"></i> Add Subscription Rates</a>
                    <a href="?page=regional" title=""><i class="fa fa-plus"></i> Add Regional Contacts</a>
                </header>
                <section>

                        <div class="form-group">
                            <label for="companyEmail">Email</label>
                            <input type="email" name="email" value="<?php if (isset($row)) echo stripslashes($row['sub_email']); ?>" class="form-control tokenfield" id="companyEmail" placeholder="Type & Hit Enter">
                        </div>
                        <div class="form-group">
                            <label for="companyContact">Toll Free Number</label>
                            <input type="text" name="toll" value="<?php if (isset($row)) echo stripslashes($row['sub_toll']); ?>" class="form-control" id="companyContact">
                        </div>
                        <div class="form-group">
                            <label for="companyContact">Phone Number</label>
                            <input type="text" name="phone" value="<?php if (isset($row)) echo stripslashes($row['sub_phone']); ?>" class="form-control" id="companyContact">
                        </div>
                    <div class="form-group">
                        <label for="companyContact">Subscription</label>
                        <input type="text" name="sub" value="<?php if (isset($row)) echo stripslashes($row['sub_sub']); ?>" class="form-control" id="companyContact">
                    </div>
                    <div class="form-group">
                        <label for="companyContact">SMS For Subscription</label>
                        <input type="text" name="sms" value="<?php if (isset($row)) echo stripslashes($row['sub_sms']); ?>" class="form-control" id="companyContact">
                    </div>
                    <div class="form-group">
                        <label for="companyContact">Complaint</label>
                        <input type="text" name="comp" value="<?php if (isset($row)) echo stripslashes($row['sub_comp']); ?>" class="form-control" id="companyContact">
                    </div>
                </section>
            </article>
            <div class="row">
                <div class="col-md-4">
                    <input type="hidden" name="id" value="<?php echo $id ?>" />
                    <button type="submit" name="btn_submit" class="btn margin-top btn-primary btn-lg btn-block">Publish</button>
                </div>
            </div>
        </div>

    </div>
</form>
<script src="<?php echo EDITIOR ?>ckeditor.js"></script>

<script>
    CKEDITOR.replace('content-editor', {
        toolbar: 'MyToolbar',
        filebrowserBrowseUrl: '<?php echo CKFINDER; ?>ckf.php',
        filebrowserUploadUrl: '<?php echo SITE_URL; ?>assets/images/'
    });
</script>