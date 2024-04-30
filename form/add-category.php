<?php
$category = $_GET['category'];
switch ($category) {
    case 'news': $table = 'n02news_cat';  $act = 'newscat';  break;

    default :
        $table = "tbl_" . $category; $act = 'allcat';  break;
}
if ($obj->getREQUEST('id')) {
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField($table, 'cat01id', $id);
    $action = "edit";
    //  var_dump($row);
} else {
    $action = 'add';
}
if(isset($_GET['cat_id'])){
    $id = (int)$_GET['cat_id'];
}
?>
<article class="module">
    <header>
        <h2>Add Category</h2>
    </header>
    <section>
        <form method="post" id="form" action="?fol=actpages&amp;page=act_<?php echo $act; ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="fields">
                        <div class="form-group">
                            <label for="categoryTitle">Title</label>
                            <input type="text" name="category[]" value="<?php if (isset($row)) echo $row['cat01category']; ?>" class="form-control more-class" id="categoryTitle">
                        </div>
                        <?php if ($category == 'news'): ?>
                            <div class="form-group">
                                <label for="categoryETitle">English Title</label>
                                <input type="text" name="eng_title[]" value="<?php if (isset($row)) echo $row['eng_title']; ?>" class="form-control more-class" id="categoryETitle">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if($category == 'news'):?>
                <div class="col-md-4">
                     <article class="module">
            <header>
                <h2>Category Image</h2>
                 <?php
                        if (isset($row) && $row['cat_image'] != "") {
                            echo '<img src="assets/images/Trash.png" onclick="delete_catimage(' . $row['cat01id'] . ')" class="pull-right" />';
                        }
                        
                    ?>
                <?php
                if (isset($row) && $row['c01image'] != "") {
                    echo '<img src="assets/images/Trash.png" onclick="delete_image(' . $row['cat01id'] . ','."'$table'".')" class="pull-right" />';
                }

                ?>
            </header>
            <section>

                <div class="bs-upload-image" id="thumbnail" <?php if($action=='add') echo 'style="display: none;"'; ?>>
                    <?php if (isset($row) && $row['cat_image'] != ""): ?>
                        <img src="<?php echo UPLOADS ?>category/thumbs/<?php echo $row['cat_image']; ?>"width="" height="">
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="userImage"></label>
                    <input type="file" name="cat_image" onchange="readURL(this);" class="form-control" id="image">
                </div>
                <p>Image Size above 200px width  and 200px height to show image while sharing in facebook</p>


            </section>
        </article>
                </div>
                <?php
                endif;
                ?>
                
            </div>

            <?php /* if ($action == 'add'): ?>
                <div class="form-group">
                    <button type="button" id="addmore" class="btn btn-info">Add More</button>
                </div>
            <?php endif; */?>


            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary">Add Category</button>
                <input type="hidden" name="id" value="<?php if (isset($row)) echo $row['cat01id'];?>"/>
                 <input type="hidden" name="type" value="<?php if (isset($id)) echo $id;?>"/>
                <input type="hidden" name="cat" value="<?php echo $category;?>"/>
                <input type="hidden" name="action" value="<?php echo $action;?>"/>
            </div>

        </form>
    </section>
</article>
<script>
    $(document).ready(function () {
        var i = 1;
        var InnerHtml = '<div id="fields' + i + '"><div class="form-group"><label for="categoryTitle">Title</label><input type="text" name="category[]" class="form-control" id="categoryTitle"></div>'
                + '<?php if($category=='news'): ?><div class="form-group"><label for="categoryETitle">English Title</label> <input type="text" name="eng_title[]" class="form-control" id="categoryETitle"></div><?php endif; ?><button type="button"  name="remove" id="' + i + '" class="btn btn-danger btn_remove pull-right">X</button></div>';
        $("#addmore").click(function () {
            i++;
            $('.fields').before(InnerHtml);
        });

        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#fields' + button_id + '').remove();
        });

    });
    function delete_catimage(image_id) {
                                                                if (confirm('Sure to perfom the action'))
                                                                {
                                                                    $.ajax({
                                                                        url: 'ajax/delete_img.php',
                                                                        type: 'post',
                                                                        data: {"id": image_id, "of": 'category'},
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


</script>