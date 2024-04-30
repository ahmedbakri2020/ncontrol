<?php
 $val = $_SERVER["REQUEST_SCHEME"];
 if($val=='http'):
     $ck_url ='http://nayapatrikadaily.com/';
     elseif($val =='https'):
         $ck_url ='https://nayapatrikadaily.com/';
         endif;
    
if ($previlage == 'All' || in_array(1, $arr_prev)) {

} else {
    $obj->redirect('?page=404.php');
}
if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
  
  $result = $obj->db->query("select * from n01news where uin=$id");
  if($result->rowCount()>0):
         $row = $obj->getDataByField(NEWS, 'uin', $id);
         $url ="act_adednews123";
       else:
         $row = $obj->getDataByField("news_backup", 'uin', $id);
         $url="act_bkadednews";
       endif;

    $time = date('H:i:s', strtotime($row['mytime']));
    $cat_size = $obj->getDataByField(NEWS_CAT, 'cat01id', $row['n01type']);
} else {
    $action = "add";
}
$res_user = $obj->db->query("SELECT * FROM tbl_author where status=0 order by s_order asc");
  //$res_user = $obj->select("tbl_author", "*", array("status" => 0));
//$res_user = $obj->getAllData("tbl_author");
$res_trend = $obj->getAllData("tbl_trends");


if (isset($_GET['type'])) {
    $type = '&type=' . (int) $_GET['type'];
}
$res_subcat = $obj->select("tbl_sub_cat_news", "*", array("type" => $row['n01type']));
 $res_subcat ->rowCount();

?>

