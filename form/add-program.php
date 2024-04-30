<?php
if ($previlage == 'All' || in_array(1, $arr_prev)) {
    
} else {
    $obj->redirect('?page=404.php');
}
//$getstaffs=$obj->select('tbl_staffs',"*",array("type"=>2));
$hours = array("00"=>"00","01"=>"01","02"=>"02","03"=>"03","04"=>"04","05"=>"05","06"=>"06","07"=>"07","08"=>"08","09"=>"09","10"=>"10","11"=>"11","12"=>"12","13"=>"13","14"=>"14","15"=>"15","16"=>"16","17"=>"17","18"=>"18","19"=>"19","20"=>"20","21"=>"21","22"=>"22","23"=>"23");
$minutes = array("00"=>"00","05"=>"05","10"=>"10","15"=>"15","20"=>"20","25"=>"25","30"=>"30","35"=>"35","40"=>"40","45"=>"45","50"=>"50","55"=>"55");
$day = array("01"=>"Sunday","02"=>"Monday","03"=>"Tuesday","04"=>"Wednesday","05"=>"Thursday","06"=>"Friday","07"=>"Saturday");
	
	if($_GET['action']=="edit"){
		$action = "edit";
		$row = $obj->getSelProgram($_GET['id']);
              
                echo "<h2>Edit Program</h2>";
		$start = explode(":",$row['start_time']);
				$end = explode(":",$row['end_time']);
	}
        elseif($_GET['action']=="add"){
	$action = "add";
		echo "<h2>Add New Program</h2>";
		}
                ?>

<form method="post" action="?fol=actpages&amp;page=act_program" enctype="multipart/form-data" id="form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header>
                    <h2>Add Program</h2>
                </header>
                <section>
                   <div class="form-group">
<label for="Title">Program Name</label>
<input type="text" class="form-control" name="title" id="Title" value="<?php if(isset($row)) echo stripslashes($row['title']); ?>"/>
</div> 
                    
                     <div class="form-group">
<label for="Title">Presenter</label>
<input type="text" class="form-control" name="presenter" id="Title" value="<?php if(isset($row)) echo stripslashes($row['presenter']); ?>"/>
</div> 
                    

                   <div class="checkbox">
<label>
  <?php
  foreach($day as $key=>$val)
  {
  ?>
    &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  id="blankCheckbox" name="dayselect[]" value="<?php echo $key; ?>" id="dayselect[]" <?php if($action=="edit"){if($val == $row['day']) { echo "checked='checked'"; } else{ echo "disabled='disabled'";}  } ?>/><?php echo $val; ?><br />
  <?php
  }?>
  </label>	  
</div>
                    <button type="button" class="btn btn-danger" name="clear_chk" id="clear_ck">Clear</button>
<div class="form-group">
Start Time: 
      <select name="start_hour" class="required" title="Select Start Time" title="select time">
	  <option value="">-Select Time-</option>
          <?php
          foreach($hours as $key=>$val)
          {
              ?>
          <option value="<?php echo $val; ?>" <?php if($val == $start[0]){ echo "selected"; } ?>><?php echo $val; ?></option>
          <?php
          }
          ?>
    </select>
      <select name="start_min" class="required" title="Select Minute">
      <option value="">-Select Minute-</option>
          <?php
          foreach($minutes as $key=>$val)
          {
              ?>
          <option value="<?php echo $val?>" <?php if($val == $start[1]){ echo "selected"; } ?>><?php echo $val?></option>
              <?php
          }
          ?>
      </select>
</div>
                 <div class="form-group">
End Time: 
     <select name="end_hour" class="required" title="Select End Time">
	  <option value="">-Select Time-</option>
           <?php
          foreach($hours as $key=>$val)
          {
              ?>
          <option value="<?php echo $val?>" <?php if($val == $end[0]){ echo "selected"; } ?>><?php echo $val?></option>
          <?php
          }
          ?>
      </select>
      <select name="end_min" class="required" title="Select Minute">
      <option value="">-Select Minute-</option>
          <?php
          foreach($minutes as $key=>$val)
          {
              ?>
          <option value="<?php echo $val?>" <?php if($val == $end[1]){ echo "selected"; } ?>><?php echo $val?></option>
              <?php
          }
          ?>
      </select>
</div>


              <div class="form-group">
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
<input type="hidden" name="action" value="<?php echo $_GET['action']?>" />
 <button type="submit" class="btn btn-success" name="submit" >Submit</button>

