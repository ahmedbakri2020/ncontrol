<?php
 $action = 'add';

if(isset($_GET['pid'])){
    $pid = (int)$_GET['pid'];
}
?>
 <div class="row">
        <div class="col-sm-8 col-md-8  col-lg-9">
<article class="module">
    <header>
        <h2>Add Images</h2>
    </header>
    <section>
        <form method="post" id="form" action="?fol=actpages&amp;page=act_epaperimg" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group fieldGroup">
                        <div class="input-group">
                            <input type="file" name="images[]" class="form-control">
                            
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
                 <input type="hidden" name="pid" value="<?php if (isset($pid)) echo $pid; ?> "/>
                <input type="hidden" name="action" value="<?php echo $action; ?>"/>
            </div>
        </form>
        
    </section>
</article>
  </div>
</div>
<script>
    $(document).ready(function () {
        //group add limit
        var maxGroup = 10;
        var copyHtml = '<div class="form-group"><div class="input-group">' +
                '<input type="file" name="images[]" class="form-control">' +

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