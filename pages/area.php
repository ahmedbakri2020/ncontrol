<?php
$cid = (int) $_GET['cid'];
$type = (int) $_GET['type'];
$table = 'cat01category';
$getData = $obj->select('cat01category', '*', array("type" => "area"));
$count_result = $obj->countRow($getData);
$district = $obj->select('cat01category', '*', array('cat01id' => $cid))->fetch();
$ordering = array('area');
?>
<article class="module">
    <header>
        <h2>Manage <?php echo $district['cat01category'] ?> Election Status</h2>

    </header>
    <section>

        <?php if ($getData->rowCount() > 0) { ?>
            <div class="table-responsive">
                <table class="table table-hover" id="news-table">


                    <thead>
                        <tr class="active">                        
                            <?php
                            if (in_array($category, $ordering)): echo '<td></td>';
                            endif;
                            ?>
                            <th>S.n</th>
                            <th>Title</th>    
                            <th>Home Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        <?php
                        $sn = 1;
                        while ($row = $getData->fetch()):
                            $get_status = $obj->select("tbl_election_status", "uin,status", array("dist" => $cid, "area" => $row['cat01id'], "type" => $type));
                            $status = $get_status->fetch();
                            ?>
                            <tr id="<?php echo $row['cat01id']; ?>">
                                <?php
                                if (in_array($category, $ordering)): echo '<td><span></span></td>';
                                endif;
                                ?>
                                <td><?php echo $sn; ?></td>                            
                                <td><?php echo $row['cat01category']; ?></td>
                                <td>
                                    <?php
                                    echo $status['status'];
                                    if ($status['status'] == 1) {
                                        ?>
                                        <a href="javascript:void(0)"><img src="assets/images/publish_small.png" align="published" onclick="change_status(<?php echo $cid ?>,<?php echo $row['cat01id'] ?>,<?php echo $type; ?>, 0,<?php echo $status['uin'] != "" ? $status['uin'] : ''; ?>)" /></a>
                                    <?php } else { ?>
                                        <a href="javascript:void(0)"><img src="assets/images/unpublish_small.png" align="unpublished" onclick="change_status(<?php echo $cid ?>,<?php echo $row['cat01id'] ?>,<?php echo $type; ?>, 1,<?php echo $status['uin'] != "" ? $status['uin'] : ''; ?>)" /></a>
                                    <?php } ?>
                                </td> 
                                <?php if (in_array($category, $ordering)): ?>


                                <?php endif; ?>
                                <td>
                                    <a href="?fol=form&amp;page=add-allcat&id=<?php echo $row['cat01id'] ?>&category=<?php echo $category ?>" title="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Edit</a>
                                    <a href="<?php echo '?fol=actpages&amp;page=act_delcategory&id=' . $row['cat01id'] ?>" onclick="return confirm('Delete / Uninstall cannot be undone! Are you sure you want to do this?')" title="" class="btn btn-danger btn-xs"><i class="fa fa-close"></i>Delete</a>
                                </td>
                            </tr>
                            <?php
                            $sn++;
                        endwhile;
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-md-6 total-news-count">
                    <p><strong>Total Category : </strong> <?php echo $obj->countRow($getData); ?></p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">                            
                            <li class="active"><a href="#">1</a></li>                          
                        </ul>
                    </nav>
                </div>                  
            </div>
        <?php } else { ?>
            <strong>No Contents Found!</strong>  
        <?php } ?>

    </section>
</article> <!--test-->
<script type="text/javascript" src="<?php echo ADMIN_URL ?>assets/js/ajax/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_URL ?>assets/js/ajax/script.js"></script>
<script type="text/javascript">

                                        function change_status(dist, area, type, value, el_id) {
                                            $.ajax({
                                                url: "actpages/change_status.php",
                                                type: "post",
                                                data: {'dist': dist, 'area': area, 'type': type, 'value': value, 'el_id': el_id},
                                                dataType: "json",
                                                success: function (response) {
                                                    if (response.status == 1) {
                                                        location.reload();
                                                    }
                                                }

                                            });

                                        }


                                        $(function () {

                                            $('#sortable').sortable({
                                                axis: 'y',
                                                opacity: 0.7,
                                                handle: 'span',
                                                update: function (event, ui) {
                                                    var list_sortable = $(this).sortable('toArray').toString();
                                                    // change order in the database using Ajax
                                                    $.ajax({
                                                        url: 'ajax/change_order.php',
                                                        type: 'POST',
                                                        data: {list_order: list_sortable, 'table': 'cat01category', 'field': 'data_order'},
                                                        success: function (data) {
                                                            //finished
                                                        }
                                                    });
                                                }
                                            }); // fin sortable
                                        });

</script>