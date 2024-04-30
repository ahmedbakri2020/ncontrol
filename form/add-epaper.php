<?php
if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField("tbl_epaper", 'epaper_id', $id);
} else {
    $action = "add";
}
$type = (int)$_GET['type'];
?>
<form method="post" action="?fol=actpages&amp;page=act_adedepaper" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header>
                    <h2>Add Photo</h2>
                </header>
                <section>
                    <div class="form-group">
                        <label for="photoTitle">Name/Title</label>
                        <input type="text" name="epaper_name" value="<?php if (isset($row)) echo stripslashes($row['epaper_name']); ?>" class="form-control" id="photoTitle">
                    </div>
                    <div class="input-group date hidden" id="datePicker">
                            <input type="text" name="date"  value="<?php
                            if (isset($row)) {
                                echo date('Y-m-d', strtotime($row['paper_date']));
                            } else {
                                echo date('Y-m-d');
                            }
                            ?>" class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>

                </section>
            </article>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-3">

          
            </article>
             <input type="hidden" name="id" value="<?php echo $id ?>" />
             <input type="hidden" name="action" value="<?php echo  $action ?>" />
             <input type="hidden" name="type" value="<?php echo  $type ?>" />
            <button type="submit" class="btn margin-top btn-primary btn-lg btn-block">Publish</button>
        </div>
    </div>
</form>
<script src="assets/js/moment.js"></script>
<script src="assets/js/bootstrap-datetimepicker.js"></script>
<script>
    $(function () {
        $('#datePicker').datetimepicker({
            format: "YYYY-MM-DD",
            showTodayButton: true,
            showClose: true
        });
     
    });
</script>