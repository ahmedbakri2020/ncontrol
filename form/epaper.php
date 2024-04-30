<?php
if ($previlage == 'All' || in_array(7, $arr_prev)) {
    
} else {
    $obj->redirect('?page=404.php');
}
$page = 'epaper';
if ($obj->getREQUEST('cid') && (int) $_GET['cid'] != "") {
    $cat = 'category';
    $type = (int) $_GET['cid'];
    $rowType = $obj->getDataByField("tbl_epaper_cat", 'uin', $type);
    $title = $rowType['title'];
} else {
    $title = 'Epaper';
    $type = 0;
    $cat = 'latest';
}
?>

<article class="module">
    <header>
        <h2><?php echo $title; ?>  </h2>
        <a href="?fol=form&amp;page=add-epaper&type=<?php echo $type; ?>" title=""><i class="fa fa-plus"></i> Add Epaper</a>
    </header>
    <section>

        <div class="table-responsive">
            <table class="table table-hover" id="result-list">

            </table>
        </div>
        
        <div class="row margin-top">
            <div class="col-md-6 total-news-count">
                <p id="total_count"></p>
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
<script>
    $('document').ready(function () {
        $(".pagination a").trigger('click'); // When page is loaded we trigger a click

    });

    function change_status(id, value, field, table, tbl_type) {

        if (confirm("Are you sure to perform this action ?")) {
            $.ajax({
                url: "actpages/change_status.php",
                type: "post",
                data: {'id': id, 'value': value, 'field': field, 'table': table, 'tbl_type': tbl_type},
                dataType: "json",
                success: function (response) {
                    if (response.status == 1) {
                        location.reload();
                    }
                }

            });
        }

    }

</script>

<?php include 'ajax/pagination-js.php'; ?>
<script type="text/javascript" src="<?php echo ADMIN_URL ?>assets/js/ajax/jquery-ui-1.10.4.custom.min.js"></script>
<script>
    $(function() {
    $('#sortable').sortable({
        axis: 'y',
        opacity: 0.7,
        handle: 'span',
        update: function(event, ui) {
          //  alert(ui);
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