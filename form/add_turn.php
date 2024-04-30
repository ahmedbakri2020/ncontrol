<?php
if ($previlage == 'All' || in_array(4, $arr_prev)) {

} else {
    $obj->redirect('?page=404.php');
}
if (isset($_GET['id'])) {
    $action = "edit";
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField("epaper_turn", 'eid', $id);

    $time = date('H:i:s', strtotime($row['mytime']));
    $cat_size = $obj->getDataByField(epaper_cat, 'cat01id', $row['e01type']);
} else {
    $action = "add";
}
if (isset($_GET['type'])) {
    $type = '&type=' . (int) $_GET['type'];
}
?>

<form method="post" action="?fol=actpages&amp;page=act_adedturn" enctype="multipart/form-data" id="form-data">
    <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
            <article class="module">
                <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                    <h2>Add PDF</h2>
                </header>
                <section>
                    <div class="form-group">
                        <label for="newsTitle">Title</label>
                        <input type="text" name="title" class="form-control" id="newsTitle" value="<?php if (isset($row)) echo stripslashes($row['epaper_name']); ?>" required>
                    </div>
                     <div class="form-group">
                        <label for="newsTitle">Month</label>
                        <input type="text" id="datepicker1" name="emonth" class="form-control" id="newsTitle" value="<?php if (isset($row)) 
                        { 
                        echo stripslashes($row['emonth']) ;
                        } else { 
                        echo date('F');
                        } ?>" required>
                    </div>
                     <div class="form-group">
                     <div class="input-group date" id="datePicker">
                            <input type="text" name="date" required  value="<?php
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
                        </div>
                       
                       
                </section>
            </article>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-3">
            <article class="module">
                <header>
                    <h2>Epaper Category</h2>
                </header>
                <section>
                    <div class="bs-multiselect">
                        <ul>
                            <?php
                            //$res_news_type = $obj->select("n02news_cat", "*");
                            $res_news_type = $obj->db->query("select * from n02news_cat where cat01id IN ('22','28','36')");
                            if ($res_news_type->rowCount() > 0) {
                                while ($row_type = $res_news_type->fetch()) {
                                    ?>
                                    <li>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="category[]" onclick="showHiddenThings(<?php echo $row_type['cat01id'] ?>)" value="<?php echo $row_type['cat01id']; ?>" <?php if (isset($row) && $row['e01type'] == $row_type['cat01id']) echo 'checked'; ?>> <?php echo $row_type['cat01category'] ?>
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

           <article class="module">
                <header>
                    <h2>Image</h2>
                </header>
                <section>
                    <div class="bs-upload-image" <?php
                   if ($action == 'add') {
                    echo 'style="display: none;"';
                   }
                    ?> id="thumbnail" data-toggle="modal" data-target=".bs-modal-lg">
                        <?php //if (isset($row) && $row['epaper_image'] != ""): ?>
                            <img src="../uploads/turn/images/thumbs/<?php echo $row['epaper_image']; ?>">
                        <?php //endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="userImage"></label>
                        <input type="file" name="image" onchange="readURL(this);" class="form-control" id="image">
                    </div>
                </section>
            </article>
            <article class="module">
                <header>
                    <h2>Epaper Pdf</h2>
                </header>
                <section>
                    <div class="bs-upload-image" <?php
                    if ($action == 'add') {
                        echo 'style="display: none;"';
                    }
                    ?> id="thumbnail" data-toggle="modal" data-target=".bs-modal-lg">
                        <?php if (isset($row) && $row['epaper_pdf'] != ""): ?>
                            <img src="../uploads/turn/category/thumbs/<?php echo $row['epaper_pdf']; ?>">
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="userImage"></label>
                        <input type="file" name="pdf" onchange="readURL(this);" class="form-control" id="image">
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
<script src="<?php echo EDITIOR ?>ckeditor.js"></script>
<script src="assets/js/moment.js"></script>
<script src="assets/js/bootstrap-datetimepicker.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script>

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
        var $img_src = '<img src="uploads/news/images/' + img + '">';
        document.getElementById("thumbnail").style.display = "block";
        $('#thumbnail').html($img_src);
        var input = document.getElementById('img-input').value = img;

    }


    $('.tokenfield').tokenfield();

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


    var checkboxes = $("input[type='checkbox']"),
        submitButt = $("button[type='submit']");

    checkboxes.click(function () {
        submitButt.attr("disabled", !checkboxes.is(":checked"));
    });
</script>

<script src="ajax/pagination.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<script>
    $("#datepicker1").datepicker({
        format: "MM",
        viewMode: "months",
        minViewMode: "months"
    });
</script>