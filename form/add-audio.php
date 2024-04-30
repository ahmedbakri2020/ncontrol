<?php
header("Access-Control-Allow-Origin: *"); 
if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField('tbl_audio', 'r_id', $id);
} else {
    $action = "add";
}
$type = (int) $_GET['type'];

$res_user = $usrPrev->current_loggedin_user($auth);
//$ret[$i]['reporter'] = ($row_data['posted_by']!="")?html_entity_decode($row_data['posted_by']):'';
?>
<form method="post" action="?fol=actpages&amp;page=act_adedaudio" enctype="multipart/form-data" id="audform" >
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header>
                    <h2>Add Audio</h2>
                </header>
                <section>
                    <div class="form-group">
                        <label for="photoTitle">Name/Title</label>
                        <input type="text" name="title" value="<?php if (isset($row)) echo stripslashes($row['title']); ?>" class="form-control" id="photoTitle">
                    </div>
                    
                    <div class="form-group">
                        <label for="content-editor">Content</label>
                        <textarea id="content-editor" name="desc" class="form-control"><?php if (isset($row)) echo stripslashes($row['n01desc']); ?></textarea>
                       
                        <?php
                        $_SESSION['ck_user'] = $_SESSION['authid'];
                        ?>
                            <script src="<?php echo SITE_URL ?>ckeditor/ckeditor.js"></script>  
                        <script>                           
                            var config = {
                                customConfig: '',
                                height: 400,
                                disallowedContent: 'img[width];',
                                embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',
                                
                                // Add the required plugin
                                extraPlugins: 'simage',
                                imageUploadURL:'<?php echo SITE_URL ?>ckeditor/plugins/imageuploader/imgupload.php?',
                                filebrowserBrowseUrl: '<?php echo SITE_URL; ?>ckfinder/ckfinder.php',
                                filebrowserImageBrowseUrl: '<?php echo SITE_URL; ?>ckfinder/ckfinder.php?Type=Images',
                                                
                                 filebrowserWindowWidth: '1000',
                                 filebrowserWindowHeight: '700',
                                 simpleuploads_acceptedExtensions: '7z|avi|csv|doc|docx|flv|gif|gz|gzip|jpeg|jpg|mov|mp3|mp4|mpc|mpeg|mpg|ods|odt|pdf|png|ppt|pxd|rar|rtf|tar|tgz|txt|vsd|wav|wma|wmv|xls|xml|zip'
                               };

                              CKEDITOR.replace('content-editor', config);
                        </script>
                    </div>
                    <!-- <div class="form-group">
                         <label for="photoGrapher">Description</label>
                         <input type="text" name="desc" class="form-control" value="<?php if (isset($row)) echo stripslashes($row['g01by']); ?>" id="photoGrapher">
                     </div>   -->                 
                    <!-- <div class="form-group">
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
            <article class="module margin-top">
                <header>
                    <h2>Audio</h2>
                </header>
                <section>
                    
                      <script src="<?php echo SITE_URL ?>assets/content-editor/ckeditor/ckeditor.js"></script>                  
                    

                    <div class="form-group">
                        <label for="userImage"></label>
                        <input type="file" name="file" onchange="readURL(this);" class="form-control" id="image">
                    </div>
                    <div class="form-group">	
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
                                <span class="sr-only">0% Complete</span>
                            </div>
                        </div>
                    </div>


                    <div id="audio-preview">
                        <?php if ($row['file'] != "") { ?>	

                            <audio src="<?php echo SITE_URL; ?>uploads/audio/<?php echo $row['file']; ?>" controls="" preload=""></audio>

                        <?php } ?> 
                    </div>

                </section>
            </article>
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <input type="hidden" name="action" value="<?php echo $action ?>" />
            <input type="hidden" name="type" value="<?php echo $type ?>" />
            <button type="submit" class="btn margin-top btn-primary btn-lg btn-block">Publish</button>
        </div>
    </div>
</form>


