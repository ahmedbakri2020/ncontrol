<?php
$page = 'epimages';
if ($previlage == 'All' || in_array(4, $arr_prev)) {

} else {
    $obj->redirect('?page=404.php');
}

$res_user_cat = $obj->select("epaper_cat", "*");
if ($obj->getREQUEST('pid') && (int) $_GET['pid'] != "") {
    $cat = 'category';
    $type = (int) $_GET['pid'];
    $rowType = $obj->getDataByField("epaper_pdf", 'eid', $type);
    $title = $rowType['epaper_name'];
    $add_url = '?fol=form&amp;page=add-epaperimages&action=add&pid='.$type;
} else {
    $title = 'All PDF';
    $type = 0;
    $cat = 'all';
    $add_url = '?fol=form&amp;page=add-epaperimages';
}
?>
    <article class="module">
        <header>
            <h2><?php echo $title; ?></h2>
            <a href="<?php echo $add_url ?>" title=""><i class="fa fa-plus"></i> Add Images</a>
        </header>
        <section>
            <div class="action-wrap md-no-margin-form-group margin-bottom">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="input-group">
                                

                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover" id="news-table">
                    <thead>
                    <tr class="active">
                        <th>Sort</th>
                        <th>SN.</th>
                        <th>Image</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="news-list" id="sortable">


                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6 total-news-count">
                    <p>Total Data: <strong id="total-data"> </strong> </p>
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
    <script type="text/javascript" src="<?php echo ADMIN_URL ?>assets/js/ajax/jquery-ui-1.10.4.custom.min.js"></script>
<script>
     $('document').ready(function () {
            showSpinner();
            $(".pagination a").trigger('click'); // When page is loaded we trigger a click

        });

        $('.pagination').on('click', 'a', function (e) {
            var type = <?php echo $type; ?>;
            var page = this.id;
            var perPage = '100';
            var pagination = '';
            var data = {'perPage': perPage, 'page': page, '<?php echo $cat ?>': type};
            $.ajax({
                url: '<?php echo ADMIN_URL ?>ajax/pagination-<?php echo $page; ?>.php',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (response) {
                    hideSpinner();
                    // alert(response.newsList);
                    $('.news-list').html(response.result);
                    $('#total_count').html('<strong>Total News:' + response.total_data + ' </strong>');
                    $('html, body').animate({scrollTop: 0}, "slow");
                    if (page == 1)
                        pagination += '<li class="disabled"><a href="#" aria-label="First"><span aria-hidden="true">First</span></a></li><li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">Previous</span></a></li>';
                    else
                        pagination += '<li class=""><a href="#" id="1" aria-label="First"><span aria-hidden="true">First</span></a></li><li class=""><a href="#" id="' + (page - 1) + '" aria-label="Previous"><span aria-hidden="true">Previous</span></a></li>';

                    for (var i = parseInt(page) - 3; i <= parseInt(page) + 3; i++) {                        
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

                error: function () { }

            });

            return false;

        });
        
        
        $(function() {

    $('#sortable').sortable({
        axis: 'y',
        opacity: 0.7,
        handle: 'span',
        update: function(event, ui) {
            var list_sortable = $(this).sortable('toArray').toString();
    		// change order in the database using Ajax
            $.ajax({
                url: 'ajax/change_ordering.php',
                type: 'POST',
                data: {page_order:list_sortable,'of':'post_order','tbl':'epaper_images'},
                success: function(data) {
                    //finished";
                }
            });
        }
    }); // fin sortable
});
</script>
