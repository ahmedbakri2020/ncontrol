<?php
if ($previlage == 'All' || in_array(2, $arr_prev)) {
    
} else {
    $obj->redirect('?page=404.php');
}

if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField(ADVERTISE, 'uin', $id);
} else {
    $action = "add";
}

if(isset($_GET['cat'])): $cat = $_GET['cat']; endif;
$cat_Arr = array('2');
$cid = (int)$_GET['cid'];
?>
<form method="post" action="?fol=actpages&amp;page=act_adedad" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header>
                    <h2>Add Advertisement</h2>
                </header>
                <section>

                    <div class="form-group">
                        <label for="advertisementPosition">Position</label>
                        <select class="form-control" name="category" onchange="getAdDetails(this.value)" id="advertisementPosition" required>
                            <option>--Choose One --</option> 
                            <?php
                            $res_ad_cat = $obj->getAllData("ad_cat");
                            while ($row_cat_ad = $res_ad_cat->fetch()):
                                echo '<option value="' . $row_cat_ad['cat01id'] . '" ' . (($row_cat_ad['cat01id'] == $row['cat_id']) ? 'selected' : '') . '>' . $row_cat_ad['cat01category'] . '</option> ';
                            endwhile;
                            ?>
                        </select>
                    </div>


                    <div id="ad-level" <?php if($action=='add') echo 'style="display:none;"'; ?>>

                        <?php if ($action == 'edit' && $_GET['cat'] == 2): ?>
                            <div class="form-group">                     
                                <label for="advertisementPosition">Level</label>
                                <select class="form-control" name="level"  id="advertisementPosition">
                                    <?php
                                    $res_ad_lvl = $obj->getAllData("tbl_adlevel");
                                    while ($row_cat_lvl = $res_ad_lvl->fetch()):
                                        echo '<option value="' . $row_cat_lvl['cat01id'] . '" ' . (($row_cat_lvl['cat01id'] == $row['level']) ? 'selected' : '') . '>' . $row_cat_lvl['cat01category'] . '</option> ';
                                    endwhile;
                                    ?>
                                </select>

                            </div>




                            <div class="form-group">
                                <label for="advertisementFollowUp">Ad Type</label>
                                <div class="input-group">
                                    <input type="radio" name="col" value="4" <?php if (isset($row) && $row['col'] == 4) echo 'checked'; ?> id="advertisementFollowUp" /> small 3 ads
                                    <input type="radio" name="col" value="6" <?php if (isset($row) && $row['col'] == 6) echo 'checked'; ?> id="advertisementFollowUp" />half 2 ads
                                    <input type="radio" name="col" value="12" <?php if (isset($row) && $row['col'] == 12) echo 'checked'; ?> id="advertisementFollowUp"/>full 1 ad

                                </div>
                            </div>

                        <?php endif ?>
                    </div>


                    <div class="form-group">
                        <label for="advertisementTitle">Title</label>
                        <input type="text" name="title" class="form-control" value="<?php if (isset($row)) echo stripslashes($row['a01title']); ?>" id="advertisementTitle">
                    </div>

                    <div class="form-group">
                        <label for="advertisementURL">URL</label>
                        <input type="url" name="url" value="<?php if (isset($row)) echo stripslashes($row['a01url']); ?>" class="form-control" id="advertisementURL">
                    </div>
                    <div class="form-group">
                        <label for="advertisementGoogle">For Google Advertisement</label>
                        <textarea class="form-control" name="code" id="advertisementGoogle"><?php if (isset($row)) echo stripslashes($row['code']); ?></textarea>
                    </div>
                </section>
            </article>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-3">
            <article class="module">
                <header>
                    <h2>Size</h2>
                </header>
                <section>
                    <div class="ad-size">
                        <?php if (isset($row)) echo $rowType['details']; ?>
                    </div>
                </section>
            </article>
            <article class="module margin-top">
                <header>
                    <h2>Image</h2>
                </header>
                <section>
                    <div class="bs-upload-image" id="thumbnail">
                        <?php
                    if ($action == 'add') {
                       // echo 'style="display: none;"';
                    }
                    ?>
                             <?php if (isset($row) && $row['a01image'] != ""): ?>
                            <img src="../uploads/advertise/thumbs/<?php echo $row['a01image']; ?>">
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="userImage"></label>
                        <input type="file" name="image" onchange="readURL(this);" class="form-control" id="image">
                    </div>
                </section>
            </article>
            
             <article class="module margin-top" id="mob-image">
                <header>
                    <h2>Mobile Image</h2>
                </header>
                <section>
                    <div class="bs-upload-image" id="thumbnail1">
                        <?php
                    if ($action == 'add') {
                       // echo 'style="display: none;"';
                    }
                    ?>
                             <?php if (isset($row) && $row['a01image_mobile'] != ""): ?>
                            <img src="../uploads/advertise/thumbs/<?php echo $row['a01image_mobile']; ?>">
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="userImage"></label>
                        <input type="file" name="mimage" onchange="readURL1(this);" class="form-control" id="image">
                    </div>
                </section>
            </article>
            <article class="module margin-top" id="mob-image">
                <header>
                    <h2>Video Ad</h2>
                </header>
                <section>
                    <div class="bs-upload-image">
                             <?php if (isset($row) && $row['a01video'] != ""): ?>
                          <video width="" controls>
  <source src="<?php echo UPLOADS;?>advertise/video/<?php echo $row['a01video'];?>" type="video/mp4">
  Your browser does not support HTML video.
</video>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="userImage"></label>
                        <input type="file" name="a01video"  class="form-control" id="video">
                    </div>
                </section>
            </article>
            
            <input type="hidden" name="id" value="<?php echo $id ?>" class="form-control">
            <input type="hidden" name="action" value="<?php echo $action ?>" class="form-control">
            <button type="submit" class="btn margin-top btn-primary btn-lg btn-block">Publish</button>
        </div>
    </div>
</form>

<script src="assets/js/moment.js"></script>
<script src="assets/js/bootstrap-datetimepicker.js"></script>
<script>
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
                            
                             function readURL1(input) {

                                $('#thumbnail').show();
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function (e) {
                                        $('#thumbnail1').html('<img src="' + e.target.result + '"  height="200"/>');

                                    };

                                    reader.readAsDataURL(input.files[0]);
                                }
                            }

                            $(function () {
                                $('#datePicker, #datePickerTo, #datePickerFrom, #datePickerFollowUp').datetimepicker({
                                    format: "YYYY-MM-DD",
                                    showTodayButton: true,
                                    showClose: true
                                });
                                $('#timePicker').datetimepicker({
                                    format: 'LT',
                                    showClose: true
                                });
                            });


                            function getAdDetails(cat_id) {
                                $('.ad-size').show();
                                $.ajax({
                                    url: 'ajax/ad-imagesize.php',
                                    type: 'post',
                                    data: {"id": cat_id},
                                    success: function (response)
                                    {
                                        $('.ad-size').show();
                                        $('.ad-size').html(response);
                                    }
                                });
                                   if (cat_id ==  6 ||cat_id == 7 || cat_id ==8) {
  $('#mob-image').show();
                                   }else{
                                         $('#mob-image').hide();
                                   }

                                if (cat_id == 2) {
                                    $.ajax({
                                        url: 'ajax/ad-level.php',
                                        type: 'post',
                                        data: {"id": cat_id},
                                        success: function (response)
                                        {
                                            $('#ad-level').show();
                                            $('#ad-level').html(response);
                                        }
                                    });

                                }else{
                                    $('#ad-level').hide();
                                }


                            }
                          
</script>