</div>   

                

                  

                </section>
            </article>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-3">
          
          

           
            
            <article class="module margin-top">
              
                <section>
                  
            
                   
                </section>

            </article>




            <!--<button type="submit" title="Add Category First" <?php if ($action == 'add') echo 'disabled'; ?> class="btn margin-top btn-primary btn-lg btn-block">Publish</button>-->
           <!-- <input type="hidden" name="id" value="<?php if (isset($row)) echo $id; ?>">
            <button type="submit" class="btn btn-success" name="submit" >Submit</button>
            <input type="hidden" name="action" value="<?php echo $action; ?>">-->
        </div>
    </div>
</form>

<script src="assets/js/bootstrap-tokenfield.min.js"></script>
<script src="<?php echo EDITIOR ?>ckeditor.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL ?>assets/editor/ckfinder/ckfinder.js"></script>
<script src="assets/js/dropzone.js"></script>
<script src="assets/js/moment.js"></script>
<script src="assets/js/bootstrap-datetimepicker.js"></script>
<script src="assets/js/require.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script>


                                                    $(function () {
                                                        $('#datePicker').datetimepicker({
                                                            format: "YYYY-MM-DD",
                                                            showTodayButton: true,
                                                            showClose: true
                                                        });
                                                        $('.timePicker').datetimepicker({
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

                                                        if (input.files && input.files[0]) {
                                                            var reader = new FileReader();

                                                            reader.onload = function (e) {
                                                                //alert(e.target.result);
                                                                $('#thumbnail').show();
                                                                $('#thumbnail').html('<img src="' + e.target.result + '"  height="200"/>');

                                                            };

                                                            reader.readAsDataURL(input.files[0]);
                                                        }
                                                    }

                                                    $(function () {
                                                        $(".search").keyup(function ()
                                                        {
                                                            var searchid = $(this).val();
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


                                                    function showHiddenThings(value) {

                                                        var selected = value;
                                                        //alert(selected);
                                                        if (selected == 18) {


                                                            $.ajax({
                                                                type: "POST",
                                                                url: "ajax/sub_newscat.php",
                                                                data: {'id': value},
                                                                dataType: 'text',
                                                                success: function (response)
                                                                {
                                                                    $("#sub_cat").html(response);
                                                                }
                                                            });
                                                        }
                                                    }


                                                    var checkboxes = $("input[type='checkbox']"),
                                                            submitButt = $("button[type='submit']");

                                                    checkboxes.click(function () {
                                                        submitButt.attr("disabled", !checkboxes.is(":checked"));
                                                    });

                                                    function getAuthor() {
                                                        var clicked = document.getElementById('author');
                                                        var authorid = clicked.options[clicked.selectedIndex].value;

                                                        $.ajax({
                                                            url: 'ajax/load-reporter-image.php',
                                                            type: 'post',
                                                            data: {"authorid": authorid},
                                                            dataType: 'json',
                                                            success: function (response)
                                                            {
                                                                document.getElementById('thumbnail-author').style.display = "block";
                                                                $('#author-det').html(response.image);
                                                            }
                                                        });


                                                    }

                                                    function showHiddenThings(value) {
                                                        var selected = value;
                                                        //alert(selected);
                                                        if (selected == 19) {
                                                            $('#ribbon-news').show();
                                                            $('#show_title').show();
                                                            $("#shortdesc_div").show();
                                                            $("#hide-time").show();
                                                        }
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
                                                    CKEDITOR.replace('content-editor', {
                                                        toolbar: 'MyToolbar',
                                                        filebrowserBrowseUrl: '<?php echo FILEMANAGER ?>dialog.php?type=2&editor=ckeditor&fldr=files',
                                                        filebrowserUploadUrl: '<?php echo FILEMANAGER ?>dialog.php?type=2&editor=ckeditor&fldr=files',
                                                        filebrowserImageBrowseUrl: '<?php echo FILEMANAGER ?>dialog.php?type=1&editor=ckeditor&fldr=files'
                                                    });

                                                    CKEDITOR.replace('scontent-editor', {
                                                        toolbar: 'MyToolbar',
                                                        filebrowserBrowseUrl: '<?php echo FILEMANAGER ?>dialog.php?type=2&editor=ckeditor&fldr=files',
                                                        filebrowserUploadUrl: '<?php echo FILEMANAGER ?>dialog.php?type=2&editor=ckeditor&fldr=files',
                                                        filebrowserImageBrowseUrl: '<?php echo FILEMANAGER ?>dialog.php?type=1&editor=ckeditor&fldr=files'
                                                    });
</script>

<script src="ajax/pagination.js"></script> 
