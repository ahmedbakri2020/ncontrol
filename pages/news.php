<?php
$flash=$_GET['filter'];
if ($previlage == 'All'){
    $page = 'news';
}else{
    $page = 'news';
}

if ($previlage == 'All' || in_array(1, $arr_prev)){

    $resType = $obj->select(NEWS_CAT, "*",array("status"=>"1"));
    $resUser = $obj->select("u01user", "*","uin not in (1,2,3)");
    $res_user = $obj->getAllUser();
    if ($obj->getREQUEST('nid') && (int) $_GET['nid'] != "") {
        $cat = 'category';
        $type = (int) $_GET['nid'];
        $rowType = $obj->getDataByField(NEWS_CAT, 'cat01id', $type);
        $title = $rowType['cat01category'].' समाचार';
    } elseif ($obj->getREQUEST('uid') && (int) $_GET['uid'] != "") {
        $type = (int) $_GET['uid'];
        $cat = 'author';
        $rowType = $obj->getDataByField("u01user", 'uin', $type);
        $title = $rowType['u01fullname'];
    } elseif ($obj->getREQUEST('filter') && $_GET['filter'] != "") {
        $type = '0';
        $cat = $_GET['filter'];
        $title = "Filtered News";
    } else {
        $title = 'News';
        $type = 0;
        $cat = 'latest';
    }

    if (isset($_GET['nid'])) {
        $type_link = '&type=' . $type;
    }
    ?>

    <article class="module">
        <header>
            <h2><?php echo $title; if (isset($_GET['nid']) && $_GET['nid']!="All Category"): ?>  <a href="?page=category&cat=sub_cat_news&id=<?php echo $type; ?>" title=""><i class="fa fa-plus"></i> Add Sub Cat</a> <?php endif; ?> </h2>
            <a href="?fol=form&amp;page=add-news<?php if (isset($type_link)) echo $type_link; ?>" title=""><i class="fa fa-plus"></i> Add News</a>
        </header>
        <section>
            <div class="action-wrap md-no-margin-form-group margin-bottom">
                <div class="row">

                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control"  onchange="window.location = '?page=news&nid=' + this.value">
                                <option>All Category</option>
                                <?php
                                while ($row_type = $resType->fetch()):
                                  //  $news = $obj->getAllDataByField(NEWS,"n01type",$row_type['cat01id']);
                                   // $count = $obj->countRow($news);
                                    echo '<option value="' . $row_type['cat01id'] . '" '.(($row_type['cat01id']==$_GET['nid'])?'selected':'').'>' . $row_type['cat01category'] . '</option>';
                                endwhile;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control" onchange="getReport(this.value)">
                                <option>--News Report--</option>
                                <option value="0">Today</option>
                                <option value="1">Yesterday</option>
                                <option value="7">Last Week</option>
                                <option value="30">Last Month</option>
                            </select>
                        </div>
                    </div>

                    <?php if ($previlage == 'All'): ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <select class="form-control"  onchange="window.location = '?page=news&uid=' + this.value">
                                    <option>--Filter By Users--</option>
                                    <?php
                                    while ($row_user = $resUser->fetch()):
                                        //$news = $obj->getAllDataByField(NEWS,"user_id",$row_user['uin']);
                                       // $count = $obj->countRow($news);
                                        echo '<option value="' . $row_user['uin'] . '" '.(($row_user ['uin']==$_GET['uid'])?'selected':'').'>' . $row_user['u01fullname'] . '</option>';
                                    endwhile;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php endif;?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <select class="form-control" onchange="window.location = '?page=news&filter=' + this.value">
                                    <option>Filter By</option>
                                    <option value="flash" <?php if ($_GET['filter'] == 'flash') echo 'selected'; ?>>Flash</option>
                                <option value="sub_flash" <?php if($_GET['filter']=='sub_flash') echo 'selected'; ?>>Sub_flash</option>
                                  <option value="front_page" <?php if($_GET['filter']=='front_page') echo 'selected'; ?>>Front Page</option>
                                  
                                </select>
                            </div>
                        </div>

                   

                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" id="search-news" placeholder="Search"  class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover" id="news-table">
                    <thead>
                    <tr class="active">
                       <?php if ($flash == 'flash' || $flash =='sub_flash'|| $flash =='front_page') echo '<td>Sort</td>'; ?>
                        <th>Sn.</th>
                        <th width="15%">Title</th>
                        <th>Category</th>
                        <th>Posted By</th>
                        <th>Date</th>
                        
                        <td>Flash</td>
                          <td>Sub Flash</td>
                           <td>Frt.Page</td>
                           <th>Imp</th>
                        
                        <?php if ($type==22) echo '<td>Featured</td>'; ?>
                       
                       
                            <th>Views</th>
                      
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="news-list" id="sortable">

                    </tbody>
                </table>
            </div>
            <div class="row">
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
                    // alert(response.newsList);
                    $('.news-list').html(response.newsList);
                    $('#total_count').html('<strong>Total News:' + response.count + ' </strong>');
                    $('html, body').animate({scrollTop: 0}, "slow");
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

        function getReport(value) {
            $.ajax({
                url: "ajax/get-news-report.php",
                type: "post",
                data: {'date': value},
                dataType: "json",
                success: function (response) {
                    $('.news-list').html(response.result);
//alert(response.count);
                    $('#total_count').html('<strong>Total News:' + response.count + ' </strong>');
                }
            });

        }

        $(function () {
            $('#search-news').keyup(function () {
                var value = this.value;
                $.ajax({
                    url: "ajax/pagination-<?php echo $page; ?>.php",
                    type: "post",
                    data: {'perPage': '100', 'page': '1', 'search': value},
                    dataType: "json",
                    success: function (response) {
                        $('.news-list').html(response.newsList);
                        $('#total_count').html('<strong>Total News:' + response.count + ' </strong>');
                    }

                });
            });
        });


    </script>
    <script type="text/javascript" src="<?php echo ADMIN_URL ?>assets/js/ajax/jquery-ui-1.10.4.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_URL ?>assets/js/ajax/script.js"></script>
    <?php
}else{
    echo '<h3>Welcome to Admin Panel</h3>';
//header('location:index.php?page=home');
//$obj->redirect('index.php?page=home');
} ?>