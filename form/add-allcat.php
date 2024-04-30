<?php
$category = $_GET['category'];
if ($obj->getREQUEST('id')) {
    $id = (int) $_GET['id'];
    $row = $obj->getDataByField('cat01category', 'cat01id', $id);
    $action = "edit";
} else {
    $action = 'add';
}
if (isset($_GET['cat_id'])) {
    $id = (int) $_GET['cat_id'];
}
?>
<article class="module">
    <header>
        <h2>Add Category</h2>
    </header>
    <section>
        <form method="post" id="form" action="?fol=actpages&amp;page=act_adedcategory">
            <div class="row">
                <div class="col-md-6">
<div class="form-group">
                                      
                                        <select name="pradesh_id" class="form-control">

                                            <option value="">--Select Pradesh--</option>
                                            <?php 
                                            $res_pradesh = $obj->select('pradesh','*'); 
                                            while($row_pradesh = $res_pradesh->fetch()):
                                                ?>
                                                <option value="<?php echo $row_pradesh['uin'];?>" <?php if (isset($row) && $row['pradesh_id']==$row_pradesh['uin']) echo 'selected'; ?>><?php echo $row_pradesh['cat01category'];?></option>
                                                <?php endwhile;?>
                                                
                                                                                    </select>
                                    </div>
                    <div class="form-group fieldGroup">
                        <div class="input-group">
                            <input type="text" name="category[]" value="<?php if (isset($row)) echo $row['cat01category']; ?>" class="form-control" placeholder="Add Category">

                            <?php if ($action == 'add'): ?>
                                <div class="input-group-addon"> 
                                    <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>


                </div>
            </div>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary">Add Category</button>
                <input type="hidden" name="id" value="<?php if (isset($row)) echo $row['cat01id']; ?>"/>
                <input type="hidden" name="cat" value="<?php echo $category; ?>"/>
                 <input type="hidden" name="type" value="district"/>
                <input type="hidden" name="action" value="<?php echo $action; ?>"/>
            </div>

        </form>
    </section>
</article>
<script>
    $(document).ready(function () {
        //group add limit
        var maxGroup = 10;
        var copyHtml = '<div class="form-group"><div class="input-group">' +
                '<input type="text" name="category[]" value="<?php if (isset($row)) echo $row['cat01category']; ?>" class="form-control">' +
<?php if ($category == 'news'): ?>
            '<input type="text" name="eng_title[]" value="<?php if (isset($row)) echo $row['eng_title']; ?>" class="form-control">' +
<?php endif; ?>
        '<div class="input-group-addon"> ' +
                '<a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</a>' +
                '</div>' +
                '</div></div>';
        //add more fields group
        $(".addMore").click(function () {
            if ($('body').find('.fieldGroup').length < maxGroup) {
                var fieldHTML = '<div class="form-group fieldGroup">' + $(copyHtml).html() + '</div>';
                $('body').find('.fieldGroup:last').after(fieldHTML);
            } else {
                alert('Maximum ' + maxGroup + ' groups are allowed.');
            }
        });

        //remove fields group
        $("body").on("click", ".remove", function () {
            $(this).parents(".fieldGroup").remove();
        });
    });


</script>