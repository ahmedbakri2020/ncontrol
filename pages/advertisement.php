<?php
$page = 'ad';
if ($previlage == 'All' || in_array(2, $arr_prev)) {
    
} else {
    $obj->redirect('?page=404.php');
}

$cid = (int) $_GET['cid'];

if ($obj->getREQUEST('type') && (int) $_GET['type'] != "") {
    $cat = 'category';
    $type = (int) $_GET['type'];
    $rowType = $obj->getDataByField('ad_cat', 'cat01id', $type);
    $title = $rowType['cat01category'];
} elseif ($obj->getREQUEST('level') && (int) $_GET['level'] != "") {
    $cat = 'level';
    $type = (int) $_GET['level'];
    $rowType = $obj->getDataByField('tbl_adlevel', 'cat01id', $type);
    $title = $rowType['cat01category'];
} else {
    $title = 'Advertise  Gallery';
    $type = 0;
    $cat = 'latest';
}
?>
<article class="module">
    <header>
        <h2><?php echo $title; ?> Ad</h2>
        <a href="index.php?fol=form&amp;page=add-advertisement" title=""><i class="fa fa-plus"></i> Add Advertisement</a>
    </header>
    <section>
        <div class="action-wrap md-no-margin-form-group margin-bottom">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="advertisementPosition">Position</label>
                        <select class="form-control" name="category" onchange="window.location = '?page=advertisement&cid=<?php echo $cid; ?>&type=' + this.value" id="advertisementPosition">
                            <option>--choose position--</option>
                            <?php
                            $res_ad_cat = $obj->getAllData("ad_cat");
                            while ($row_cat_ad = $res_ad_cat->fetch()):
                                echo '<option value="' . $row_cat_ad['cat01id'] . '" ' . (($row_cat_ad['cat01id'] == $type) ? 'selected' : '') . '>' . $row_cat_ad['cat01category'] . '</option> ';
                            endwhile;
                            ?>
                        </select>
                    </div>
                </div>
                <?php if (isset($_GET['type'])&& $_GET['type'] == 2 || isset($_GET['level'])): ?>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="advertisementLevel">Level(Mid Ad)</label>
                            <select class="form-control" name="category" onchange="window.location = '?page=advertisement&level=' + this.value" id="advertisementLevel">
                                <option>--choose Level--</option>
                                <?php
                                $res_ad_cat = $obj->getAllData("tbl_adlevel");
                                while ($row_cat_ad = $res_ad_cat->fetch()):
                                    echo '<option value="' . $row_cat_ad['cat01id'] . '" ' . (($row_cat_ad['cat01id'] == $_GET['level']) ? 'selected' : '') . '>' . $row_cat_ad['cat01category'] . '</option> ';
                                endwhile;
                                ?>
                            </select>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
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
<script>
        $('document').ready(function () {
            $(".pagination a").trigger('click'); // When page is loaded we trigger a click
        });

        $('.pagination').on('click', 'a', function (e) {
            var type = <?php echo $type; ?>;
            var page = this.id;
            var perPage = '100';
            var pagination = '';
            var data = {'perPage': perPage, 'page': page, '<?php echo $cat ?>': type,'cid':<?php echo $cid; ?>};
            $.ajax({
                url: '<?php echo ADMIN_URL ?>ajax/pagination-ad.php',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (response) {
                  //alert(response.result);
                    $('#result-list').html(response.result);
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



    </script>
<script>
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

    function change_AdOrder(id, value, field, table, type)
    {
        //alert(id+'--------'+value);
        if (confirm('Sure to perfom the action'))
        {
            $.ajax({
                url: 'ajax/change_adorder.php',
                type: 'post',
                data: {"id": id, "field": field, "table": table, 'tbl_type': type, "value": value},
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