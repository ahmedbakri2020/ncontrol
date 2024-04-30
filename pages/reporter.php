<?php
$page = "reporter";

$res_user_cat = $obj->select("p01profile", "*");
if ($obj->getREQUEST('cat_id') && (int) $_GET['cat_id'] != "") {
    $cat = 'category';
    $type = (int) $_GET['cat_id'];
    $rowType = $obj->getDataByField("user_cat", 'cat01id', $type);
    $title = $rowType['cat01category'];
    $add_url = '?fol=form&amp;page=add_profile&type=' . $type;
} else {
    $title = 'Reporter';
    $type = 0;
    $cat = 'all';
    $add_url = '?fol=form&amp;page=add-reporter';
}
?>
    <article class="module">
        <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <h2><?php echo $title; ?></h2>
            <a href="<?php echo $add_url ?>&action=add" title=""><i class="fa fa-plus"></i> Add New Reporter</a>
        </header>
        <section>

            <div class="table-responsive">
                <table class="table table-hover" id="news-table">
                    <thead>
                    <tr class="active">
                        <th>Sort</th></th>
                        <th>S.n</th>
                        <th>Full Name</th>
                        <th>Facebook</th>
                        <th>twitter</th>
                        <th></th>

                        <th>Action</th>
                    </tr>
                    </thead>
                   <tbody class="result-list" id="sortable">


                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6 total-news-count">
                    <p>Total User: <strong id="total-data"> </strong> </p>
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
<script type="text/javascript" src="<?php echo ADMIN_URL ?>assets/js/ajax/reporter.js"></script>

<script>
    $('document').ready(function () {
        $(".pagination a").trigger('click'); // When page is loaded we trigger a click
    });

    $('.pagination').on('click', 'a', function (e) {
        var type = <?php echo $type; ?>;
        var page = this.id;
        var perPage = '200';
        var pagination = '';
        var data = {'perPage': perPage, 'page': page, '<?php echo $cat ?>': type};
        $.ajax({
            url: '<?php echo ADMIN_URL ?>ajax/pagination-<?php echo $page; ?>.php',
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (response) {
                //alert(response.result);
                $('.result-list').html(response.result);
                $('#total-data').html(response.total_data);
                $('html, body').animate({ scrollTop: 0 } , "slow");
                if (page == 1)
                    pagination += '<li class="disabled"><a href="#" aria-label="First"><span aria-hidden="true">First</span></a></li><li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">Previous</span></a></li>';
                else
                    pagination += '<li class=""><a href="#" id="1" aria-label="First"><span aria-hidden="true">First</span></a></li><li class=""><a href="#" id="' + (page - 1) + '" aria-label="Previous"><span aria-hidden="true">Previous</span></a></li>';

                for (var i = parseInt(page) - 3; i <= parseInt(page) + 3; i++) {
                    //	alert(i);
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