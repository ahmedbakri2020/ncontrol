<?php
if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField("p01pages", 'cat01id', $id);
} else {
    $action = "add";
}
?>

<form method="post" action="?fol=actpages&amp;page=act_adedpage" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header>
                    <h2><?php echo $row['cat01category'] ?></h2>
                </header>
                <section>
                    <?php if ($id != 2) { ?>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="content" name="desc" class="form-control"><?php if (isset($row)) echo stripslashes($row['p01desc']); ?></textarea>
                        </div>                    
                    <?php }else { ?>
                        
                        <div class="form-group">
                            <label for="companyAddress">Address</label>
                            <input type="text" name="address" value="<?php if (isset($row)) echo stripslashes($row['p01address']); ?>" class="form-control" id="companyAddress">
                        </div>
                        <div class="form-group">
                            <label for="companyEmail">Email</label>
                            <input type="enail" name="email" value="<?php if (isset($row)) echo stripslashes($row['p01email']); ?>" class="form-control tokenfield" id="companyEmail" placeholder="Type & Hit Enter">
                        </div>
                        <div class="form-group">
                            <label for="companyContact">Contact</label>
                            <input type="text" name="contact" value="<?php if (isset($row)) echo stripslashes($row['p01contact']); ?>" class="form-control" id="companyContact">
                        </div>
                        <div class="form-group">
                            <label for="companyContact">Fax</label>
                            <input type="text" name="fax" value="<?php if (isset($row)) echo stripslashes($row['p01fax']); ?>" class="form-control" id="companyContact">
                        </div>
                        <div class="form-group">
                            <label for="facebookProfileURL">Facebook Profile</label>
                            <div class="input-group">
                                <div class="input-group-addon">https://www.facebook.com/</div>
                                <input type="text"  name="fb" value="<?php if (isset($row)) echo stripslashes($row['p01fb']); ?>" class="form-control" id="facebookProfileURL">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="twitterProfileURL">Twitter Profile</label>
                            <div class="input-group">
                                <div class="input-group-addon">https://www.twitter.com/</div>
                                <input type="text" name="twitter" value="<?php if (isset($row)) echo stripslashes($row['p01twitter']); ?>" class="form-control" id="twitterProfileURL">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="googlePlusProfileURL">Instagram Profile</label>
                            <div class="input-group">
                                <div class="input-group-addon">https://www.instagram.com/</div>
                                <input type="text" name="instagram" class="form-control" value="<?php if (isset($row)) echo stripslashes($row['p01insta']); ?>" id="googlePlusProfileURL">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="googlePlusProfileURL">App Link</label>
                                <input type="text" name="app_link" value="<?php if (isset($row)) echo stripslashes($row['app_link']); ?>" class="form-control" id="companyAddress">
                       </div>
                        <div class="form-group">
                            <label for="youTubeChanel">Youtube Chanel</label>
                            <div class="input-group">
                                <div class="input-group-addon">https://www.youtube.com/channel/</div>
                                <input type="text" name="yt" class="form-control" value="<?php if (isset($row)) echo stripslashes($row['p01yt']); ?>" id="youTubeChanel">
                            </div>
                        </div>
                        <div id="video-preview">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src=""></iframe>
                            </div>
                        </div>
                    <?php } ?>



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
 <script src="<?php echo SITE_URL ?>assets/content-editor/ckeditor/ckeditor.js?v=1.0.1"></script>

   <script>
                            var config = {
                                customConfig: '',
                               
                                disallowedContent: 'img[width];',
                                imageUploadURL: '<?php echo ADMIN_URL ?>ckplugin/uploadimage.php?ver=1.0.1',
                                // Add the required plugin
                                extraPlugins: 'simage',
                                filebrowserBrowseUrl: '<?php echo $ck_url; ?>assets/content-editor/rich/index.html',
                                filebrowserImageBrowseUrl: '<?php echo $ck_url ?>assets/content-editor/rich/index.html',
                                filebrowserUploadUrl: '<?php echo $ck_url ?>assets/content-editor/rich/connectors/php/filemanager.php?command=QuickUpload&type=Images&integration=ckeditor&ck_by=test',
                                filebrowserImageUploadUrl: '<?php echo $ck_url ?>assets/content-editor/rich/connectors/php/filemanager.php?command=QuickUpload&type=Images&integration=ckeditor&ck_by=test',
                              
                                simpleuploads_acceptedExtensions: '7z|avi|csv|doc|docx|flv|gif|gz|gzip|jpeg|jpg|mov|mp3|mp4|mpc|mpeg|mpg|ods|odt|pdf|png|ppt|pxd|rar|rtf|tar|tgz|txt|vsd|wav|wma|wmv|xls|xml|zip'
                            };
                            CKEDITOR.replace('content', config);
                        </script>