<form method="post" action="?fol=actpages&amp;page=<?php echo $url ;?><?php if (isset($type)) echo $type; ?>" enctype="multipart/form-data" id="form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                    <h2>Add News</h2>
                </header>
                <section>
                    <div class="form-group">
                        <label for="newsTitle">Title (Short title will be best)</label>
                        <input type="text" name="title" class="form-control" id="newsTitle" value="<?php if (isset($row)) echo stripslashes($row['n01title']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="newsSubTitle">Sub Title</label>
                        <input type="text" name="sub_title" class="form-control" value="<?php if (isset($row)) echo stripslashes($row['sub_title']); ?>" id="newsSubTitle">
                    </div>

                    <div class="form-group" id="ribbon-news">
                        <label for="ribbon-news">Ribbon Title</label>
                        <input type="text" class="form-control"  name="ribbon_news" value="<?php if (isset($row)) echo stripslashes($row['ribbon_news']); ?>" />
                    </div>

                    <div class="form-group">
                        <label for="newsKeywords">Keywords</label>
                        <input type="text" name="keyword" value="<?php if (isset($row)) echo stripslashes($row['keyword']); ?>" class="form-control tokenfield" id="newsKeywords" placeholder="Keyword" />
                    </div>
                    
                   <!-- <div class="form-group">
                        <label for="newsKeywords">Releted News Link(one News)</label>
                        <input type="text" name="rtnews" value="<?php if (isset($row)) echo stripslashes($row['rtnews']); ?>" class="form-control tokenfield12" id="" />
                    </div>-->

                    <div class="form-group">
                        <label for="newsKeywords">Recomended News Link(Two News)</label>
                        <input type="text" name="rmnews" value="<?php if (isset($row)) echo stripslashes($row['rmnews']); ?>" class="form-control tokenfield13" id="newsKeywords11" placeholder="Type & Hit Enter" />
                    </div>
                    
                    <div class="form-group">
                        <label for="Article">Article By (Alternative for Author)</label>
                        <input type="text" name="posted_by" class="form-control" value="<?php if (isset($row)) echo $row['posted_by']; ?>" id="article">
                    </div>
                    
                     <div class="form-group">
                        <label for="Location">Location(For Article By)</label>
                        <input type="text" class="form-control"  name="location" value="<?php if (isset($row)) echo $row['location']; ?>" id="location" />
                    </div>
                    
                     <div class="form-group" id="atlocation">
                        <label for="Article">Temporary  Location ( for Author)</label>
                        <input type="text" name="temp_loc" class="form-control" value="<?php if (isset($row)) echo $row['temp_loc']; ?>" id="temploc">
                    </div>
                    

                     <div class="form-group">
                        <label for="content-editor">Content</label>
                        <textarea id="content-editor" name="desc" class="form-control"><?php if (isset($row)) echo stripslashes($row['n01desc']); ?></textarea>
                        <script src="<?php echo $ck_url;?>assets/content-editor/ckeditor/ckeditor.js"></script>
                        <?php 
                         $_SESSION['ck_user'] = $_SESSION['authid'];
                        ?>
                        <!--<script>
                            var config = {
                                    customConfig: '',
                                    height: 700,
                                    // Add the required plugin
                                    extraPlugins: 'simpleuploads',
                                    disallowedContent :'img[width]',
                                    filebrowserBrowseUrl: 'https://nayapatrikadaily.com/assets/ncontent-editor/ckfinder/ckfinder.php',
                                    filebrowserUploadUrl: 'https://nayapatrikadaily.com/assets/ncontent-editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                    filebrowserWindowWidth : '1000',
                                    filebrowserWindowHeight : '700',
                                    simpleuploads_acceptedExtensions: '7z|avi|csv|doc|docx|flv|gif|gz|gzip|jpeg|jpg|mov|mp3|mp4|mpc|mpeg|mpg|ods|odt|pdf|png|ppt|pxd|rar|rtf|tar|tgz|txt|vsd|wav|wma|wmv|xls|xml|zip'
                                };
 
                            CKEDITOR.replace('content-editor',config);
                        </script>-->
                        <script>
                        var config = {
                            customConfig: '',
                            height: 400,
                            disallowedContent :'img[width];',
                            embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

                            // Add the required plugin
                            extraPlugins: 'simpleuploads',
                            filebrowserBrowseUrl : '<?php echo $ck_url;?>assets/content-editor/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                            filebrowserUploadUrl : '<?php echo $ck_url;?>assets/content-editor/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                            filebrowserImageBrowseUrl : '<?php echo $ck_url;?>assets/content-editor/filemanager/dialog.php?type=1&editor=ckeditor&fldr=',
                    
                           // filebrowserBrowseUrl: '<?php echo $ck_url;?>assets/content-editor/ckfinder/ckfinder.php?integration=ckeditor&ck_by=naya&v=1.1.2',
                           // filebrowserImageBrowseUrl: '<?php echo $ck_url;?>assets/content-editor/ckfinder/ckfinder.php?Type=Images&integration=ckeditor&ck_by=naya&v=1.1.2',
                           // filebrowserUploadUrl: '<?php echo $ck_url;?>assets/content-editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&integration=ckeditor&ck_by=naya&v=1.1.2',
                            //filebrowserImageUploadUrl: '<?php echo $ck_url;?>assets/content-editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&integration=ckeditor&ck_by=naya&v=1.1.2',
                            filebrowserWindowWidth : '1000',
                            filebrowserWindowHeight : '700',
                            simpleuploads_acceptedExtensions: '7z|avi|csv|doc|docx|flv|gif|gz|gzip|jpeg|jpg|mov|mp3|mp4|mpc|mpeg|mpg|ods|odt|pdf|png|ppt|pxd|rar|rtf|tar|tgz|txt|vsd|wav|wma|wmv|xls|xml|zip'
                        };

                        CKEDITOR.replace('content-editor', config);
                    </script>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="short-editor">Short Detail (Flash News Only)</label>
                        <textarea id="short-editor" name="shortdesc" class="form-control"><?php if (isset($row)) echo stripslashes($row['shortdesc']); ?></textarea>
                       
                        
                        <script>
                            var config = {
                                    customConfig: '',
                                    height: 700,
                                    // Add the required plugin
                                    
                                    //disallowedContent :'img[width]',
                                    //filebrowserWindowWidth : '1000',
                                    //filebrowserWindowHeight : '700',
                                    //simpleuploads_acceptedExtensions: '7z|avi|csv|doc|docx|flv|gif|gz|gzip|jpeg|jpg|mov|mp3|mp4|mpc|mpeg|mpg|ods|odt|pdf|png|ppt|pxd|rar|rtf|tar|tgz|txt|vsd|wav|wma|wmv|xls|xml|zip'
                                };
 
                            CKEDITOR.replace('short-editor',config);
                        </script>
                    </div>
                </section>
            </article>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-3">
            <article class="module">
                <header>
                    <h2>News Category</h2>
                </header>
                <section>
                    <div class="bs-multiselect">
                        <ul>
                            <?php
                            $res_news_type = $obj->select(NEWS_CAT, "*", array("status" => 1));
                            if ($res_news_type->rowCount() > 0) {
                                while ($row_type = $res_news_type->fetch()) {
                                    ?>
                                    <li>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="category[]" onclick="showHiddenThings(<?php echo $row_type['cat01id'] ?>)" value="<?php echo $row_type['cat01id']; ?>" <?php if (isset($row) && $row['n01type'] == $row_type['cat01id']) echo 'checked'; ?>> <?php echo $row_type['cat01category'] ?>
                                            </label>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }
                            ?>

                        </ul>
                    </div>
                </section>
            </article>


           <article class="module margin-top sub_cat" <?php if($action=='add') echo 'style="display:none;"'; ?>>
                <header><h2>Sub Category</h2></header>
                <section>
                    <?php //if ($res_subcat->rowCount() > 0): ?>
                    <div class="form-group" id="sub_cat">

                            <label for="Subnews">News Sub Category</label>
                            <select name="sub_cat" id="Subnews" class="form-control">
                                <option selected disabled>--Select--</option>
                                <?php  while($row_subcat = $res_subcat->fetch()) { ?>
                                  <option value ="<?php echo $row_subcat['cat01id']; ?>" <?php if ($row['sub_cat'] == $row_subcat['cat01id']) echo 'selected'; ?>> <?php echo $row_subcat['cat01category']; ?></option>
                                <?php } ?>
                            </select>

                    </div>
                    <?php //endif; ?>
                </section>
            </article>
            
             <article class="module">
                <header>
                    <h2>Author</h2>
                </header>
                <section>
                    <div class="bs-multiselect">
                        <div class="form-group">
                         <!--<input type="text" id="search-news" placeholder="Search" class="form-control" autocomplete="off">-->
                          <input type="text" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Search for names.." title="Type in a name">
                       
                         </div>
                      
                        <ul class="result-author" id="myTable">
                            <?php
                            if($res_user==true) {
                                while ($row_user = $res_user->fetch()):
                                    $author_arr=explode(',',$row['author']);
                                    if (isset($row)) {
                                       if (is_int($row['author'])) {
                                           $auth = $row['author'];
                                        } else {
                                            $auth = explode(',', $row['author']);

                                        }

                                    }

                                    ?>


                                <li>
                                    <div class="checkbox">
                                        <label>
                                            <input class="showloc" type="checkbox" name="author[]"
                                                   value="<?php echo $row_user['cat01id']; ?>" <?php
                                            if (isset($row)) {
                                                if (is_array($auth) && in_array($row_user['cat01id'], $auth)) {
                                                    echo 'checked';
                                                } elseif ($row_user['cat01id'] == $row['auth']) {
                                                    echo 'checked';
                                                }
                                            }
                                            ?>> <?php echo $row_user['cat01category'] ?>
                                        </label>
                                    </div>
                                </li>
                                <?php
                            endwhile;
                            }
                            ?>

                        </ul>
                    </div>
                </section>
            </article>


            <article class="module margin-top">
                <header>
                    <h2>Image</h2>
                    <?php
                        if (isset($row) && $row['n01image'] != "") {
                            echo '<img src="assets/images/Trash.png" onclick="delete_image(' . $row['uin'] . ')" class="pull-right" />';
                        }
                        elseif (isset($row) && $row['img_path'] != "") {
                            echo '<img src="assets/images/Trash.png" onclick="delete_image(' . $row['uin'] . ')" class="pull-right" />';


                        }
                    ?>

                </header>
                <section>
                    <input id="img-input" type="hidden" name="image" value="">
                    <div class="bs-upload-image" id="thumbnail" data-toggle="modal" data-target=".bs-modal-lg">
                        <?php if (isset($row) && $row['n01image'] != "") { ?>
                            <img src="<?php echo NEWS_IMAGE ?>large<?php echo $cat_size['img_width']; ?>/<?php echo $row['n01image']; ?>">
                        <?php }
                        elseif (isset($row) && $row['img_path'] != "") { ?>
                            <img src="<?php echo $row['img_path']; ?>">
                            <?php
                        }
                        ?>
                    </div>
                    <div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mediaModal">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="mediaModal">Insert Media</h4>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#uploadMedia" aria-controls="uploadMedia" role="tab" data-toggle="tab">Upload</a></li>
                                            <li role="presentation"><a href="#mediaLibrary" aria-controls="mediaLibrary" role="tab" data-toggle="tab">Media Library</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="uploadMedia">
                                                <div class"form-group">
                                                    <input type="file" onchange="readURL(this);" name="image"  id="Image"/> <span>Please Upload  800px * 600px and Above Image </span>
                                                </div>

                                            </div>

                                        <div role="tabpanel" class="tab-pane" id="mediaLibrary">
                                            <div class="row margin-top">
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control search"  placeholder="Search Images" aria-label="...">
                                                           <button class="btn btn-default search-value">Search</button>
                                                    </div>
                                                    <button type="button" onclick="myFunction()" class="btn btn-primary">Double Click To Load Image</button>
                                                </div>
                                                <div class="col-md-6">
                                                    <nav>
                                                        <ul class="pagination btn">
                                                            <li class="active"><a href="#" id="1">1 <span class="sr-only">(current)</span></a></li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>

                                            <div class="album clearfix" id="img-album">
                                                <ul class="row" id="search-list">
                                                    <!--<ul class="pagination btn">
                                                        <li class="active"><a href="#" id="1">1 <span class="sr-only">(current)</span></a></li>

                                                    </ul>-->

                                                </ul>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                    </div>
                    </div><br>
                    <div class="form-group"  id="author_img">
            <label for="img_caption">दृष्टिकोण Category Image</label>
            <input type="file" name="auth_img" class="form-control">
        </div><br>

                    <div class="form-group">
                        <label for="img_caption">Image Caption</label>
                        <input type="text" name="img_caption" class="form-control" value="<?php if (isset($row)) echo $row['img_caption']; ?>" id="img_caption">
                    </div>

                    <div class="form-group">
                        <label for="code">Or Video Code (Image Alternative)</label>
                        <input type="text" name="yt_code" class="form-control" value="<?php if (isset($row)) echo $row['yt_code']; ?>" id="code">
                    </div>
                      <div class="form-group">
                        <label for="code">Or Facebook Code (Image/Video Alternative)</label>
                        <input type="text" name="fb_code" class="form-control" value="<?php if (isset($row)) echo $row['fb_code']; ?>" id="code">
                    </div>


                   <div class="form-group">
                        <label>Hide Image (Flash)</label>
                        <input type="radio" name="img_status" value="1" <?php if (isset($row) && $row['img_status'] == 1) echo "checked"; ?>>Yes
                        <input type="radio" name="img_status" value="0" <?php if (isset($row) && $row['img_status'] == 0) echo "checked"; ?>>No
                    </div>
                     <div class="form-group">
                        <label>Show Image (Details)</label>
                        <input type="radio" name="img_display" value="1" <?php if (isset($row) && $row['img_display'] == 1) echo "checked"; ?>>Yes
                        <input type="radio" name="img_display" value="0" <?php if (isset($row) && $row['img_display'] == 0) echo "checked"; ?>>No
                    </div>
                  
                </section>
            </article>
           
            <article class="module margin-top">
                <header>
                    <h2>Schedule</h2>
                </header>
                <section>
                    <div class="form-group">
                        <div class="input-group date" id="datePicker">
                            <input type="text" name="date"  value="<?php
                            if (isset($row)) {
                                echo date('Y-m-d', strtotime($row['mytime']));
                            } else {
                                echo date('Y-m-d');
                            }
                            ?>" class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group date" id="timePicker">
                            <input type="text" name="input_time" value="<?php
                            if (isset($row)) {
                                echo $time;
                            } else {
                                echo date('H:i:s');
                            }
                            ?>" class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Draft</label>
                        <input type="radio" name="draft" value="1" <?php if (isset($row) && $row['n01draft'] == 1) echo "checked"; ?>>Yes
                        <input type="radio" name="draft" value="0" <?php if (isset($row) && $row['n01draft'] == 0) echo "checked"; ?>>No
                    </div>

                    <div class="form-group">
                        <label>Schedule</label>
                        <input type="radio" name="schedule" value="1" <?php if (isset($row) && $row['scheduled'] == 1) echo "checked"; ?>>Yes
                        <input type="radio" name="schedule" value="0" <?php if (isset($row) && $row['scheduled'] == 0) echo "checked"; ?>>No
                    </div>


                     <div class="form-group">
                        <label>Is Instant Article?</label>
                        <input type="radio" name="instant_fb" value="1" <?php if (isset($row) && $row['instant_fb'] == 1) echo "checked"; ?>>Yes
                        <input type="radio" name="instant_fb" value="0" <?php if (isset($row) && $row['instant_fb'] == 0) echo "checked"; ?>>No
                    </div>


                </section>

            </article>

            <button type="submit" title="Add Category First" <?php if ($action == 'add') echo 'disabled'; ?> class="btn margin-top btn-primary btn-lg btn-block">Publish</button>
            <input type="hidden" name="id" value="<?php if (isset($row)) echo $id; ?>">
            <input type="hidden" name="action" value="<?php echo $action; ?>">
        </div>
    </div>
</form>

<script src="assets/js/bootstrap-tokenfield.min.js"></script>
<script src="assets/js/moment.js"></script>
<script src="assets/js/bootstrap-datetimepicker.js"></script>
<script src="assets/js/jquery.form.js"></script>
<<script>
   /// function closeCustomRoxy2(filepath) {
       // $('#close-btn').trigger('click');
       // var $img_src = '<img src="' + filepath + '">';
        //document.getElementById("thumbnail").style.display = "block";
       //// $('#thumbnail').html($img_src);
    //}
   

                                                    $(function () {
                                                        $('#datePicker').datetimepicker({
                                                            format: "YYYY-MM-DD",
                                                            showTodayButton: true,
                                                            showClose: true
                                                        });
                                                        $('#timePicker').datetimepicker({
                                                            format: 'LT',
                                                            showClose: true
                                                        });
                                                        
                                                         $('#timePicker1').datetimepicker({
                                                            format: 'LT',
                                                            showClose: true
                                                        });
                                                    });

                                                    function getName(img) {
                                                        var fullPath = document.getElementById("img1").src;
                                                        var img_val = fullPath.replace(/^.*[\\\/]/, '');
                                                        //alert(img_val);
                                                        // var filename = fullPath.split("/").pop();
                                                        var $img_src = '<img src="../uploads/news/images/' + img + '">';
                                                        document.getElementById("thumbnail").style.display = "block";
                                                        $('#thumbnail').html($img_src);
                                                        var input = document.getElementById('img-input').value = img;
                                                    }


                                                    function readURL(input) {
                                                        //$('#thumbnail').hide();
                                                        if (input.files && input.files[0]) {
                                                            var reader = new FileReader();

                                                            reader.onload = function (e) {
                                                                $('#thumbnail').html('<img src="' + e.target.result + '"  height="200"/>');

                                                            };

                                                            reader.readAsDataURL(input.files[0]);
                                                        }
                                                    }

                                                    $(function () {
                                                         $(".search-value").click(function ()
                                                        {
                                                            //var searchid = $(this).val();
                                                              var searchid = $( ".search" ).val();
                                                            var dataString = 'search=' + searchid;
                                                            if (searchid != '')
                                                            {
                                                                $.ajax({
                                                                    type: "POST",
                                                                    url: "ajax/news_img_search.php",
                                                                    data: dataString,
                                                                    cache: false,
                                                                    success: function (response)
                                                                    {

                                                                        $("#search-list").fadeOut('fast');
                                                                        $("#img-album").html(response);
                                                                    }
                                                                });
                                                            }
                                                            return false;
                                                        });



                                                    });


                                                        function delete_image(image_id) {
                                                                if (confirm('Sure to perfom the action'))
                                                                {
                                                                    $.ajax({
                                                                        url: 'ajax/delete_img.php',
                                                                        type: 'post',
                                                                        data: {"id": image_id, "of": 'news'},
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

                                                    function showHiddenThings(value) {

                                                        var selected = value;
                                                        //alert(selected);
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "ajax/sub_newscat.php",
                                                                data: {'id': value},
                                                                dataType: 'text',
                                                                success: function (response)
                                                                {
                                                                    $(".sub_cat").show();
                                                                    $("#sub_cat").html(response);
                                                                }
                                                            });


                                                    }
                                                    $('.tokenfield').tokenfield();
                                                      $('.tokenfield12').tokenfield();
                                                    $('.tokenfield13').tokenfield();
                                                     $('#article').tokenfield();
                                                    $('#location').tokenfield();
                                                    $('#temploc').tokenfield();

                                                    var checkboxes = $("input[type='checkbox']"),
                                                            submitButt = $("button[type='submit']");

                                                    checkboxes.click(function () {
                                                        submitButt.attr("disabled", !checkboxes.is(":checked"));
                                                    });
</script>
<script>
    $(function () {
        $('#search-news').keyup(function () {
            var value = this.value;
            $.ajax({
                url: "ajax/pagination-author.php",
                type: "post",
                data: {'search': value},
                dataType: "json",
                success: function (response) {
                    $('.result-author').html(response.newsList);
                }

            });
        });
    });
</script>

<script>
    function myFunction() {
        $('document').ready(function () {
            $(".pagination a").trigger('click'); // When page is loaded we trigger a click
        });

        $('.pagination').on('click', 'a', function (e) {
            var page = this.id;
            var perPage = '20';
            var pagination = '';
            var data = {'perPage': perPage, 'page': page};
            $.ajax({
                url: 'ajax/pagination-news-img.php',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (response) {

                    $('#search-list').html(response.newsList);
                    if (page == 1)
                        pagination += '<li class="disabled"><a href="#" aria-label="First"><span aria-hidden="true">First</span></a></li><li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">Previous</span></a></li>';
                    else
                        pagination += '<li class=""><a href="#" id="1" aria-label="First"><span aria-hidden="true">First</span></a></li><li class=""><a href="#" id="' + (page - 1) + '" aria-label="Previous"><span aria-hidden="true">Previous</span></a></li>';

                    for (var i = parseInt(page) - 3; i <= parseInt(page) + 3; i++) {
                        // 	alert(i);
                        if (i >= 1 && i <= response.numPage) {

                            if (i == page)
                                pagination += '<li class="active"><a href="#" id="' + i + '">' + i + '</a></li>';
                            else
                                pagination += '<li><a href="#" id="' + i + '">' + i + '</a></li>';

                        } //end of if
                    } // end for loop

                    if (page == response.numPage)
                        pagination += '<li class="disabled"><a href="#"  aria-label="Next"><span aria-hidden="true">Next</span></a></li><li class="disabled"><a href="#" aria-label="Last"><span aria-hidden="true">Last</span></a></li>';
                    else
                        pagination += '<li><a href="#" id="' + (parseInt(page) + 1) + '" aria-label="Next"><span aria-hidden="true">Next</span></a></li><li><a href="#" id="' + response.numPage + '" aria-label="Last"><span aria-hidden="true">Last</span></a></li>';

                    $('.pagination').html(pagination); // We update the pagination DIV

                }, // end of success

                error: function () {
                }

            });

            return false;

        });


    }

</script>
<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("li");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("div")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

<!--<script>
    $(function () {
        $(".showloc").click(function () {
            if ($(this).is(":checked")) {
                $("#atlocation").show();
            } else {
                $("#atlocation").hide();
            }
        });
    });
</script>-->

<!--<script src="ajax/pagination.js"></script>-->
<!--<script>
    $("#miguel").click(function() {
        $("#myiFrame").attr("src", '<?php// echo FILEMANAGER;?>index.php?integration=custom&type=files&txtFieldId=txtSelectedFile');
        $("#miguel").hide();
    });
</script>-->