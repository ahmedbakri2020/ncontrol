<?php
if ($previlage == 'All' || in_array(7, $arr_prev)) {
    
} else {
    $obj->redirect('?page=404.php');
}

$page = 'epaper_cat';
$type = 0;
$cat = 'latest';
?>

<article class="module">
    <header>
        <h2>Epaper Category</h2>
<!--        <a href="?fol=form&amp;page=add-epaper-cat" title=""><i class="fa fa-plus"></i> Add New</a>-->
    </header>
    <section>

        <div class="table-responsive">
            <table class="table table-hover" id="result-list">


            </table>
        </div>
        <div class="row">
            <div class="col-md-6 total-news-count">
                <strong>Total Data : <span id="total-data"></span></strong> 
            </div>
            <div class="col-md-6">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="active"><a href="#" id="1">1</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
</article>
<?php include 'ajax/pagination-js.php'; ?>
<script type="text/javascript" src="<?php echo ADMIN_URL ?>assets/js/ajax/jquery-ui-1.10.4.custom.min.js"></script>
<script>
$(function() {

    $('#sortable').sortable({
        axis: 'y',
        opacity: 0.7,
        handle: 'span',
        update: function(event, ui) {
            var list_sortable = $(this).sortable('toArray').toString();
    		// change order in the database using Ajax
            $.ajax({
                url: 'ajax/paper_order.php',
                type: 'POST',
                data: {list_order:list_sortable},
                success: function(data) {
                    //finished
                }
            });
        }
    }); // fin sortable
});
</script>