<?php
if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField(VIDEO, 'uin', $id);
} else {
    $action = "add";
}
$type = (int)$_GET['type'];
$res_user = $usrPrev->current_loggedin_user($auth);
?>
<form method="post" action="?fol=actpages&amp;page=act_adedvideo" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header>
                    <h2>Add Video</h2>
                </header>
                <section>
                    <div class="form-group">
                        <label for="videoTitle">Title</label>
                        <input type="text" name="title" value="<?php if(isset($row)) echo $row['v01title'] ?>" class="form-control" id="videoTitle">
                    </div>                    
                    
                    <div class="form-group">
                        <label for="youtubeVideoID">Youtube Video ID</label>
                        <div class="input-group">
                            <div class="input-group-addon">https://www.youtube.com/watch?v=</div>
                            <input type="text" name="code" class="form-control" value="<?php if(isset($row)) echo $row['v01code'] ?>"  id="youtubeVideoID">
                        </div>
                    </div>
                    <div id="video-preview">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src=""></iframe>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content-editor">Content</label>
                        <textarea id="content-editor" name="desc" class="form-control"><?php if(isset($row)) echo $row['v01desc'] ?></textarea>
                    </div>
                </section>
            </article>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-3"> 
            <input type="hidden" name="id" value="<?php echo $id ?>" />
             <input type="hidden" name="action" value="<?php echo  $action ?>" />
             <input type="hidden" name="type" value="<?php echo  $type ?>" />
            <button type="submit" name="btn_submit" class="btn margin-top btn-primary btn-lg btn-block">Publish</button>
        </div>
    </div>
</form>

<script src="assets/js/bootstrap-tokenfield.min.js"></script>
<script src="<?php echo EDITIOR ?>ckeditor.js"></script>
<script src="assets/js/bootstrap-datetimepicker.js"></script>
<script src="assets/js/require.js"></script>
<script>
    $('.tokenfield').tokenfield();
     CKEDITOR.replace('content-editor', {
                    toolbar: 'toolbar_Basic',
                    filebrowserBrowseUrl: '<?php echo CKFINDER; ?>ckf.php',
                    filebrowserUploadUrl: '<?php echo IMAGE_URL; ?>'
                });

    $(function () {
        $('#datePicker').datetimepicker({
            format: "DD/MM/YYYY",
            showTodayButton: true,
            showClose: true
        });
        $('#timePicker').datetimepicker({
            format: 'LT',
            showClose: true
        });
    });
    $("#youtubeVideoID").change(function () {
        var videoID = $(this).val();
        $("#video-preview").addClass('show');
        var videoID = "https://www.youtube.com/embed/" + videoID;
        $("#video-preview .embed-responsive iframe").attr("src", videoID);
    });
</script>
